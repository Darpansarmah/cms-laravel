@extends('layouts.app')

@section('content')

<div class="card card-default">

    @if($users->count() > 0)

    <div class="card-header">Users</div>

        <div class="card-body">

            <table class="table">

                <thead>

                    <th>Image</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>                        
                    <th></th>

                </thead>

                <tbody>

                    @foreach($users as $user)

                    <tr>

                    <td>
                    <img height="40px" width="40px" style="border-radius: 50%" src="{{ Gravatar::src($user->email) }}" alt="">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->email }}</td>
                        
                    @if(!$user->isAdmin())
                    <td>
                        <form action="{{ route('users.make-admin', $user->id) }}" method="post">
                        @csrf

                        <button type="submit" class="btn btn-success btn-sm">Make Admin</button></td>
                    </form>

                    @else
                    <td>
                        <form action="{{ route('users.make-writer', $user->id) }}" method="post">
                        @csrf

                        <button type="submit" class="btn btn-secondary btn-sm">Make Writer</button></td>
                    </form>

                    @endif

                    </tr>

                    @endforeach

                </tbody>
        
            </table>

        </div>

    @else

    <h3 class="text-center text-bold">No Users Found</h3>

    @endif

</div>
    
@endsection