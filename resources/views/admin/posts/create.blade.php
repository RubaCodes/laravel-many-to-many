@extends('layouts.app')


@section('content')
<div class="container margin-auto">
    <div class="card">
        <div class="card-header text-uppercase ">Crea nuovo post</div>
        <div class="card-body">
            <form action="{{route('admin.posts.store')}}" method="POST">
                @csrf
                {{-- Titolo del post --}}
                <div class="form-group">
                    <label for="title">Titolo del post</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                        aria-describedby="emailHelp" value="{{old('title')}}">
                </div>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- contenuto del post --}}
                <label for="content">Inserisci il contenuto del post</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                    rows="7">{{old('content')}}</textarea>
                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- Select Categories --}}
                <label for="category_id">Seleziona la categoria</label>
                <select class="form-control @error('content') is-invalid @enderror" name="category_id" id="category_id">
                    <option value="">Seleziona Categoria</option>
                    @foreach ($categories as $category)
                    <option {{old('category_id')==$category->id
                        ? 'selected' : ""}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- Checkbox group #tags --}}
                @foreach ($tags as $tag)
                <div class="form-check form-check-inline pt-4">
                    {{-- tags per far arrivare un array --}}
                    <input class="form-check-input" type="checkbox" id="{{$tag->slug}}" value="{{$tag->id}}"
                        {{in_array($tag->id, old('tags',[])) ? 'checked' : ''}} name="tags[]">
                    <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                </div>
                @endforeach


                {{-- Pubblica --}}
                <div class="form-group form-check pt-4">
                    <input type="checkbox" name="published" class="form-check-input" id="published" {{old('published')
                        ? 'checked' : "" }}>
                    <label class="form-check-label" for="published">Pubblico</label>
                </div>
                <button type="submit" class="btn btn-primary">Crea post</button>
            </form>
        </div>
    </div>
</div>
@endsection