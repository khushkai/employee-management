<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <th>Name</th>
        <th>Email</th>
        @foreach($Cruds as $crud)
        <tr>
            <td>{{$crud->name}} </td>
            <td>{{$crud->email}}</td>
            <td> <a href="{{ route('api_crud.edit', $crud->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('api_crud.destroy', $crud->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this User?')">Delete</button>
                    </form>
                </td>
        </tr>
        @endforeach
        {{ $Cruds->links() }}
    </table>
</body>
</html>