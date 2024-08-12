<!-- resources/views/products/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Add Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="medical_shop_id">Medical Shop</label>
            <select id="medical_shop_id" name="medical_shop_id" class="form-control" required>
                @foreach ($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
@endsection
