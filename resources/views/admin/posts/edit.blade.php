<pre>
    <a href="{{ route('posts.index') }}">Voltar</a>
</pre>
<hr>
<h1>Eitar o Post <strong>{{ $post->title }}</strong></h1>

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

<form action="{{ route('posts.update', $post->id) }}" method="post">
    @csrf
    @method('put')
    <input type="text" name="title" id="title" placeholder="Título" value="{{ $post->title }}" >
    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteúdo">{{ $post->content }}</textarea>
    <button type="submit">Enviar</button>
</form>
