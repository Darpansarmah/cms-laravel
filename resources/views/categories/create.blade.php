@extends('layouts.app')

@section('content')

<div class="card card-default">

    <div class="card-header">{{ isset($category) ? 'Edit Category' : 'Create Category' }}</div>

        <div class="card-body">
            
                <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                    @csrf
                    
                    @if(isset($category))
                    @method('PUT')
                    @endif

                    <div class="form-group">

                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control
                    @error('name') is-invalid @enderror"
                    value="{{ isset($category) ? $category->name : "" }}">

                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <button class="btn btn-success" value="submit">
                        {{ isset($category) ? 'Update Category' : 'Add Category' }}
                    </button>

                </div>     

            </form>  

        </div>

</div>

@endsection