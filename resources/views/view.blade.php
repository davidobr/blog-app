@extends('layouts.default')
@section('page-content')
    @foreach ($article as $data)
        <h1>{{ $data->article_title }}</h1> <br/>
        <p>{{ $data->article_description }}</p><br/>
        <p>Created by: {{ $data->username }}</p>
    @endforeach
@endsection