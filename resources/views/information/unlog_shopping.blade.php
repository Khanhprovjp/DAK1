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

    <!-- Form tìm kiếm số điện thoại -->
    <form action="{{ route('information.unlog_shopping_search') }}" method="POST">
        @csrf
        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
        <button type="submit">Tìm kiếm</button>
    </form>

    <!-- Thông tin người mua -->
    @if(isset($phone))
        <h2>Thông tin người mua</h2>
        <p><strong>Số điện thoại:</strong> {{ $phone }}</p>
    @endif

    <!-- Thông tin giỏ hàng -->
    <div class="cart-box">
        <h3>Sản phẩm trong giỏ hàng</h3>
        @if(isset($shoppingItems) && $shoppingItems->isEmpty())
            <p>Giỏ hàng của bạn đang trống.</p>
        @elseif(isset($shoppingItems))
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>Tên người mua</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shoppingItems as $item)
                        <tr>
                            <td>{{ $item->buyer_name }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price) }} VND</td>
                            <td>{{ number_format($item->quantity * $item->price) }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <a href="{{ route('products.index') }}" class="button">Quay lại trang chủ</a>
</body>
</html>
