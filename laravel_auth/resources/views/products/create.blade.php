@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Product</h1>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Add Product</button>
        </form>
    </div>
@endsection
