


@extends('layouts.app')

@section('content')
<div class="container-dashboard">
    <h1>  User List</h1>
    <a href="{{ route('crud.create') }}" class="btn btn-primary mb-3">Add crud</a>

    <table>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Age</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($cruds as $crud)
            <tr>
                <td>{{ $crud->id }}</td>
                <td>{{ $crud->name }}</td>
                <td>{{ $crud->age }}</td>
                <td>
                    <!-- @can('update', $crud)
                       <a href="{{ route('crud.edit', $crud->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan  -->
                     <a href="{{ route('crud.edit', $crud->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('crud.destroy', $crud->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this User?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            {{ $cruds->links() }}
        </tbody>
        
    </table>

</div>

@endsection