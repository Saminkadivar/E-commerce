@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Product</h2>

    <form action="{{ route('vendor.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-lable">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger">@error('category_id') {{ $message }} @enderror</span>
        </div>  
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" min="0" required>
        </div>

      
        
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="image_path" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection
