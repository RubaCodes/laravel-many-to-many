@extends('layouts.app')


@section('content')
<div class="container">
    <div class="card py-4" id="add-category">
        <div class="card-header text-uppercase ">Crea nuova categoria</div>
        <div class="card-body">
            <form action="{{route('admin.categories.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Nome della categoria</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{old('title')}}">
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
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>{{$category->slug}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('admin.categories.show', $category)}}">Visualizza</a>
                    <a class="btn btn-warning" href="{{route('admin.categories.edit', $category)}}">Modifica</a>
                    <form class="d-inline-block" action="{{route('admin.categories.destroy', $category)}}"
                        method="POST">
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