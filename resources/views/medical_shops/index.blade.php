@extends('layouts.app')

@section('content')
    <h1>Medical Shops</h1>
    <a href="{{ route('medical_shops.create') }}" class="btn btn-primary">Add New Shop</a>
    
    <a href="{{ route('products.index') }}" class="btn btn-primary">Products</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shops as $shop)
                <tr>
                    <td>{{ $shop->name }}</td>
                    <td>{{ $shop->description }}</td>
                    <td>{{ $shop->location }}</td>
                    <td>
                        <a href="{{ route('medical_shops.edit', $shop) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('medical_shops.destroy', $shop) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
