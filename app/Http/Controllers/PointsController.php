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
use App\Models\Points;

class PointsController extends Controller
{
    
    public function __construct()
    {
        $this->categories = Categories::where('status', 1)->get();
        $this->pages = Pages::where('status', 1)->get();
    }
    
    public function points_section()
    {
        
        return view('layouts.points.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => __("points.points_title"),
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'points' => Auth::user()->user_points_list()->orderByDesc('id')->paginate(25),
            'statusPoints' => Settings::find('status_points')->value
        ]);
        
    }
    
}