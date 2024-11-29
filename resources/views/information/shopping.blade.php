<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Giỏ hàng</title>
    <style>
        .info-box, .cart-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Thông tin Giỏ hàng</h1>

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <!-- Thông tin người dùng -->
    <h2>Thông tin người dùng</h2>
<p><strong>Tên:</strong> {{ $userInfo->name }}</p>
<p><strong>Địa chỉ:</strong> {{ $userInfo->address }}</p>
<p><strong>Số điện thoại:</strong> {{ $userInfo->phone }}</p>

    <!-- Thông tin giỏ hàng -->
    <div class="cart-box">
        <h3>Sản phẩm trong giỏ hàng</h3>
        @if($shoppingItems->isEmpty())
            <p>Giỏ hàng của bạn đang trống.</p>
        @else
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shoppingItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->product->price) }} VND</td>
                            <td>{{ number_format($item->quantity * $item->product->price) }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <a href="{{ route('products.index') }}" class="button">Quay lại trang chủ</a>
</body>
</html>
