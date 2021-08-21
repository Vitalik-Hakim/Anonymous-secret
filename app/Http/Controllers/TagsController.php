<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Settings;
use App\Models\User;
use App\Models\Items;
use App\Models\Categories;
use App\Models\Pages;

class TagsController extends Controller
{
    
    public function __construct()
    {
        $this->categories = Categories::where('status', 1)->get();
        $this->pages = Pages::where('status', 1)->get();
        $this->results_per_page = Settings::find('results_per_page')->value;
    }
    
    // ***
    // fetch items with this tag
    // ***
    public function tag($slug)
    {
        // get items list
        $items = Items::whereHas('category', function ($query) {
            if(Auth::check()){
                $userPoints = Auth::user()->total_point_count(); // if you are logged in, assign points to the current user
            } else {
                $userPoints = 0; // if he is a guest he awards 0 points
            }
            
            $query->where('score', '<=', $userPoints);
            $query->where('status', 1); 
        })->withAnyTag([$slug])
            ->where('status', 1)
            ->orderByDesc('featured')
            ->orderByDesc('id')
            ->paginate($this->results_per_page);
        
        return view('layouts.tags.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => $slug,
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'story_preview_chars' => Settings::find('story_preview_chars')->value,
            'items' => $items,
            'tag' => $slug
        ]);
        
    }
    
}