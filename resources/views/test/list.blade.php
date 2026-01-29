


@extends('layouts.app')

@section('content')
<div class="container-dashboard">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Testing List</h2>
        <a href="{{ route('test.create') }}" class="btn btn-primary">
            Add Test
        </a>
    </div>
    <div class="d-flex justify-content-center mt-4">
        <form method="GET" class="d-flex gap-2">
            
            <input type="text"
                name="name"
                class="form-control"
                placeholder="Name"
                value="{{ request('name') }}">

            <input type="number"
                name="age"
                class="form-control"
                placeholder="Age"
                value="{{ request('age') }}">

            <button type="submit" class="btn btn-primary">
                Filter
            </button>

        </form>
    </div>
<br>
    <!-- <form method="GET">
        <input type="text" name="name" placeholder="Name"
            value="{{ request('name') }}">

        <input type="number" name="age" placeholder="Age"
            value="{{ request('age') }}">

        <button type="submit">Filter</button>
    </form> -->
    <div class="d-flex justify-content-end align-items-center gap-2 mb-3">
        <form action="{{ route('test.import') }}"
            method="POST"
            enctype="multipart/form-data"
            class="d-flex align-items-center gap-2 m-0">
            @csrf
            <input type="file" name="file" class="form-control" required>
            <button type="submit" class="btn btn-primary">
                Import
            </button>
        </form>
        <a href="{{ route('test.export') }}" class="btn btn-success"> Export</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                  <th><a href="{{ route('test.index', ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Name</a></th>
            <th><a href="{{ route('test.index', ['sort' => 'age', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">Age</a></th>
            <th>Created At</th>
                <!-- <th>
                    Name
                    <a href="?sort=name&direction=asc">⬆</a>
                    <a href="?sort=name&direction=desc">⬇</a>
                </th>
                <th>
                    Age
                    <a href="?sort=age&direction=asc">⬆</a>
                    <a href="?sort=age&direction=desc">⬇</a>
                </th> -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($tests as $test)
            <tr>
                <td>{{ $test->id }}</td>
                <td>{{ $test->name }}</td>
                <td>{{ $test->age }}</td>
                 <td>{{ $test->created_at }}</td>
                <td>
                    <!-- @can('update', $test)
                       <a href="{{ route('test.edit', $test->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan  -->
                     <a href="{{ route('test.edit', $test->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('test.destroy', $test->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this User?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            {{ $tests->links() }}
        </tbody>
        
    </table>

</div>

@endsection