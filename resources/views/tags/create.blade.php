@extends('layouts.app')

@section('content')

<div class="card card-default">

    <div class="card-header">{{ isset($tag) ? 'Edit Tag' : 'Create Tag' }}</div>

        <div class="card-body">

            <form action="{{ isset($tag) ? route('tags.update', $tag->id) :  route('tags.store') }}" method="POST">
            @csrf

            @if(isset($tag))
            @method('PUT')
            @endif

            <div class="form-group">

                <input type="text" name="name" id="name" value="{{ isset($tag) ? $tag->name : '' }}" class="form-control
                @error('name') is-invalid @enderror">

                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>   
                @enderror

            </div>

            <div class="form-group">

                <button type="submit" class="btn btn-success">{{ isset($tag) ? 'Update Tag' : 'Add Tag' }}</button>
           
            </div>

            </form>

        </div>
    
</div>

@endsection