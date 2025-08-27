    @extends('admin.layouts.app')

    @section('title', 'Edit Category')

    @section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body">
                <h4 class="fw-bold mb-3">Edit Category</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category Name</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}" 
                            class="form-control" placeholder="Enter category name" required>
                    </div>
                 
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ $category->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$category->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">← Back</a>
                        <button type="submit" class="btn btn-success">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
