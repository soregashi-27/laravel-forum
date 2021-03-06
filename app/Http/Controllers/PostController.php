<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ログイン認証処理

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
        //post.dirのindex.blade.phpが表示される
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // dd($request); //debug
        //(Auth::user()); // login中のUser情報が取れる

        $post = new Post; // newする_Instanceを作成する
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id();
        $post->timestamps = false; //一時追加（timestampなしで検証）

        $post->save(); //Instanceを保存する
        return redirect()->route('posts.index'); // web.phpで設定してるPostControllerにとんで表示させようとしてるviewファイルが動く
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id); // idを表示
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(Auth::id() !== $post->user_id) {
            return abort(404);
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if(Auth::id() !== $post->user_id) {
            return abort(404);
        }
        
        $post->title = $request->title;
        $post->body = $request->body;
        $post->timestamps = false; //一時追加（timestampなしで検証）

        $post->save(); //Instanceを保存する
        return redirect()->route('posts.index'); // web.phpで設定してるPostControllerにとんで表示させようとしてるviewファイルが動く
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(Auth::id() !== $post->user_id) {
            return abort(404);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}