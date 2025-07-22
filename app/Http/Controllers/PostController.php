<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
