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
            //行ごとにアンエスケープ処理を行う

            if ($block['type'] === 'paragraph' || $block['type'] === 'header')
            {
                $block['data']['text'] = html_entity_decode($block['data']['text']);
            }
            elseif ($block['type'] === 'warning')
            {
                $block['data']['title'] = html_entity_decode($block['data']['title']);
                $block['data']['message'] = html_entity_decode($block['data']['message']);
            }
        }

        return $content;
    }

    // contentミューテタの定義
    public function setContentAttribute($value)
    {
        $content = json_decode($value, true);

        foreach ($content['blocks'] as &$block) {
            //行ごとにエスケープ処理を行う

            if ($block['type'] === 'paragraph' || $block['type'] === 'header')
            {
                $block['data']['text'] = htmlspecialchars($block['data']['text'], ENT_QUOTES, 'UTF-8');
            }
            elseif($block['type'] === 'warning')
            {
                $block['data']['title'] = htmlspecialchars($block['data']['title'], ENT_QUOTES, 'UTF-8');
                $block['data']['message'] = htmlspecialchars($block['data']['message'], ENT_QUOTES, 'UTF-8');
            }
        }

        $this->attributes['content'] = json_encode($content, JSON_UNESCAPED_UNICODE);
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
