<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Image;
use Carbon\Carbon;
use App\Models\Settings;
use App\Models\Pages;
use App\Models\Items;
use App\Models\Images;
use App\Models\Likes;
use App\Models\User;
use App\Models\Categories;
use App\Models\ItemsViews;
use App\Models\Notifications;
use App\Models\Reports;
use \Conner\Tagging\Taggable;
use Overtrue\LaravelLike\Traits\Likeable;
use App\Models\Advertising;
use App\Models\Genders;
use App\Models\Points;
use Snipe\BanBuilder\CensorWords;

use Redirect, Response;

class HomeController extends Controller
{
    
    use Likeable;
    
    public function __construct()
    {
        $this->categories = Categories::where('status', 1)->get();
        $this->pages = Pages::where('status', 1)->get();
        $this->most_used_tags = \Conner\Tagging\Model\Tag::where('count', '>=', 2)->limit('3')->get();
        $this->results_per_page = Settings::find('results_per_page')->value;
        $this->itemsRandomOrder = Items::where('status', 1)->inRandomOrder()->take(Settings::find('random_items')->value)->get();
        $this->usersRandomOrder = User::inRandomOrder()->take(Settings::find('random_users')->value)->get();
        
        if(Auth::check()){
            $this->userPoints = Auth::user()->total_point_count(); // if you are logged in, assign points to the current user
        } else {
            $this->userPoints = 0; // if he is a guest he awards 0 points
        }
        
    }
    
