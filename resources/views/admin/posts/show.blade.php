<pre>
    <a href="{{ route('posts.index') }}">Voltar</a>
</pre>
<hr>
<h1>Detalhes do Post {{$post->title}}</h1>
<ul>
    <li><strong>Título: </strong>{{$post->title}}</li>
    <li><strong>Conteúdo: </strong>{{$post->content}}</li>
</ul>

<form action="{{ route('posts.destroy', $post->id) }}" method="post">
    {{-- diretiva csrf --}}
    @csrf
    <input type="hidden" name="_method" id="" value="DELETE">
    <button type="submit">Deletar o Post: {{$post->title}}</button>
</form>
