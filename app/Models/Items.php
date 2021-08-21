<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use App\Traits\FullTextSearch;

class Items extends Model
{
    use FullTextSearch;
    use \Conner\Tagging\Taggable;
    use Likeable;
    use Favoriteable;
    
    /**
     * The columns of the full text index
     */
    protected $searchable = [
        'title',
        'story'
    ];
    
    protected $fillable = ['title', 'story', 'slug', 'status', 'user_id', 'category_id', 'genders_id', 'age', 'featured'];
    
    // Likes
    public function all_likes(){
        return $this->hasMany(Likes::class, 'likeable_id')->count();
    }
    
    //
    public function uploaded_by(){
        return $this->belongsTo(User::class, 'user_id', 'id')->first();
    }
    
    //
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function gender(){
        return $this->belongsTo(Genders::class, 'genders_id');
    }

    // 
    public function category(){
        return $this->belongsTo(Categories::class);
    }
    
    // 
    public function viral(){
        return $this->hasMany(ItemsViews::class, 'item_id');
    }
    
    //
    public function most_liked(){
        return $this->hasMany(Likes::class, 'likeable_id');
    }
    
    //
    public function most_commented(){
        return $this->hasMany(Comments::class, 'item_id');
    }
    
    // 
    public function favorited(){
        return $this->belongsTo(Favorites::class, 'id', 'favoriteable_id');
    }

    //
    public function item_category(){
        return $this->belongsTo(Categories::class, 'category_id')->first();
    }
    
    //
    public function comments(){
        return $this->hasMany(Comments::class, 'item_id')
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->get();
    }
    
    //
    public function itemView() {
        return $this->hasMany(ItemsViews::class, 'item_id')->count();
    }
    
    //
    public function reports(){
        return $this->hasMany(Reports::class, 'item_id');
    }
    
}