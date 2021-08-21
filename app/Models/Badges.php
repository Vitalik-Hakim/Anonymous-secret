<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Badges extends Model
{
    
    protected $fillable = ['name', 'score', 'icon', 'item_id'];
    
}