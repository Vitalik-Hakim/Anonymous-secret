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

class CategoriesController extends Controller
{
    
    public function __construct()
    {
        $this->categories = Categories::where('status', 1)->get();
        $this->pages = Pages::where('status', 1)->get();
    }
    
    public function navCategories($slug)
    {
        
        $getCategory = Categories::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
        
        if(Auth::check()){
            $this->userPoints = Auth::user()->total_point_count(); // if you are logged in, assign points to the current user
        } else {
            $this->userPoints = 0; // if he is a guest he awards 0 points
        }

        // get items list
        $items = Items::whereHas('category', function ($query) {
            $query->where('score', '<=', $this->userPoints);
            $query->where('status', 1); 
        })->where('status', 1)
            ->where('category_id', $getCategory->id)
            ->orderByDesc('featured')
            ->orderByDesc('id')
            ->paginate(15);
        
        return view('layouts.categories.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => $getCategory->name,
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'story_preview_chars' => Settings::find('story_preview_chars')->value,
            'getCategory' => $getCategory,
            'userPoints' => $this->userPoints,
            'items' => $items
        ]);
        
    }
    
}