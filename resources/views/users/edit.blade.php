@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">My Profile</div>

        <div class="card-body">

            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control
                    @error('name') is-invalid @enderror">

                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="about">About Me</label>
                    <textarea name="about" id="about" cols="5" rows="5" class="form-control
                    @error('about') is-invalid @enderror">{{ $user->about ? $user->about : '' }}</textarea>

                    @error('about')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Profile</button>
                </div>

            </form>

        </div>

</div>
    
@endsection