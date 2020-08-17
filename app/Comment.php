<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['postId', 'id', 'name', 'email', 'body'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
