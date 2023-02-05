<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#使用するモデルの読み込み。
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $data = ['posts' => $posts];
        return view('home', $data);
    }

    public function create()
    {
        return view('post/create');
    }

    public function store(Request $request)
    {
        $post = new Post;
        #投稿内容の代入
        $post->user()->name = $request->user()->name;
        #入ってきたユーザーのidを取得して、ポストテーブルのuser_idに代入する。
        $post->user_id = $request->user()->id; 
        $post->title = $request->title;
        $post->content = $request->content;

        #タグの代入
        $post->tags()->tag_label = $request->tag_label;

        #全てを保存
        $post->save();
        return redirect()->route('home');
    } 

    public function search(Request $request)
    {
        $posts = Post::where('title', 'like', "%{$request->search}%")
                 ->orwhere('content', 'like', "%{$request->search}%")
                 ->paginate(5);

        return view('post.index', ['posts' => $posts]);
    }

}
