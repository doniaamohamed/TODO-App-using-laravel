<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
class TaskImage extends Model
{
   protected $fillable = ['task_id', 'path'];
   public function task()
    {
        return $this->belongsTo(Task::class);
    }
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->path ? asset('storage/' . $this->path) : asset('images/default.png'),
        );
    }
}
