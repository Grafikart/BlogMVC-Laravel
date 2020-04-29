<?php

namespace App;

use App\Facades\Markdown;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('sort', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'content', 'category_id', 'user_id',
    ];

    /**
     * Get the category of the post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the author of the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments of the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the markdown parsed content.
     * 
     * @return string
     */
    public function getHtmlAttribute()
    {
        return Markdown::parse($this->content);
    }

    /**
     * Get an excerpt of the post content
     * 
     * @return string
     */
    public function getExcerpt($words = 100, $ending = "...")
    {
        return Str::words(strip_tags($this->html), $words, $ending);
    }
}
