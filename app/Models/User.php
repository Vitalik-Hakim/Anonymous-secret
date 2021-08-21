<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Overtrue\LaravelLike\Traits\Liker;
use Overtrue\LaravelFavorite\Traits\Favoriter;

use App\Models\Items;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use HasRoles;
    use Liker;
    use Favoriter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'website',
        'avatar',
        'genders_id',
        'birth',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function isAdministrator() {
        return $this->roles()->where('name', 'admin')->exists();
    }
    
    public function all_notifications()
    {
        return $this->hasMany(Notifications::class, 'recipient_id')
            ->orderByDesc('created_at')
            ->paginate(30);
    }
    
    public function notifications(){
        return $this->hasMany(Notifications::class, 'recipient_id')
            ->orderByDesc('created_at')
            ->take(15)
            ->get();
    }
    
    public function notification_count(){
        return $this->hasMany(Notifications::class, 'recipient_id')
            ->where('seen', 2)
            ->orderByDesc('created_at')
            ->count();
    }
    
    public function mark_as_read(){
        return $this->hasMany(Notifications::class, 'recipient_id')->update(['seen' => 1]);
    }
    
    public function gender(){
        return $this->belongsTo(Genders::class, 'genders_id');
    }
    
    // profile
    public function items(){
        return $this->hasMany(Items::class)->whereHas('category', function ($query) {
            $query->where('status', 1); 
        })->where('status', 1)->orderByDesc('id')->paginate(15);
        
    }
    
    public function comments(){
        return $this->hasMany(Comments::class);
    }
    
    // used to retrieve all posts by a user
    public function all_posts_user(){
        return $this->hasMany(Items::class);
    }
    
    public function user_points_list(){
        return $this->hasMany(Points::class)->whereHas('item', function ($query) {
            $query->where('status', 1); 
        });
    }
    
    public function total_point_count(){
        return $this->hasMany(Points::class)->whereHas('item', function ($query) {
            $query->where('status', 1); 
        })->sum('score');
    }
    
}