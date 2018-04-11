<?php

namespace App;

use App\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @package App
 */
class Post extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'content', 'category_id', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return mixed
     */
    public function getHtmlAttribute()
    {
        return Markdown::parse($this->content);
    }

    /**
     * @param int $maxWords
     * @param string $ending
     *
     * @return string
     */
    public function getExcerpt($maxWords = 100, $ending = '...')
    {
        $text = strip_tags($this->html);
        $words = explode(' ', $text);

        if (count($words) > $maxWords) {
            return implode(' ', array_slice($words, 0, $maxWords)) . $ending;
        }

        return $text;
    }
}
