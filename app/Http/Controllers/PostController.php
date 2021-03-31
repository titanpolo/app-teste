<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(2);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }



    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if($request->image->isValid()){

            // configurando o nome da imagem para ser salva igual ao do título
            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }

        Post::create($data);
        // Post::create($request->all());
        return redirect()
                ->route('posts.index')
                ->with('message', 'Post Criado com sucesso');
    }

    public function show($id)
    {
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

        if(Storage::exists($post->image)){
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()
                ->route('posts.index')
                ->with('message', 'Post Deletado com sucesso');

    }

    public function edit($id)
    {
        //fazer verificação se esse valor existe
        if(!$post=Post::find($id)) {
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePost $request, $id)
    {
        //fazer verificação se esse valor existe
        if(!$post=Post::find($id)){
            return redirect()->back();
        }

        $data = $request->all();

        if($request->image &&  $request->image->isValid()){

            //se o registro tiver imagem, deleta a atual pra salvar a nova (reduzir lixo temporário no app)
            if(Storage::exists($post->image)){
                Storage::delete($post->image);
            }

            // configurando o nome da imagem para ser salva igual ao do título
            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()
                ->route('posts.index')
                ->with('message', 'Post Atualizado com sucesso');
    }

    public function search (Request $request)
    {
        $filters = $request->except('_token');

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                        ->orWhere('content', 'LIKE', "%{$request->search}%")
                        ->paginate(2);
        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
