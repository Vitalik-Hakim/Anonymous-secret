<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    
    protected $fillable = ['user_id', 'favoritable_type', 'favoriteable_id'];
    
}