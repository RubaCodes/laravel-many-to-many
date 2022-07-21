@extends('layouts.app')


@section('content')
<div class="container">
    <div class="card py-4" id="add-category">
        <div class="card-header text-uppercase ">Crea nuovo Tag</div>
        <div class="card-body">
            <form action="{{route('admin.tags.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Nome del Tag</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{old('name')}}">
                </div>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button class="btn btn-primary" type="submit">Aggiungi</button>
            </form>
        </div>
    </div>
    <table class="table table-striped my-4" id="categories-index">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
            <tr>
                <th scope="row">{{$tag->id}}</th>
                <td>{{$tag->name}}</td>
                <td>{{$tag->slug}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('admin.tags.show', $tag)}}">Visualizza</a>
                    <a class="btn btn-warning" href="{{route('admin.tags.edit', $tag)}}">Modifica</a>
                    <form class="d-inline-block" action="{{route('admin.tags.destroy', $tag)}}" method="POST">
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