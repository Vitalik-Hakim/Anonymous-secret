<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Points extends Model
{
    
    protected $fillable = ['user_id', 'point_type', 'score', 'item_id', 'like_id', 'comment_id'];
    
    public function item(){
        return $this->belongsTo(Items::class, 'item_id');
    }
    
}