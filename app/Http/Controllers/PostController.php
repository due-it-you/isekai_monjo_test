<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\Request;
#使用するモデルの読み込み。
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Revision;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        //モデルのインスタンスを取得した（contentプロパティにアクセスした）ことで、Postモデルのアクセサが処理
        $posts = Post::paginate(5);

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
            // dd($request->input('content'));

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
            $contentJson = json_encode($content, JSON_UNESCAPED_UNICODE);
            
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

    public function update(PostUpdateRequest $request) {
        try {
            //ユーザーモデルインスタンスの取得
            $user = Auth::user();

            //更新対象の投稿のidを取得
            $postId = $request->input('postId');

            //更新対象の投稿のモデルインスタンスを取得
            $post = $user->posts()->find($postId);

            //リクエストのcontentの内容をデコード（JSON文字列⇨配列）
            $decodedData = json_decode($request->input('content'), true);

            //配列から、Blocksプロパティのみを取り出す
            $blocks = $decodedData['blocks'];

            //連想配列化
            $content = [
                'blocks' => $blocks,
            ];

            //エンコード（連想配列⇨JSON形式）
            $contentJson = json_encode($content, JSON_UNESCAPED_UNICODE);
            
            //現行の投稿内容を上書き
            $currentPost = $user->posts()->where('id', $postId)->update([
                'content' => $contentJson,
            ]);

            //更新内容の新規作成
            $revisionPost = $post->revisions()->create([
                'rev_content' => $contentJson, 
                'post_id' => $post->id,
                'user_id' => $user->id,
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
    }

    public function edit($id) {
        $post = Post::find($id);

        //投稿の取得
        //投稿の中からcontent（JSON）を取り出す
        //parse()にてJSON => Objectにする
        //EditContent.vue側に値を渡す
        

        return view('post.edit', ['post' => $post]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('home')->with('success', '投稿が削除されました');
    }

}
