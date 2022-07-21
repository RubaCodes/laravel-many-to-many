@extends('layouts.app')


@section('content')
<div class="container margin-auto">
    <div class="card">
        <div class="card-header text-uppercase ">
            Descrizione Tag
        </div>
        <div class="card-body">
            <div>
                <h2 class="text-primary">Nome Tag</h2>
                {{$tag->name}}
            </div>
            <div class="py-4">
                <h2 class="text-primary">Post in cui e' incluso il #tag:</h2>
                <ul>
                    @foreach ($tag->posts as $post)
                    <li>
                        id: <a href="{{route('admin.posts.show', $post)}}">{{$post->id}}</a> , titolo: {{$post->title}}
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>

    </div>
</div>
@endsection