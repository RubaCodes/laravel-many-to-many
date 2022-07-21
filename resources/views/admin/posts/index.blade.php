@extends('layouts.app')


@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Content</th>
                <th scope="col">Published</th>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>

                <td class="text-truncate" style="max-width: 150px;">{{$post->content}}</td>
                <td>{{$post->published ? "Pubblicato &check;" : "Non Pubblicato &cross;"}}</td>
                <td>{{$post->category_id}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('admin.posts.show', $post)}}">Visualizza</a>
                    <a class="btn btn-warning" href="{{route('admin.posts.edit', $post)}}">Modifica</a>
                    <form class="d-inline-block" action="{{route('admin.posts.destroy', $post)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</div>
@endsection