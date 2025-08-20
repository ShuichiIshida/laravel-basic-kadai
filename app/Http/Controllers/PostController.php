<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // postsテーブルからtitleとcontentのみを取得
        $posts = DB::table('posts')->select('title', 'content')->get();

        //posts.indexビューを表示
        //compact関数を使用してpostsをビューに渡す
        return view('posts.index', compact('posts'));
    }
    public function show($id)
    {
        $posts = Post::find($id);
        return view('posts.show', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //バリデーションを設定する
        $request->validate([
            'title' => 'required|max:20',
            'content' => 'required|max:200',
        ]);

        //データベースに保存する
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        //posts.indexビューを表示
        return redirect('/posts');
    }
}
