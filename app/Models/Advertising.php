<?php
            
namespace App\Models;
            
use Illuminate\Database\Eloquent\Model;
            
class Advertising extends Model
{

   /**
   * The table associated with the model.
   *
   * @var string
   */
   protected $table = 'advertising';

   /**
   * The primary key associated with the table.
   *
   * @var string
   */
   protected $primaryKey = 'name';

   /**
   * Indicates if the model's ID is auto-incrementing.
   *
   * @var bool
   */
   public $incrementing = false;

   /**
   * The data type of the auto-incrementing ID.
   *
   * @var string
   */
   protected $keyType = 'string';

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = ['id', 'name', 'value', 'status'];

}