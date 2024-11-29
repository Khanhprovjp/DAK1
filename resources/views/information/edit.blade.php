<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Thông Tin</title>
</head>
<body>
    <h1>Chỉnh Sửa Thông Tin Cá Nhân</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('information.update') }}" method="POST">
        @csrf
        <label for="name">Tên:</label>
        <input type="text" id="name" name="name" value="{{ $information->name ?? '' }}" required><br>

        <label for="address">Địa chỉ:</label>
        <input type="text" id="address" name="address" value="{{ $information->address ?? '' }}" required><br>

        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone" name="phone" value="{{ $information->phone ?? '' }}" required><br>

        <button type="submit">Cập nhật</button>
    </form>

    <a href="{{ route('information.index') }}">Quay lại</a>
</body>
</html>
