<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
class Comment extends Model
{
    //  protected $fillable=['body','user_id','commentable_id', 'commentable_type'];
    protected $guarded = ["id"];

     public function user()
     {
      return $this->belongsTo(User::class, "user_id", "id");
     }

   public function commentable(): MorphTo
   {
    return $this->morphTo();
   }
   
}
