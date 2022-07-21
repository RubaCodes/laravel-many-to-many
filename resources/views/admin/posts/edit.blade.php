@extends('layouts.app')


@section('content')
<div class="container margin-auto">
    <div class="card">
        <div class="card-header text-uppercase ">Modifica Post</div>
        <div class="card-body">
            <form action="{{route('admin.posts.update', $post)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titolo del post</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                        aria-describedby="emailHelp" value="{{old('title', $post->title)}}">
                </div>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="content">Inserisci il contenuto del post</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                    rows="7">{{old('content',$post->content)}}</textarea>
                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- Select Categories --}}
                <label for="category_id">Seleziona la categoria</label>
                <select class="form-control @error('content') is-invalid @enderror" name="category_id" id="category_id">
                    <option value="">Seleziona Categoria</option>
                    @foreach ($categories as $category)
                    <option {{old('category_id',$post->category_id)==$category->id
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
                        {{in_array($tag->id, old('tags', $postTags)) ? 'checked' : ''}} name="tags[]">
                    <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                </div>
                @endforeach
                <div class="form-group form-check pt-4">
                    <input type="checkbox" name="published" class="form-check-input" id="published" {{old('published',
                        $post->published)
                    ? 'checked' : "" }}>
                    <label class="form-check-label" for="published">Pubblico</label>
                </div>
                <button type="submit" class="btn btn-primary">Modifica post</button>
            </form>
        </div>
    </div>
</div>
@endsection