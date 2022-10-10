@extends('layouts.default')
@section('page-content')
<h1 class="ml-5">Current blogs from the most recently created</h1>
    <!--<div class="container" style="width: 100%;">
        <div class="content-box h-16 w-32 border-4 p-1 m-4 text-xs inline-block">
            Title: blog title here
            Author: Username here
        </div>
        <div class="content-box h-16 w-32 border-4 p-1 m-4 text-xs inline-block">
            Title: blog title here
            Author: Username here
        </div>
        <div class="content-box h-16 w-32 border-4 p-1 m-4 text-xs inline-block">
            Title: blog title here
            Author: Username here
        </div>
        <div class="content-box h-16 w-32 border-4 p-1 m-4 text-xs inline-block">
            Title: blog title here
            Author: Username here
        </div>
        <div class="content-box h-16 w-32 border-4 p-1 m-4 text-xs inline-block">
            Title: blog title here
            Author: Username here
        </div>
        <div class="content-box h-16 w-32 border-4 p-1 m-4 text-xs inline-block">
            Title: blog title here
            Author: Username here
        </div>
        <div class="content-box h-16 w-32 border-4 p-1 m-4 text-xs inline-block">
            Title: blog title here
            Author: Username here
        </div>
        <div class="content-box h-16 w-32 border-4 p-1 m-4 text-xs inline-block">
            Title: blog title here
            Author: Username here
        </div>
        <div class="content-box h-16 w-32 border-4 p-1 m-4 text-xs inline-block">
            Title: blog title here
            Author: Username here
        </div>
        <div class="content-box h-16 w-32 border-4 p-1 m-4 text-xs inline-block">
            Title: blog title here
            Author: Username here
        </div>
    </div>      Might depreciate this, tables in the future may be replaced with a component-->
    <table class="border-solid border-2 border-indigo-600">
        @forelse ($articles as $key => $data)
            <?php $article_id = $data->id; ?>
            <tr class="border-dashed border-2 border-white-600">
                <td class="border-dotted border-2 border-white-600"><a href="{{ route('view', $article_id) }}">{{ $data->id }}. </a></td>
                <td class="border-dotted border-2 border-white-600"><a href="{{ route('view', $article_id) }}">{{ $data->article_title }}</a></td>
                <td class="border-dotted border-2 border-white-600"><a href="{{ route('view', $article_id) }}">{{ $data->article_description }}</a></td>
            </tr>
        @empty
            <p>Ops we can't seem to find any articles right now.</p>
        @endforelse
    </table>
@endsection