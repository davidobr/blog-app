@extends('layouts.default')
@section('page-content')
    <div class="flex items-center">
        <form method="post" action="{{ route('view') }}">
            @csrf
            Article title: <input type="text" name="article_title"/>
            Article description: <textarea name="article_description"></textarea>
            <input type="submit" value="Submit"/>
        </form>
    </div>
@endsection