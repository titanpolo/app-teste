<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        //dd($posts);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        Post::create($request->all());
        //dd('Cadastrando um novo post...');
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        // $post=Post::where('id', $id)->first();
        // dd($post);
        //fazer verificação se esse valor existe
        if(!$post=Post::find($id)) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.show', compact('post'));
    }

    public function destroy($id)
    {
        if(!$post=Post::find($id)) {
            return redirect()->route('post.index');
        }

        $post->delete();

        return redirect()
                ->route('posts.index')
                ->with('message', 'Post Deletado com sucesso');

    }

}
