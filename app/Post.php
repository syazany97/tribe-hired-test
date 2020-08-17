<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $hidden = ['id', 'title', 'body'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
