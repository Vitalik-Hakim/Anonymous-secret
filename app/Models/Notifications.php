<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

class Notifications extends Model
{

    use Likeable;
    
    protected $fillable = ['sender_id', 'recipient_id', 'item_id', 'notification_type', 'like_id', 'comment_id', 'seen'];
    
    
}