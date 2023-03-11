@extends('layouts.default')
@section('page-content')
    <p>
        @foreach ($article as $data)
            <?php $id = $data->id; ?>
            <h1>{{ $id }}</h1> <br/>
            <p>{{ $article_description = $data->article_description }}</p><br/>
            <p>Created by: {{ $data->username }}</p>
        @endforeach
    </p>
@endsection