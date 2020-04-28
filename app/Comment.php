<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'post_id', 'content',
    ];

    /**
     * Post of the comment
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the avatar image url from gravatar
     */
    public function getGravatarAttribute()
    {
        return "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm&s=100";
    }
}
