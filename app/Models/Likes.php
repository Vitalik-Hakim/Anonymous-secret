<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Overtrue\LaravelLike\Traits\Likeable;

class Likes extends Model
{

    use Likeable;
    
    protected $fillable = ['user_id', 'likeable_type', 'likeable_id'];
    
}