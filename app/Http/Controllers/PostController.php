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
        $posts = Post::all();
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
        
        if($request->has('tags'))
        {
           $post->tags()->attach($request->tags);
        }

        return to_route('post.create');
    } 

    public function search(Request $request)
    {
        $posts = Post::where('title', 'like', "%{$request->search}%")
                 ->orwhere('content', 'like', "%{$request->search}%")
                 ->paginate(5);

        return view('post.index', ['posts' => $posts]);
    }

}
