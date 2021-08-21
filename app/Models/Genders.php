<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genders extends Model
{
    
    protected $fillable = ['name', 'description', 'bg_color', 'slug'];
    
}