<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <script>
        function showPurchaseForm(productId, productName) {
            // Hiển thị form mua hàng
            document.getElementById('purchase-form').style.display = 'block';

            // Điền thông tin sản phẩm vào form
            document.getElementById('product_id').value = productId;
            document.getElementById('product_name').innerText = productName;

            // Cuộn đến form mua hàng
            document.getElementById('purchase-form').scrollIntoView({ behavior: 'smooth' });
        }

        function showUnlogPurchaseForm(productId, productName) {
            // Hiển thị form mua hàng cho người chưa đăng nhập
            document.getElementById('unlog-purchase-form').style.display = 'block';

            // Điền thông tin sản phẩm vào form
            document.getElementById('unlog_product_id').value = productId;
            document.getElementById('unlog_product_name').innerText = productName;

            // Cuộn đến form mua hàng
            document.getElementById('unlog-purchase-form').scrollIntoView({ behavior: 'smooth' });
        }

        function closeAlert() {
        document.getElementById('alert-box').style.display = 'none';
        }
    </script>
</head>
<body>
    @if(session('message') || session('success') || session('error'))
    <div id="alert-box" style="display: block; padding: 15px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; border-radius: 5px;">
        <p id="alert-message">
            @if(session('success'))
                {{ session('success') }}
            @endif
            @if(session('message'))
                {{ session('message') }}
            @endif
            @if(session('error'))
                {{ session('error') }}
            @endif
        </p>
        <button onclick="closeAlert()" style="background-color: #721c24; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;">OK</button>
    </div>
    @endif


    <h2>Danh sách sản phẩm</h2>
    <ul>
        @forelse($products as $product)
            <li>
                <strong>Tên sản phẩm:</strong> {{ $product->name }} <br>
                <strong>Giá:</strong> {{ $product->price }} VND
                <a href="{{ route('products.detail', $product->id) }}">Chi tiết</a>
                @if(Auth::check() && Auth::user()->account_type === 'admin')
                    <!-- Nút sửa -->
                    <a href="{{ route('products.edit', $product->id) }}">Sửa</a>

                    <!-- Nút xóa -->
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
                    </form>
                @endif

                <!-- Nút mua hàng -->
                @if(Auth::check())
                    <button onclick="showPurchaseForm('{{ $product->id }}', '{{ $product->name }}')">Mua hàng</button>
                @else
                    <button onclick="showUnlogPurchaseForm('{{ $product->id }}', '{{ $product->name }}')">Mua hàng</button>
                @endif
            </li>
        @empty
            <p>Không có sản phẩm nào.</p>
        @endforelse
    </ul>

    <!-- Form mua sản phẩm cho người đã đăng nhập -->
    @if(Auth::check())
    <div id="purchase-form" style="display: none; margin-top: 20px; border: 1px solid #ccc; padding: 15px;">
        <h3>Mua sản phẩm</h3>
        <p><strong>Tên sản phẩm:</strong> <span id="product_name"></span></p>
        <form action="{{ route('shopping.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" id="product_id">
            <label for="quantity">Số lượng:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" required>
            <button type="submit">Xác nhận mua</button>
        </form>
    </div>
    @endif

    <!-- Form mua sản phẩm cho người chưa đăng nhập -->
    <div id="unlog-purchase-form" style="display: none; margin-top: 20px; border: 1px solid #ccc; padding: 15px;">
        <h3>Mua sản phẩm</h3>
        <p><strong>Tên sản phẩm:</strong> <span id="unlog_product_name"></span></p>
        <form action="{{ route('unlog_shopping.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" id="unlog_product_id">
            <label for="name">Họ tên:</label>
            <input type="text" name="name" id="name" required>
            <br>
            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" id="phone" required>
            <br>
            <label for="quantity">Số lượng:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" required>
            <button type="submit">Xác nhận mua</button>
        </form>
    </div>

    @if(Auth::check())
        <!-- Nút đến trang Information -->
        <a href="{{ route('information.index') }}" class="button">Thông tin cá nhân</a>
    @endif

    @if(Auth::check())
    <a href="{{ route('information.shopping') }}" class="button">Giỏ hàng</a>
    @else
    <a href="{{ route('information.unlog_shopping') }}" class="button">Giỏ hàng</a>
    @endif


    @if(Auth::check() && Auth::user()->account_type === 'admin')
        <!-- Nút thêm sản phẩm -->
        <a href="{{ route('products.create') }}">Thêm sản phẩm mới</a>
    @endif

    <br><br>

    @if(!Auth::check())
        <!-- Nút đăng nhập -->
        <a href="{{ route('login') }}">Đăng nhập</a>
    @else
        <!-- Nút đăng xuất -->
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Đăng xuất
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endif
</body>
</html>
