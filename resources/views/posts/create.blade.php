@extends('layouts.app')

@section('content')

<div class="card card-default">

    <div class="card-header">{{ isset($post) ? 'Edit Post' : 'Create Post' }}</div>

<div class="card-body">  

    <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if(isset($post))
        @method('PUT')
        @endif

        <div class="form-group">

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control
            @error('title') is-invalid @enderror"
            value="{{ isset($post) ? $post->title : '' }}">

            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group">

            <label for="description">Description:</label>
            <textarea name="description" id="description" cols="5" rows="5" class="form-control
            @error('description') is-invalid @enderror">{{ isset($post) ? $post->description : '' }}</textarea>

            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group">

            <label for="content">Content:</label>
            <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
            <trix-editor input="content" class="form-control @error('content') is-invalid @enderror">
            </trix-editor>

             
            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group">

            <label for="published_at">Published At:</label>
            <input type="text" name="published_at" id="published_at" class="form-control
            @error('published_at') is-invalid @enderror"
            value="{{ isset($post) ? $post->published_at : '' }}">

            @error('published_at')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group">

            @if(isset($post))
            
            <div class="mb-4">
                <img style="width: 100%" src="{{ asset($post->image) }}" alt="">
            </div>

            @endif

            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control
            @error('image') is-invalid @enderror">

            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group">

            <label for="category">Category</label>
            <select name="category" id="category" class="form-control">

                @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    
                    @if(isset($post))

                    @if($category->id == $post->category_id)
                        selected
                    @endif

                    @endif
                    >

                    {{ $category->name }}

                </option>

                @endforeach

            </select>

        </div>

        @if($tags->count() > 0)  

        <div class="form-group">

            <label for="tags">Tags</label>           

            <select name="tags[]" id="tags" class="form-control tags-selector" multiple>

            @foreach($tags as $tag)
            
                <option value="{{ $tag->id }}"
                    
                   @if(isset($post))

                   @if(in_array($tag->id, $post->tags->pluck('id')->toArray())) 
                        selected
                   @endif

                   @endif

                    >

                    {{ $tag->name }}

                </option>

                @endforeach

            </select>    

        </div>

        @endif

        <div class="form-group">
            <button type="submit" class="btn btn-success">{{ isset($post) ? 'Edit Post' : 'Create Post' }}</button>
        </div>

    </form>

</div>  

</div>

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    flatpickr('#published_at', {
       enableTime: true,
       enableSeconds: true
    })

    $(document).ready(function() {
    $('.tags-selector').select2();
});

</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>

@endsection