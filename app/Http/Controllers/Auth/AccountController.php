<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Image;

use App\Models\Settings;
use App\Models\User;
use App\Models\Categories;
use App\Models\Pages;
use App\Models\Notifications;
use App\Models\Items;
use App\Models\Favorites;
use App\Models\Genders;
use App\Models\Comments;
use App\Models\Advertising;
use App\Models\Badges;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->categories = Categories::where('status', 1)->get();
        $this->pages = Pages::where('status', 1)->get();
        
        // for Top User Widget
        $this->topUser = User::withSum('user_points_list', 'score')
            ->orderByDesc('user_points_list_sum_score')
            ->limit(5)
            ->get();
        
    }
    
    public function profile($username)
    {
        
        $user = User::where('name', $username)->firstOrFail();
        
        return view('layouts.profile.profile')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => $user->name,
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'setting_adv_top' => Settings::find('adv_top')->value,
            'setting_adv_bottom' => Settings::find('adv_bottom')->value,
            'adv_top' => Advertising::where('id', Settings::find('adv_top')->value)->first(),
            'adv_bottom' => Advertising::where('id', Settings::find('adv_bottom')->value)->first(),
            'user' => $user,
            'topBadge' => Badges::find(Settings::find('top_badge')->value),
            'topUser' => $this->topUser,
            'badgeList' => Badges::orderBy('score', 'asc')->get(),
            'statusPoints' => Settings::find('status_points')->value
            
        ]);
    }
    
    public function user_comments($username)
    {

        $user = User::where('name', $username)->firstOrFail();
        $comments = Comments::where('user_id', $user->id)->orderByDesc('id')->paginate(15);

        return view('layouts.profile.comments')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('main.users_comment', ['name'=>$user->name]),
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'setting_adv_top' => Settings::find('adv_top')->value,
            'setting_adv_bottom' => Settings::find('adv_bottom')->value,
            'adv_top' => Advertising::where('id', Settings::find('adv_top')->value)->first(),
            'adv_bottom' => Advertising::where('id', Settings::find('adv_bottom')->value)->first(),
            'topUser' => $this->topUser,
            'statusPoints' => Settings::find('status_points')->value,
            'user' => $user,
            'comments' => $comments
        ]);
    }
    
    public function settings()
    {
        return view('layouts.account.settings')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('main.account'),
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'user' => User::findOrFail(Auth::id()),
            'gendersList' => Genders::all()
        ]);
    }

    public function store(Request $request)
    {
        
        // new password
        if(!empty(request('new_password'))){
            $this->validate($request, [
                'new_password' => 'required|min:8',
                'new_confirm_password' => 'same:new_password',
            ]);

            $update = User::where('id', Auth::id())
                ->update([
                    'password' => bcrypt(request('new_password'))
                ]);

            if($update == true)
            {
                toastr()->success(__("main.toast_your_password_has_been_changed"));
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('login');
            } else 
            {
                toastr()->error(__('main.toast_there_are_problems_try_again'));
                return back();
            }
        }
        
        // store avatar
        if(!empty(request('avatar'))){

            $request->validate([
                'avatar' => 'nullable|image|dimensions:min_width=100,min_height=100|mimes:jpeg,png,jpg|max:1048',
            ]);

            if(!empty(Auth::user()->avatar)){
                File::delete('storage/app/public/images/avatar/'.Auth::user()->avatar);
            }

            $image = $request->file('avatar');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = 'storage/app/public/images/avatar';

            $img = Image::make($image->path())
                ->fit(120, 120) // fixed crop of the image
                ->save($destinationPath.'/'.$input['imagename']);

            $uploadAvatar = User::where('id', Auth::id())
                ->update([
                    'avatar' => $input['imagename']
                ]);
            
            if($uploadAvatar == true)
            {
                toastr()->success(__('main.toast_you_have_updated_your_profile_picture'));
                return back();
            } else 
            {
                toastr()->error(__('main.toast_there_are_problems_try_again'));
                return back();
            }
        }
        // end store avatar
        
        $request->validate([
            'name' => 'required|alpha_dash|unique:users,name,'.Auth::id(),
            'email' => 'required|unique:users,email,'.Auth::id(),
            'gender' => 'required',
            'month' => 'required|date_format:m',
            'day' => 'required|date_format:d',
            'year' => 'required|date_format:Y',
            'bio' => 'nullable',
            'website' => 'nullable|url',
            'twitter' => 'nullable',
            'instagram' => 'nullable',
            'tiktok' => 'nullable',
            'telegram' => 'nullable'
        ]);

        $update = User::where('id', Auth::id())
            ->update([
                'name' => Request('name'),
                'email' => Request('email'),
                'bio' => Request('bio'),
                'website' => Request('website'),
                'twitter' => Request('twitter'),
                'instagram' => Request('instagram'),
                'tiktok' => Request('tiktok'),
                'telegram' => Request('telegram'),
                'genders_id' => Request('gender'),
                'birth' => Request('year').'-'.Request('month').'-'.Request('day'),
        ]);

        if($update == true)
        {
            toastr()->success(__('main.toast_your_profile_has_been_updated'));
            return back();
        } else 
        {
            toastr()->error(__('main.toast_there_are_problems_try_again'));
            return back();
        }
        
    }
    
    public function avatar_delete()
    {
        if(!empty(Auth::user()->avatar))
        {
            // delete avatar 
            File::delete('storage/app/public/images/avatar/'.Auth::user()->avatar);
            
            $delete_avatar = User::where('id', Auth::id())
                ->update([
                    'avatar' => NULL,
                ]);
            
            if($delete_avatar == true)
            {
                toastr()->info(__('main.toast_avatar_deleted'));
                return back();
            } else 
            {
                toastr()->error(__('main.toast_there_are_problems_try_again'));
                return back();
            }
        } 
    }
    
    public function notifications()
    {
     
        return view('layouts.account.notifications')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('main.notifications'),
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
        ]);
        
    }
    
    public function mark_as_read()
    {
        $update = Auth::user()->mark_as_read();
        
        if($update == true)
        {
            return response()->json([
                'bool'=>true
            ]);
            
        } else 
        {
            return response()->json([
                'bool'=>false
            ]);
        }
    }
    
    public function delete_account(){

        return view('layouts.account.delete_account')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('auth.delete_account'),
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'user' => User::findOrFail(Auth::id()),
        ]);
        
    }
    
    public function delete_account_store(Request $request) {
        
        if(User::where('id', Auth::id())->exists()){
            // remove his avatar
            if(!empty(Auth::user()->avatar)) {
                File::delete('storage/app/public/images/avatar/'.Auth::user()->avatar);
            }
            
            // remove images associated with his posts
            foreach(Auth::user()->all_posts_user as $item){
            
                // remove tags
                foreach($item->tags as $tag) {
                    $item->untag();
                }
                
            }
            
            User::where('id', Auth::id())->delete();
            return redirect('login');
            
        } else {
            toastr()->error(__('main.toast_there_are_problems_try_again'));
            return back();
        }
        
    }
    
    /**
     * Favorites
     *
     * @return \Illuminate\Http\Response
     */
    public function favorites()
    {
        
        $items = Items::whereHas('favorited', function ($query) {
            $query->where('user_id', Auth::id()); 
        })->whereHas('category', function ($query) {
            $query->where('status', 1); // only where the category it belongs to is active
        })->where('status', 1)
            ->orderByDesc('id')
            ->paginate(25);
        
        return view('layouts.account.saved')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('main.saved'),
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'story_preview_chars' => Settings::find('story_preview_chars')->value,
            'items' => $items
        ]);
    }
    
    
}