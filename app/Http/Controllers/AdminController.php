<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Image;
use Carbon\Carbon;
use App\Models\Settings;
use App\Models\Items;
use App\Models\Comments;
use App\Models\Likes;
use App\Models\User;
use App\Models\Categories;
use App\Models\Genders;
use App\Models\Pages;
use App\Models\Reports;
use App\Models\ItemsViews;
use App\Models\Notifications;
use \Conner\Tagging\Taggable;
use Overtrue\LaravelLike\Traits\Likeable;
use App\Models\Advertising;
use App\Models\Badges;

class AdminController extends Controller
{
    
    use Likeable;
    
    public function __construct()
    {
        $this->categories = Categories::where('status', 1)->get();
        $this->most_used_tags = \Conner\Tagging\Model\Tag::where('count', '>=', 2)->get();
    }
    
    /**
     * Dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.dashboard')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Dashboard'),
            'lastRegisteredUsers' => User::orderByDesc('id')
            ->limit(25)
            ->get()
        ]);
        
    }
    
    /**
     * Users
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {

        return view('admin.users.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Users'),
            'users' => User::orderByDesc('id')->paginate(35)
        ]);
        
    }
    
    /**
     * @edit User
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_user($id)
    {

        return view('admin.users.edit_user')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Edit User'),
            'user' => User::find($id),
            'roles' => \Spatie\Permission\Models\Role::all()
        ]);
        
    }
    
    /**
     * @store Edit User
     *
     * @return \Illuminate\Http\Response
     */
    public function update_edit_user(Request $request, $id)
    {
        
        if(!empty(request('new_password'))){
            $this->validate($request, [
                'new_password' => 'required|min:8',
                'new_confirm_password' => 'same:new_password',
            ]);
            
            $update = User::where('id', $id)
                ->update([
                    'password' => bcrypt(request('new_password'))
                ]);
            
            if($update == true)
            {
                toastr()->success('User password updated.');
                return redirect('/admin/users');
            } else 
            {
                toastr()->danger('We encountered some problems, please try again.');
                return back();
            }
            
        }

        $request->validate([
            'name' => 'required|max:150|alpha_dash|unique:users,name,'.$id,
            'email' => 'required|unique:users,email,'.$id,
        ]);
        
        $update = User::where('id', $id)
            ->update([
            'name' => request('name'),
            'email' => request('email')
        ]);

        // role
        User::find($id)
            ->roles()
            ->detach();
        
        User::find($id)
            ->roles()
            ->attach(\Spatie\Permission\Models\Role::where('name', request('role'))
                     ->first());
            
        if($update == true){
            
            toastr()->success('Updated user details');
            return redirect('/admin/users');
            
        } else {
            
            toastr()->danger('We encountered some problems, please try again.');
            return back();
            
        }
        
    }
    
