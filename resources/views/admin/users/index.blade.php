@extends('admin.layouts.app')

@section('title', 'Manage Users')

@section('content')
<h2>Users</h2>

<table class="table">
    <thead>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
