@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end my-2">

    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>

</div>

<div class="card card-default">

    <div class="card-header">Posts</div>


<div class="card-body">

    @if($posts->count() > 0)

    <table class="table">
        
        <thead>

            <th>Title</th>
            <th>Image</th>
            <th>Category</th>
            <th>Created_at</th>
            <th></th>
            <th></th>

        </thead>

        <tbody>

            @foreach($posts as $post)

            <tr>

            <td>{{ $post->title }}</td>
            <td><img height="50px" width="70px" src="{{ $post->image }}" alt=""></td>
            <td>{{ $post->category->name }}</td>
            <td>{{ $post->created_at->diffForHumans() }}</td>

            @if(!$post->trashed())              
            <td>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">Edit</a>
            </td>

            @else
            <td>
                <form action="{{ route('restore-posts', $post->id) }}" method="post">
                @csrf
                @method('PUT')

                <button type="submit" class="btn btn-secondary btn-sm">Restore</button>
                </form>
            </td>

            @endif    

            <td>
                <form action="{{ route('posts.destroy', $post->id ) }}" method="post">
                @csrf
                @method('DELETE')
                
                <button type="submit" class="btn btn-danger btn-sm">
                    {{ $post->trashed() ? 'Delete' : 'Trash' }}
                </button>
                </form>
            </td>
            </tr>

            @endforeach

        </tbody>
    
    
    </table> 

    @else

    <h3 class="text-center text-bold">No Posts Yet</h3>

    @endif

</div>

</div>

@endsection