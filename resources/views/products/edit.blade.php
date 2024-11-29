<!-- resources/views/products/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
</head>
<body>
    <h1>Sửa sản phẩm</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" value="{{ $product->name }}" required> <br>
    
        <label for="description">Mô tả sản phẩm:</label>
        <textarea id="description" name="description">{{ $product->description }}</textarea> <br>
    
        <label for="price">Giá sản phẩm:</label>
        <input type="number" step="0.01" id="price" name="price" value="{{ $product->price }}" required> <br>
    
        <label for="quantity">Số lượng sản phẩm:</label>
        <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" required> <br>
    
        <label for="images">Ảnh sản phẩm mới:</label>
        <input type="file" name="images[]" id="images" multiple> <br> <!-- Cho phép chọn nhiều ảnh -->
    
        <button type="submit">Cập nhật sản phẩm</button>
    </form>
    <br>
    <a href="{{ route('home') }}">Quay lại</a>
</body>
</html>
