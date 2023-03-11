@extends('layouts.default')
@section('page-content')
    @foreach ($article as $data)
        <?php $article_id = $data->id; ?>
        <h1>{{ $article_title = $data->article_title }}</h1><br/>
        <p>{{ $article_description = $data->article_description }}</p><br/>
        <p>Created by: {{ $data->username }}</p>
        @if($author === true)
            <a href="{{ route('edit', $id) }}"><button>Edit</button></a><br/>
            <a href="{{ route('view', $id) }}"><button>Delete</button></a><br/>
            <form method="post">
                {{csrf_field()}}
                <input type="submit" />
            </form>
        @else
            <!--<p>A button won't display here</p>-->
        @endif
    @endforeach
@endsection