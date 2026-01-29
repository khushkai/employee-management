


@extends('layouts.app')

@section('content')
<div class="container-dashboard">
    <h1>  Demo List</h1>
    <a href="{{ route('demo.create') }}" class="btn btn-primary mb-3">Add demo</a>

    <table>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Age</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($demos as $demo)
            <tr>
                <td>{{ $demo->id }}</td>
                <td>{{ $demo->name }}</td>
                <td>{{ $demo->age }}</td>
                <td>
                    <!-- @can('update', $demo)
                       <a href="{{ route('demo.edit', $demo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan  -->
                     <a href="{{ route('demo.edit', $demo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('demo.destroy', $demo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this User?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            {{ $demos->links() }}
        </tbody>
        
    </table>

</div>

@endsection