    /**
     * @delete User
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_user($id)
    {
        
        $user = User::where('id', $id);

        if($user->exists()){
            // remove his avatar
            if(!empty($user->avatar)) {
                File::delete('storage/app/public/images/avatar/'.$user->avatar);
            }
            
            User::where('id', $id)->delete();
            
            toastr()->success('User successfully deleted.');
            return redirect()->action([AdminController::class, 'users']);
            
        } else {
            toastr()->error('We encountered some problems, please try again.');
            return back();
        }
        
    }
    
    /**
     * Posts
     *
     * @return \Illuminate\Http\Response
     */
    public function posts()
    {

        return view('admin.posts.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Posts'),
            'posts' => Items::orderByDesc('id')->paginate(35)
        ]);
        
    }
    
    /**
     * Edit Post
     * @id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_post($id)
    {

        return view('admin.posts.edit_post')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Edit Post'),
            'post' => Items::find($id),
            'categories' => Categories::all(),
            'genders' => Genders::all()
        ]);
        
    }
    
    /**
     * @store Edit Post
     *
     * @return \Illuminate\Http\Response
     */
    public function update_edit_post(Request $request, $id)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'story' => 'required|string|max:400',
            'category' => 'required',
            'genders_id'
        ]);
        
        $item = Items::where('id', $id)->firstOrFail();
        
        $item->title = $request->title;
        $item->story = $request->story;
        $item->slug = Str::slug($request->title, '-');
        $item->category_id = $request->category;
        $item->genders_id = $request->genders_id;
        
        if($item->save() == true){
            toastr()->success("Post updated successfully.");
            return back();
        } else {
            toastr()->error("There were some problems, try again.");
            return back();
        }
        
    }
    
    /**
     * Delete Tag
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_tag($id, $tag)
    {
        
        $item = Items::find($id);
        $item->untag($tag);
        toastr()->success("Tag removed.");
        return back();
  
    }
    
    /**
     * Delete Post
     * @id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_post($id)
    {
        
        $item = Items::where('id', $id);
          
        if($item->delete() == true){
            
            toastr()->success('Post successfully deleted.');
            return redirect()->route('posts');
            
        } else {
            
            toastr()->error('We encountered some problems, please try again.');
            return back();
            
        }
        
    }
    
    /**
     * Update Status Post
     *
     * @return \Illuminate\Http\Response
     */
    public function update_status_post(Request $request){
        
        $post = Items::findOrFail($request->input('item_id'));
        
        if($post->status == 1){
            
            Items::where('id', $request->input('item_id'))
                ->update([
                    'status' => 2
                ]);

            return response()->json([
                'bool'=>false
            ]);
            
        } else {
            
            Items::where('id', $request->input('item_id'))
                ->update([
                    'status' => 1
                ]);
            
            return response()->json([
                'bool'=>true
            ]);
            
        }
 
    }
    
    /**
     * Genders
     *
     * @return \Illuminate\Http\Response
     */
    public function genders()
    {

        return view('admin.genders.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Genders'),
            'genders' => Genders::orderByDesc('id')->paginate(35)
        ]);
        
    }
    
    /**
     * Create New Gender
     *
     * @return \Illuminate\Http\Response
     */
    public function create_gender()
    {
        return view('admin.genders.create_gender')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Create Gender')
        ]);
        
    }
    
    /**
     * Store New Gender
     *
     * @return \Illuminate\Http\Response
     */
    public function store_new_gender(Request $request){
        
        $request->validate([
            'name' => 'required|unique:genders',
            'description' => 'required',
            'bg_color' => 'required',
        ]);
        
        $create = Genders::create([
            'name' => Request('name'),
            'description' => Request('description'),
            'bg_color' => Request('bg_color'),
            'slug' => Str::slug(request('name'), '-')
        ]);
        
        if($create == true){
            toastr()->success('The gender has been created.');
            return redirect()->action([AdminController::class, 'genders']);
        } else {
            toastr()->danger('We encountered some problems, please try again.');
            return redirect()->action([AdminController::class, 'genders']);
        }
        
    }
    
    /**
     * Edit Gender
     * @id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_gender($id)
    {

        return view('admin.genders.edit_gender')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Edit Gender'),
            'gender' => Genders::find($id)
        ]);
        
    }
    
    /**
     * @store Edit Gender
     *
     * @return \Illuminate\Http\Response
     */
    public function update_edit_gender(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|string|max:255|unique:genders,name,'.$id,
            'description' => 'required|string|max:255',
            'bg_color' => 'required'
        ]);
        
        $gender = Genders::where('id', $id)->firstOrFail();
        $gender->name = $request->name;
        $gender->description = $request->description;
        $gender->bg_color = $request->bg_color;
        $gender->slug = Str::slug($request->name, '-');
        
        if($gender->save() == true){
            toastr()->success("The gender has been updated.");
            return back();
        } else {
            toastr()->error("There were some problems, try again.");
            return back();
        }
        
    }
    
    /**
     * Delete Gender
     * @id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_gender($id)
    {
        
        $query = Genders::find($id);
        
        if($query->exists()){
            
            $query->delete();
            
            toastr()->success('Gender successfully deleted.');
            return redirect()->action([AdminController::class, 'genders']);
            
        } else {
            
            toastr()->error('There are problems, try again.');
            return redirect()->action([AdminController::class, 'genders']);
            
        }
        
    }
    
    
    
    /**
     * Categories
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {

        return view('admin.categories.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Categories'),
            'categories' => Categories::orderByDesc('id')->paginate(35)
        ]);
        
    }
    
    /**
     * Create New Category
     *
     * @return \Illuminate\Http\Response
     */
    public function create_category()
    {
        return view('admin.categories.create_category')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Create Category')
        ]);
        
    }
    
    /**
     * Store New Category
     *
     * @return \Illuminate\Http\Response
     */
    public function store_new_category(Request $request){
        
        $request->validate([
            'name' => 'required|unique:categories',
            'description' => 'required',
            'score' => 'required|numeric|min:0|max:1000000000'
        ]);
        
        $create = Categories::create([
            'name' => Request('name'),
            'description' => Request('description'),
            'slug' => Str::slug(Request('name'), '-'),
            'score' => Request('score')
        ]);
        
        if($create == true){
            toastr()->success('The category has been created.');
            return redirect()->action([AdminController::class, 'categories']);
        } else {
            toastr()->danger('We encountered some problems, please try again.');
            return redirect()->action([AdminController::class, 'categories']);
        }
        
    }
    
    /**
     * Edit Category
     * @id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_category($id)
    {

        return view('admin.categories.edit_category')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Edit Category'),
            'category' => Categories::find($id)
        ]);
        
    }
    
    /**
     * @store Edit Category
     *
     * @return \Illuminate\Http\Response
     */
    public function update_edit_category(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$id,
            'description' => 'required|string|max:255',
            'status' => 'required',
            'score' => 'required|numeric|min:0|max:1000000000'
        ]);
        
        $category = Categories::where('id', $id)->firstOrFail();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = Str::slug($request->name, '-');
        $category->status = $request->status;
        $category->score = $request->score;
        
        if($category->save() == true){
            toastr()->success("The category has been updated.");
            return back();
        } else {
            toastr()->error("There were some problems, try again.");
            return back();
        }
        
    }
    
    /**
     * Delete Category
     * @id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_category($id)
    {
        
        $query = Categories::find($id);
        
        if($query->exists()){
            
            $query->delete();
            
            toastr()->success('Category successfully deleted.');
            return redirect()->action([AdminController::class, 'categories']);
            
        } else {
            
            toastr()->error('There are problems, try again.');
            return redirect()->action([AdminController::class, 'categories']);
            
        }
        
    }
    
    /**
     * Comments
     *
     * @return \Illuminate\Http\Response
     */
    public function comments()
    {

        return view('admin.comments.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Comments'),
            'comments' => Comments::orderByDesc('id')->paginate(35)
        ]);
        
    }
    
    /**
     * Edit Comment
     * @id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_comment($id)
    {

        return view('admin.comments.edit_comment')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Edit Comment'),
            'comment' => Comments::find($id)
        ]);
        
    }
    
    /**
     * @store Edit Comment
     *
     * @return \Illuminate\Http\Response
     */
    public function update_edit_comment(Request $request, $id)
    {
        
        $request->validate([
            'comment' => 'required|max:255',
            'status' => 'required'
        ]);
        
        $comment = Comments::where('id', $id)->firstOrFail();
        $comment->comment_text = $request->comment;
        $comment->status = $request->status;
        
        if($comment->save() == true){
            toastr()->success("The comment has been updated.");
            return back();
        } else {
            toastr()->error("There were some problems, try again.");
            return back();
        }
        
    }
    
    /**
     * Delete Comment
     * @id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_comment($id)
    {
        
        $comment = Comments::find($id);
        
        if($comment->delete() == true){
            toastr()->success("The comment has been deleted.");
            return back();
        } else {
            toastr()->error("There were some problems, try again.");
            return back();
        }
        
    }
    
    /**
     * Pages
     *
     * @return \Illuminate\Http\Response
     */
    public function pages()
    {

        return view('admin.pages.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Pages'),
            'pages' => Pages::orderByDesc('id')->paginate(35)
        ]);
        
    }
    
    /**
     * Edit Page
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_page($id)
    {
        
        return view('admin.pages.edit_page')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Edit Page'),
            'page' => Pages::find($id)
        ]);
        
    }
    
    /**
     * @store Edit Page
     *
     * @return \Illuminate\Http\Response
     */
    public function update_edit_page(Request $request, $id)
    {
        
        $request->validate([
            'title' => 'required|unique:pages,title,'.$id,
            'body' => 'required',
            'status' => 'required',
        ]);
        
        $page = Pages::where('id', $id)->firstOrFail();
        $page->title = $request->title;
        $page->body = $request->body;
        $page->slug = Str::slug($request->title, '-');
        $page->status = $request->status;
        
        if($page->save() == true){
            toastr()->success("The page has been updated.");
            return back();
        } else {
            toastr()->error("There were some problems, try again.");
            return back();
        }
        
    }
    
    /**
     * Create New Page
     *
     * @return \Illuminate\Http\Response
     */
    public function create_page()
    {
        return view('admin.pages.create_page')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Create Page')
        ]);
        
    }
    
    /**
     * Store New Page
     *
     * @return \Illuminate\Http\Response
     */
    public function store_new_page(Request $request){
        
        $request->validate([
            'title' => 'required|unique:pages,title',
            'body' => 'required',
            'status' => 'required',
        ]);
        
        $create = Pages::create([
            'title' => Request('title'),
            'body' => Request('body'),
            'slug' => Str::slug(request('title'), '-'),
            'status' => Request('status'),
        ]);
        
        if($create == true){
            toastr()->success('The page has been created.');
            return redirect()->action([AdminController::class, 'pages']);
        } else {
            toastr()->danger('We encountered some problems, please try again.');
            return redirect()->action([AdminController::class, 'pages']);
        }
        
    }
    
    /**
     * Delete Page
     * @id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_page($id)
    {
        
        $page = Pages::find($id);
        
        if($page->delete() == true){
            toastr()->success("The page has been deleted.");
            return back();
        } else {
            toastr()->error("There were some problems, try again.");
            return back();
        }
        
    }
    
    /**
     * Reports
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {

        return view('admin.reports.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Reports'),
            'reports' => Items::whereHas('reports', function ($query) {
            })->orderByDesc('id')->paginate(35)
        ]);
        
    }
    
    /**
     * Delete Report
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_report($id)
    {
        
        $report = Reports::find($id);
        
        if($report->delete() == true){
            toastr()->success("The report has been deleted.");
            return back();
        } else {
            toastr()->error("There were some problems, try again.");
            return back();
        }
        
    }
    
    /**
     * Advertising
     *
     * @return \Illuminate\Http\Response
     */
    public function advertising()
    {

        return view('admin.advertising.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Advertising'),
            'settings' => Settings::first(),
            'advertising' => Advertising::orderByDesc('id')->paginate(25)
        ]);
        
    }
    
    /**
     * Create New Advertising
     *
     * @return \Illuminate\Http\Response
     */
    public function create_advertising()
    {
        return view('admin.advertising.create_advertising')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Create Advertising')
        ]);
        
    }
    
    /**
     * Store New Advertising
     *
     * @return \Illuminate\Http\Response
     */
    public function store_new_advertising(Request $request){
        
        $request->validate([
            'name' => 'required|max:255',
            'advertising' => 'required',
            'status' => 'required|boolean',
        ]);
        
        $create = Advertising::create([
            'name' => Request('name'),
            'value' => Request('advertising'),
            'status' => request('status')
        ]);
        
        if($create == true){
            toastr()->success('The advertising has been created.');
            return redirect()->action([AdminController::class, 'advertising']);
        } else {
            toastr()->danger('We encountered some problems, please try again.');
            return redirect()->action([AdminController::class, 'advertising']);
        }
        
    }
    
    /**
     * Edit Advertising
     * @id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_advertising($id)
    {

        return view('admin.advertising.edit_advertising')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Edit Advertising'),
            'advertising' => Advertising::where('id', $id)->firstOrFail()
        ]);
        
    }
    
    /**
     * @store Edit Advertising
     *
     * @return \Illuminate\Http\Response
     */
    public function update_edit_advertising(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|max:255',
            'advertising' => 'required',
            'status' => 'required|boolean',
        ]);
        
        $adv = Advertising::where('id', $id)->firstOrFail();
        $adv->name = $request->name;
        $adv->value = $request->advertising;
        $adv->status = $request->status;
        
        if($adv->save() == true){
            toastr()->success("The advertising has been updated.");
            return back();
        } else {
            toastr()->error("There were some problems, try again.");
            return back();
        }
        
    }
    
    public function delete_advertising($id){
        
        if($id == Settings::find('adv_top')->value || $id == Settings::find('adv_bottom')->value){
            toastr()->info('This advertisement is currently in use, please remove it first from Settings->Advertising.');
            return redirect()->action([AdminController::class, 'advertising']);
        }
        
        $adv = Advertising::where('id', $id);
        
        if($adv->delete() == true){
            toastr()->success('The advertising has been removed.');
            return redirect()->action([AdminController::class, 'advertising']);
        } else {
            toastr()->danger('We encountered some problems, please try again.');
            return redirect()->action([AdminController::class, 'advertising']);
        }
            
        
    }
    
    /**
     * Points
     *
     * @return \Illuminate\Http\Response
     */
    public function points()
    {

        return view('admin.points.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('points.points_title'),
            'settings' => Settings::first(),
            'badges' => Badges::all()
        ]);
        
    }
    
    public function update_points(Request $request){
        
        $request->validate([
            'status_points_new_entry' => 'required',
            'status_points_like' => 'required',
            'status_points_comments' => 'required',
            'points_new_entry' => 'required|numeric|min:1',
            'points_like' => 'required|numeric|min:1',
            'points_comments' => 'required|numeric|min:1',
        ]);
        
        foreach($request->all() as $key => $value) {
            $update = Settings::where('name', $key)->update([
                'value' => $value
            ]);
        }
        
        if($update == true){
            toastr()->success('Points system updated!');
            return redirect()->action([AdminController::class, 'points']);
        } else {
            toastr()->danger('We encountered some problems, please try again.');
            return redirect()->action([AdminController::class, 'points']);
        }
        
    }
    
    /**
     * Badges
     *
     * @return \Illuminate\Http\Response
     */
    public function badges()
    {

        return view('admin.points.badges.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Badges'),
            'settings' => Settings::first(),
            'badgeList' => Badges::orderByDesc('score')->paginate(25)
        ]);
        
    }
    
    /**
     * Create New Badge
     *
     * @return \Illuminate\Http\Response
     */
    public function create_badge()
    {
        return view('admin.points.badges.create_badge')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Create Badge')
        ]);
        
    }
    
    /**
     * Store New Badge
     *
     * @return \Illuminate\Http\Response
     */
    public function store_new_badge(Request $request){
        
        $request->validate([
            'name' => 'required|max:255',
            'score' => 'required|min:1',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
        
        if(!empty(request('icon'))){
            
            $imageName = Str::random(24).'.'.$request->file('icon')->extension();
            $destinationPath = 'storage/app/public/images/badges';

            $img = Image::make($request->file('icon')->path());
            $img->save($destinationPath.'/'.$imageName);
            
            $create = Badges::create([
                'name' => Request('name'),
                'score' => Request('score'),
                'icon' => $imageName
            ]);

            if($create == true){
                toastr()->success('The Badge has been created.');
                return redirect()->action([AdminController::class, 'badges']);
            } else {
                toastr()->danger('We encountered some problems, please try again.');
                return redirect()->action([AdminController::class, 'badges']);
            }
                   
        }
        
    }
    
    public function delete_badge($id){
        
        $badge = Badges::find($id);
        
        // delete storage file
        File::delete('storage/app/public/images/badges/'.$badge->icon);

        $delete = Badges::where('id', $id)->delete();

        if($delete == true){
            toastr()->success('The badge has been removed.');
            return redirect()->action([AdminController::class, 'badges']);
        } else {
            toastr()->danger('We encountered some problems, please try again.');
            return redirect()->action([AdminController::class, 'badges']);
        }
    }
    
    /**
     * Edit Badge
     * @id
     *
     */
    public function edit_badge($id)
    {

        return view('admin.points.badges.edit_badge')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Edit Badge'),
            'badge' => Badges::find($id)
        ]);
        
    }
    
    /**
     * @store Edit Badge
     *
     * @return \Illuminate\Http\Response
     */
    public function update_edit_badge(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'score' => 'required|min:1'
        ]);
        
        $badge = Badges::where('id', $id)->firstOrFail();
        $badge->name = $request->name;
        $badge->score = $request->score;
        
        if(!empty(request('icon'))){
            
            $request->validate([
                'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
            if(!empty($badge->icon)){
                $delete = File::delete('storage/app/public/images/badges/'.$badge->icon);
            }
            
            $imageName = Str::random(24).'.'.$request->file('icon')->extension();
            $destinationPath = 'storage/app/public/images/badges';

            $img = Image::make($request->file('icon')->path());
            $img->save($destinationPath.'/'.$imageName);
            
            $update = Badges::where('id', $badge->id)->update([
                'icon' => $imageName
            ]);
                   
        } 
        
        if($badge->save() == true){
            toastr()->success("The Badge has been updated.");
            return back();
        } else {
            toastr()->error("There were some problems, try again.");
            return back();
        }
        
    }
    
    /**
     * Settings
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {

        return view('admin.settings.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __('Settings'),
            'settings' => Settings::first(),
            'advertising' => Advertising::orderByDesc('id')->get()
        ]);

    }
    
    public function update_settings(Request $request){
        
        $request->validate([
            'site_name' => 'required',
            'site_tagline' => 'required',
            'site_description' => 'required',
            'results_per_page' => 'required|numeric|min:1',
            'new_entries' => 'required',
            'random_items' => 'required|numeric',
            'random_users' => 'required|numeric',
            'active_upload' => 'required|boolean',
            'alert_reports' => 'required|numeric',
            'adv_top' => 'nullable',
            'adv_bottom' => 'nullable',
        ]);
        
        // logo
        if(!empty(request('logo_image'))){
            
            $request->validate([
                'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=150,max_height=40|max:2048',
            ]);
            
            if(!empty(Settings::find('logo_image')->value)){
                $delete = File::delete('storage/app/public/images/logo/'.Settings::find('logo_image')->value);
            }
            
            $imageName = Str::random(24).'.'.$request->file('logo_image')->extension();
            $destinationPath = 'storage/app/public/images/logo';

            $img = Image::make($request->file('logo_image')->path());
            $img->save($destinationPath.'/'.$imageName);
            
            $update = Settings::where('name', 'logo_image')->update([
                'value' => $imageName
            ]);

            
            if($update == true){
                toastr()->success('Logo Updated.');
                return redirect()->action([AdminController::class, 'settings']);
            } else {
                toastr()->danger('We encountered some problems, please try again.');
                return redirect()->action([AdminController::class, 'settings']);
            }
                   
        }
        // end logo
        
        // favicon
        if(!empty(request('favicon'))){
            
            $request->validate([
                'favicon' => 'nullable|image|mimes:jpg,png,jpeg|dimensions:max_width=150,max_height=150|max:2048',
            ]);
            
            if(!empty(Settings::find('favicon')->value)){
                $delete = File::delete('storage/app/public/images/logo/favicon'.Settings::find('favicon')->value);
            }
            
            $imageName = Str::random(24).'.'.$request->file('favicon')->extension();
            $destinationPath = 'storage/app/public/images/logo/favicon';

            $img = Image::make($request->file('favicon')->path());
            $img->resize(16, 16, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$imageName);

            $update = Settings::where('name', 'favicon')->update([
                'value' => $imageName
            ]);

            
            if($update == true){
                toastr()->success('Favicon Updated.');
                return redirect()->action([AdminController::class, 'settings']);
            } else {
                toastr()->danger('We encountered some problems, please try again.');
                return redirect()->action([AdminController::class, 'settings']);
            }
                   
        }
        // end favicon

        foreach($request->all() as $key => $value) {
            $update = Settings::where('name', $key)->update([
                'value' => $value
            ]);
        }
        
        if($update == true){
            toastr()->success('Updated settings.');
            return redirect()->action([AdminController::class, 'settings']);
        } else {
            toastr()->danger('We encountered some problems, please try again.');
            return redirect()->action([AdminController::class, 'settings']);
        }
        
    }
    
    public function delete_logo(){
        
        if(!empty(Settings::find('logo_image')->value)){
            // delete file 
            File::delete('storage/app/public/images/logo/'.Settings::find('logo_image')->value);
            
            $delete_logo = Settings::where('name', 'logo_image')
                ->update([
                    'value' => NULL,
                ]);
            
            if($delete_logo == true){
                toastr()->success('The logo has been removed.');
                return redirect()->action([AdminController::class, 'settings']);
            } else {
                toastr()->danger('We encountered some problems, please try again.');
                return redirect()->action([AdminController::class, 'settings']);
            }
            
        } 
        else 
        {
            toastr()->danger('There is no logo.');
            return redirect()->action([AdminController::class, 'settings']);
        }
        
    }
    
    public function delete_favicon(){
        
        if(!empty(Settings::find('favicon')->value)){
            // delete file 
            File::delete('storage/app/public/images/logo/favicon/'.Settings::find('favicon')->value);
            
            $delete_favicon = Settings::where('name', 'favicon')
                ->update([
                    'value' => NULL,
                ]);
            
            if($delete_favicon == true){
                toastr()->success('The favicon has been removed.');
                return redirect()->action([AdminController::class, 'settings']);
            } else {
                toastr()->danger('We encountered some problems, please try again.');
                return redirect()->action([AdminController::class, 'settings']);
            }
            
        } 
        else 
        {
            toastr()->danger('There is no favicon.');
            return redirect()->action([AdminController::class, 'settings']);
        }
        
    }
    
    /**
     * Make Featured
     *
     */
    public function make_featured(Request $request){
        
        $post = Items::find($request->input('item_id'));
        
        if($post->featured == 0){
            
            $post->featured = 1;
            $post->save();
            
            return response()->json([
                'bool'=>true
            ]);
            
        } else {
            
            $post->featured = 0;
            $post->save();
            
            return response()->json([
                'bool'=>false
            ]);
            
        }
            
 
    }
    
}