    /**
     * Index
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // get items list
        $items = Items::whereHas('category', function ($query) {
            
            if(Auth::check()){
                $userPoints = Auth::user()->total_point_count(); // if you are logged in, assign points to the current user
            } else {
                $userPoints = 0; // if he is a guest he awards 0 points
            }
            
            $query->where('score', '<=', $userPoints);
            $query->where('status', 1); // only where the category it belongs to is active
        })->where('status', 1)
            ->orderByDesc('featured')
            ->orderByDesc('id')
            ->paginate($this->results_per_page);

        return view('index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => Settings::find('site_tagline')->value,
            'items' => $items,
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'setting_adv_top' => Settings::find('adv_top')->value,
            'setting_adv_bottom' => Settings::find('adv_bottom')->value,
            'adv_top' => Advertising::where('id', Settings::find('adv_top')->value)->first(),
            'adv_bottom' => Advertising::where('id', Settings::find('adv_bottom')->value)->first(),
            'story_preview_chars' => Settings::find('story_preview_chars')->value
        ]);
        
    }
    
    /**
     * Viral
     *
     * @return \Illuminate\Http\Response
     */
    public function viral()
    {
        
        // get hot items
        $items = Items::withCount('viral')
            ->whereHas('category', function ($query) {
                
                if(Auth::check()){
                    $userPoints = Auth::user()->total_point_count(); // if you are logged in, assign points to the current user
                } else {
                    $userPoints = 0; // if he is a guest he awards 0 points
                }

                $query->where('score', '<=', $userPoints);
                $query->where('status', 1);
            })->where('status', 1)
            ->orderByDesc('featured')
            ->orderByDesc('viral_count')
            ->paginate($this->results_per_page);
        
        return view('index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('main.viral'),
            'items' => $items,
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'story_preview_chars' => Settings::find('story_preview_chars')->value,
            'setting_adv_top' => Settings::find('adv_top')->value,
            'setting_adv_bottom' => Settings::find('adv_bottom')->value,
            'adv_top' => Advertising::where('id', Settings::find('adv_top')->value)->first(),
            'adv_bottom' => Advertising::where('id', Settings::find('adv_bottom')->value)->first(),
        ]);
        
    }
    
    /**
     * Random
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        
        // get hot items
        $items = Items::whereHas('category', function ($query) {
            
            if(Auth::check()){
                $userPoints = Auth::user()->total_point_count(); // if you are logged in, assign points to the current user
            } else {
                $userPoints = 0; // if he is a guest he awards 0 points
            }
            
            $query->where('score', '<=', $userPoints);
            $query->where('status', 1);
        })->where('status', 1)
            ->orderByDesc('featured')
            ->inRandomOrder()
            ->paginate($this->results_per_page);
        
        return view('index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('main.random'),
            'items' => $items,
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'story_preview_chars' => Settings::find('story_preview_chars')->value,
            'setting_adv_top' => Settings::find('adv_top')->value,
            'setting_adv_bottom' => Settings::find('adv_bottom')->value,
            'adv_top' => Advertising::where('id', Settings::find('adv_top')->value)->first(),
            'adv_bottom' => Advertising::where('id', Settings::find('adv_bottom')->value)->first(),
        ]);
        
    }
    
    /**
     * Store New Post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(Settings::find('active_upload')->value == 0){
            toastr()->warning(__('main.new_entries_paused'));
            return redirect('/');
        }
        
        Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'story' => 'required|string|min:'.Settings::find('minimum_characters')->value.'|max:'.Settings::find('maximum_characters')->value,
            'tags' => 'nullable',
            'category_id' => 'required',
            'genders_id' => 'required',
            'age' => 'required'
        ])->validateWithBag('write');
  
        // if word censored is active
        if(Settings::find('words_censored')->value == 1) {
            
            $censor = new CensorWords;
            $badwords = $censor->setDictionary(base_path('/vendor/snipe/banbuilder/src/dict/dictionary.php'));
            $string = $censor->censorString($request->story)['clean'];
            
        } else {

            $string = $request->story;
        
        }
        //
        
        // create item
    	$create_item = Items::create([
            'title' => $request->title,
            'story' => $string,
            'slug' => Str::slug(request('title'), '-'),
            'status' => Settings::find('new_entries')->value,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'genders_id' => $request->genders_id,
            'age' => $request->age,
        ]);
        
        if($create_item == true){
            //** create tags
            $tags = explode(",", $request->tags);
            $create_item->tag($tags);
            
            if(Settings::find('status_points')->value == 1){
                if(Settings::find('status_points_new_entry')->value == 1){
                    Points::create([
                        'user_id' => Auth::id(),
                        'point_type' => "new_entry",
                        'score' => Settings::find('points_new_entry')->value,
                        'item_id' => $create_item->id
                    ]);
                }
            }
            
            if(Settings::find('new_entries')->value == 1){
            
                toastr()->success(__('main.toast_your_post_has_been_posted'));
                return redirect('/');
                
            } else {
                
                toastr()->warning(__('main.toast_post_in_moderation'));
                return redirect('/');
                
            }
            
            
        } else {
            toastr()->error(__('main.toast_there_are_problems_try_again'));
            return redirect('/')->withErrors($validator, 'write')->withInput();
        }
        
    }
    
    /**
     * Show Item
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        
        $item = Items::whereHas('category', function ($query) {
            
                if(Auth::check()){
                    $userPoints = Auth::user()->total_point_count(); // if you are logged in, assign points to the current user
                } else {
                    $userPoints = 0; // if he is a guest he awards 0 points
                }

                $query->where('score', '<=', $userPoints);
                $query->where('status', 1); 
            })->where('id', $id)
                ->where('slug', $slug)
                ->where('status', 1)
                ->firstOrFail();
        
        ItemsViews::createViewLog($item);
        
        // for Top User Widget
        $topUser = User::withSum('user_points_list', 'score')
            ->orderByDesc('user_points_list_sum_score')
            ->limit(5)
            ->get();
        
        return view('layouts.item.show')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => Str::limit($item->title, 30),
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'randomItems' => $this->itemsRandomOrder,
            'item' => $item,
            'setting_adv_top' => Settings::find('adv_top')->value,
            'setting_adv_bottom' => Settings::find('adv_bottom')->value,
            'adv_top' => Advertising::where('id', Settings::find('adv_top')->value)->first(),
            'adv_bottom' => Advertising::where('id', Settings::find('adv_bottom')->value)->first(),
            'statusPoints' => Settings::find('status_points')->value,
            'topUser' => $topUser
        ]);
    }
    
    /**
     * Delete Item By User
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_user_post($id){
        
        $item = Items::where('id', $id)
            ->firstOrFail();
        
        if(Auth::id() == $item->user_id || Auth::user()->isAdministrator()){

            $query = Items::find($item->id);

            if($query->delete() == true){
                toastr()->success(__('main.toast_post_deleted'));
                return redirect('/');
            } else {
                toastr()->error(__('main.toast_there_are_problems_try_again'));
                return redirect('/');
            }
            
        } else {
            
            toastr()->error(__('main.not_your_secret'));
            return back();
            
        }
        
    }
    
    /**
     * Search
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        
        $request->validate([
            'key' => 'required',
        ]);
        
        // get items list
        if($request->has('key')) {
            
            $items = Items::whereHas('category', function ($query) {
                
                    if(Auth::check()){
                        $userPoints = Auth::user()->total_point_count(); // if you are logged in, assign points to the current user
                    } else {
                        $userPoints = 0; // if he is a guest he awards 0 points
                    }

                    $query->where('score', '<=', $userPoints);
                    $query->where('status', 1); 
                })->search($request->key)
                ->where('status', 1)
                ->orderByDesc('featured')
                ->orderByDesc('id')
                ->paginate($this->results_per_page);
            
        }

        return view('search')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => $request->key,
            'items' => $items,
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'story_preview_chars' => Settings::find('story_preview_chars')->value
        ]);
    }

    /**
     * Like System
     *
     * @return \Illuminate\Http\Response
     */
    function save_like(Request $request){
        
        $item = Items::findOrFail($request->item);
        
        if(Auth::user()->hasLiked($item)) {
            
            Auth::user()->unlike($item);
            
            return response()->json([
                'bool'=>false
            ]);

        } else {
            
            $like = Auth::user()->like($item);
            
            $create = Notifications::create([
                'sender_id' => Auth::id(),
                'recipient_id' => $item->user_id,
                'item_id' => $item->id,
                'notification_type' => "like",
                'like_id' => Auth::user()->likes()->with('likeable')->first()->id,
                'seen' => 2,
            ]);
            
            if($create == true){
                if(Settings::find('status_points')->value == 1){
                    if(Settings::find('status_points_like')->value == 1){
                        Points::create([
                            'user_id' => Auth::id(),
                            'point_type' => "like",
                            'score' => Settings::find('points_like')->value,
                            'item_id' => $item->id,
                            'like_id' => Auth::user()->likes()->with('likeable')->first()->id,
                        ]);
                    }
                }
            }
            
            return response()->json([
                'bool' => true
            ]);
            
        }
    }
    
    /**
     * Favorite System
     *
     * @return \Illuminate\Http\Response
     */
    function save_favorite(Request $request){
        
        $item = Items::findOrFail($request->item);
        
        if($request->user()->hasFavorited($item)) {
            
            $request->user()->unfavorite($item);
            
            return response()->json([
                'bool'=>false
            ]);

        } else {
            
            $request->user()->favorite($item);
            
            return response()->json([
                'bool'=>true
            ]);
        }
        
    }
    
    /**
     * Report
     * @id
     *
     */
    public function report($id)
    {
        
    	$report = Reports::create([
            'user_id' => Auth::id(),
            'item_id' => $id,
        ]);
        
        if($report == true){
            toastr()->warning(__('main.toast_your_report_has_been_sent'));
            return redirect('/');
        } else {
            toastr()->error(__('main.toast_there_are_problems_try_again'));
            return back();
        }
        
    }
    
}