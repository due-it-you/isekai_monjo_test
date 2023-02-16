<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use Illuminate\Http\Request;
#使用するモデルの読み込み。
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(5);
        $data = ['posts' => $posts];
        return view('home', $data);
    }

    public function create()
    {
        $tags = Tag::all();
        return view('post/create', compact('tags'));
    }

    public function store(PostStoreRequest $request)
    {
        $validatedData = ($request->validated() + ['user_id' => Auth::id()]);
        $post = Post::create($validatedData);
        
        //DBに保存
        $tag = Tag::firstOrCreate([
            'tag_label' => $request->input('tag_label')
        ]);

        //tag_postの中間テーブルに保存
        if($tag->wasRecentlyCreated)
        {
            $post->tags()->attach($tag->id);
        }
        else
        {
            $post->tags()->syncWithoutDetaching([$tag->id]);
        }

        $latestPost = Post::latest()->first(); // 最新の投稿を取得

        return to_route('home', ['post' => $latestPost]);
    } 

    public function search(Request $request)
    {
        $posts = Post::where('title', 'like', "%{$request->search}%")
                 ->orwhere('content', 'like', "%{$request->search}%")
                 ->paginate(5);

            $tag = $request->query('tag');

            $posts = Post::whereHas('tags', function ($query) use ($tag) 
            {
                $query->where('tag_label', $tag);
            })->get();

            return view('post.tag.show', compact('posts'));
        

        return view('post.index', ['posts' => $posts]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('home')->with('success', '投稿が削除されました');
    }

}
