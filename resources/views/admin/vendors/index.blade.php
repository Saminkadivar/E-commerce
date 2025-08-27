@extends('admin.layouts.app')

@section('title', 'Manage Vendors')

@section('content')
<h2>Vendors</h2>

<table class="table">
    <thead>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
    </thead>
    <tbody>
        @foreach($vendors as $vendor)
        <tr>
            <td>{{ $vendor->id }}</td>
            <td>{{ $vendor->name }}</td>
            <td>{{ $vendor->email }}</td>
            <td>
                <form method="POST" action="{{ route('admin.vendors.destroy', $vendor->id) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
