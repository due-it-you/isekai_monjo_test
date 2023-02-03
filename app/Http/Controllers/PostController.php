<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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
        $post->name = $request->name;
        $post->title = $request->title;
        $post->content = $request->content;
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
