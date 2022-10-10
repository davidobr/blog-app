@extends('layouts.default')
@section('page-content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 text-black">
                        <p>You're logged in! Here are the articles you have written:</p>
                        <table class="border-solid border-2 border-indigo-600">
                            @forelse ($articles as $key => $data)
                                <?php $article_id = $data->id; ?>
                                <tr class="border-dashed border-2 border-indigo-600">
                                    <td class="border-dotted border-2 border-indigo-600"><a href="{{ route('view', $article_id) }}">{{ $data->id }}. </a></td>
                                    <td class="border-dotted border-2 border-indigo-600"><a href="{{ route('view', $article_id) }}">{{ $data->article_title }}</a></td>
                                    <td class="border-dotted border-2 border-indigo-600"><a href="{{ route('view', $article_id) }}">{{ $data->article_description }}</a></td>
                                </tr>
                            @empty
                                <p>You haven't written any articles yet. You can create one <a href="{{ route('create') }}">here</a></p>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endsection