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
use App\Models\Categories;
use App\Models\Pages;

class PagesController extends Controller
{
    
    public function __construct()
    {
        $this->categories = Categories::where('status', 1)->get();
        $this->pages = Pages::where('status', 1)->get();
    }
    
    // ***
    // get Pages
    // ***
    public function show_page($slug)
    {
        // get items list
        $page = Pages::where('slug', $slug)
            ->where('status', 1)
            ->orderByDesc('id')
            ->first();
        
        return view('layouts.pages.show')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => $page->title,
            'categories' => $this->categories,
            'pages' => $this->pages,
            'page' => $page,
            'status_write' => Settings::find('active_upload')->value,
        ]);
        
    }
    
}