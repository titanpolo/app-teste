@extends('admin.layouts.app')
@section('title', 'Criar Novo Post')
@section('content')
    <pre>
        <a href="{{ route('posts.index') }}">Voltar</a>
    </pre>
    <hr>
    <h1>Cadastrar Novo Post</h1>

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @include('admin.posts._partials.form')
    </form>
@endsection
