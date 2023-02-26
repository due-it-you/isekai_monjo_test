<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    // contentアクセサの定義
    public function getContentAttribute($value)
    {
        $content = json_decode($value, true);

        foreach ($content['blocks'] as &$block) {
            $block['data']['text'] = html_entity_decode($block['data']['text']);
        }

        return $content;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Post::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
