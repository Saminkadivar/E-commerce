
@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Product</h2>

    <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
    <label for="stock">Stock</label>
    <input type="number" name="stock" id="stock" class="form-control"
           value="{{ old('stock', $product->stock ?? 0) }}" min="0" required>
</div>

<div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control" required>
        <option value="">-- Select Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>


        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image_path" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-success">Save Product</button>
    </form>
</div>
@endsection
