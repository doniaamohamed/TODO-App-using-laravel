<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
     protected $table = "tasks";

    protected $fillable = ["title", "description", "priority","status","due_date","user_id","created_at","updated_at","assignee_id"];
    public function comments(): MorphMany
    {
    return $this->morphMany(Comment::class, 'commentable');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    public function images() 
    {
    return $this->hasMany(TaskImage::class);
    }   
}
