<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
</head>
<body>
    <h1>Thông Tin Cá Nhân</h1>
    <p><strong>Tên:</strong> {{ $information->name ?? 'Chưa cập nhật' }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Số điện thoại:</strong> {{ $information->phone ?? 'Chưa cập nhật' }}</p>
    <p><strong>Địa chỉ:</strong> {{ $information->address ?? 'Chưa cập nhật' }}</p>
    <a href="{{ route('information.edit') }}">Chỉnh sửa thông tin</a>
    <a href="{{ route('products.index') }}">Quay lại</a>
</body>
</html>
