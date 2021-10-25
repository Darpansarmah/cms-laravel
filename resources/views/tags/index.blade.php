@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end my-2">
    
   <a href="{{ route('tags.create') }}" class="btn btn-success">Add Tag</a>

</div>  

<div class="card card-default">

    <div class="card-header">Tags</div>

        <div class="card-body">

            @if($tags->count() > 0)

            <table class="table">

                <thead>

                    <th>Name</th>
                    <th>Posts Count</th>
                    <th></th>
                    <th></th>

                </thead>

                <tbody>

                    <tr>

                    @foreach($tags as $tag)

                    <td>{{ $tag->name }}</td>
                    
                    <td>{{ $tag->posts->count() }}</td>

                    <td><a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info btn-sm">Edit</a>

                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $tag->id }})">Delete</button></td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            <!-- Modal -->   
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <form action="" method="post" id="deleteTagForm">
                        @csrf
                        @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-bold">
                            Aru you sure you want to delete this tag ?
                        </p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Go back</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>

                </form>
                
                </div>
                </div>
            </div>

        </div>

        @else

        <h3 class="text-center text-bold">No Tags Yet</h3>

        @endif

</div>

@endsection

@section('scripts')

<script>

    function handleDelete(id) {
        var form = document.getElementById('deleteTagForm')
        form.action = '/tags/' + id
        $('#deleteModal').modal('show')
    }

</script>
    
@endsection