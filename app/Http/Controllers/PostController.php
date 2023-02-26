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

        foreach($posts as $post)
        {
            $post->content = json_decode($post->content, true);
        }

        return view('home', ['posts' => $posts]);
    }

    public function create()
    {
        $tags = Tag::all();
        return view('post/create', compact('tags'));
    }

    public function store(PostStoreRequest $request)
    {
        try {
            //ユーザーモデルインスタンスの取得
            $user = Auth::user();

            //リクエストのcontentの内容をデコード（JSON文字列⇨配列）
            $decodedData = json_decode($request->input('content'), true);
            //配列から、Blocksプロパティのみを取り出す
            $blocks = $decodedData['blocks'];

            //連想配列化
            $content = [
                'blocks' => $blocks,
            ];

            //エンコード（連想配列⇨JSON形式）
            $contentJson = json_encode($content, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);
            
            //DBに保存
            $post = $user->posts()->create([
                'title' => $request->input('title'),
                'content' => $contentJson,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Post created successfully'
            ]);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ]);
        }


        // //バリデーションをかけた投稿内容と、その投稿主のログインidを取得
        // $validatedData = ($request->validated() + ['user_id' => Auth::id()]);
        // //それらをPostテーブルに登録
        // $post = Post::create($validatedData);
        
        // //DBに保存
        // $tag = Tag::firstOrCreate([
        //     'tag_label' => $request->input('tag_label')
        // ]);

        // //tag_postの中間テーブルに保存
        // $post->tags()->sync($tag->id);

        // return to_route('home');
    } 

    public function search(Request $request)
    {
        $posts = Post::where('title', 'like', "%{$request->search}%")
                 ->orwhere('content', 'like', "%{$request->search}%")
                 ->paginate(5);

            //クエリパラメータの値を取得
            $tag = $request->query('tag');

            //クエリパラメータの値と同じタグを持つポストを取得してページネーション
            $posts = Post::whereHas('tags', function ($query) use ($tag) 
            {
                $query->where('tag_label', $tag);
            })->paginate(5);

            return view('post.tag.show', compact('posts'));
    }

    public function show($id) {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

    public function update($id) {
        $post = Post::find($id);
        // dd($post);

        return view('/post/update', compact('post'));
    }

    public function edit($id) {
        $post = Post::find($id);

        return view('post.edit', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('home')->with('success', '投稿が削除されました');
    }

}
