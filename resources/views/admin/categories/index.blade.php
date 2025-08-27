@extends('admin.layouts.app')

@section('title', 'Manage Categories')

@section('content')
<h2>Categories</h2>
<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-2">+ Add Category</a>

<table class="table">
    <thead>
        <tr><th>ID</th><th>Name</th><th>Status</th><th>Action</th></tr>
    </thead>
    <tbody>
        @foreach($categories as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->status ? 'Active' : 'Inactive' }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
