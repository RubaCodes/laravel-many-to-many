@extends('layouts.app')


@section('content')
<div class="container margin-auto">
    <div class="card">
        <div class="card-header text-uppercase ">Modifica Post</div>
        <div class="card-body">
            <form action="{{route('admin.categories.update', $category)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nome della categoria</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{old('name', $category->name)}}">
                </div>

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Modifica Categoria</button>
            </form>
        </div>
    </div>
</div>
@endsection