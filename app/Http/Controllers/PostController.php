<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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
        $post->title = $request->name;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('home');
    } 
}
