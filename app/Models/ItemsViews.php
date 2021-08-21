<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Models\Items;

class ItemsViews extends Model
{
    
    protected $table = 'items_views';
    
    protected $fillable = ['item_id', 'user_id'];
    
    //
    public function itemsView()
    {
        return $this->belongsTo(Items::class);
    }
    
    //
    public static function createViewLog($item) {

        $itemsViews= new ItemsViews;
        $itemsViews->item_id = $item->id;
        $itemsViews->user_id = (auth()->check())?auth()->id():null;
        $itemsViews->ip = request()->ip();
        $itemsViews->agent = request()->header('User-Agent');
        $itemsViews->save();
    }
    
}