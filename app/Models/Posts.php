<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function comments()
    {
        return $this->hasMany(Comments::class,'on_post');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }
}
