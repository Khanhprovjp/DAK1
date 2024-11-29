<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
</head>
<body>
    <h1>Thêm sản phẩm mới</h1>
    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" required> <br>

        <label for="description">Mô tả sản phẩm:</label>
        <textarea id="description" name="description"></textarea> <br>

        <label for="price">Giá sản phẩm:</label>
        <input type="number" step="0.01" id="price" name="price" required> <br>

        <label for="quantity">Số lượng sản phẩm:</label>
        <input type="number" id="quantity" name="quantity" required> <br>

        <label for="images">Thêm ảnh sản phẩm (có thể chọn nhiều ảnh):</label>
        <input type="file" id="images" name="images[]" multiple accept="image/*"> <br>

        <button type="submit">Thêm sản phẩm</button>
    </form>
    <br>
    <a href="{{ route('home') }}">Quay lại</a>
</body>
</html>
