<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
</head>
<body>
    <h1>Chi tiết sản phẩm</h1>

    <p><strong>Tên sản phẩm:</strong> {{ $product->name }}</p>
    <p><strong>Mô tả:</strong> {{ $product->description ?? 'Không có mô tả' }}</p>
    <p><strong>Giá:</strong> {{ $product->price }} VND</p>
    <p><strong>Số lượng:</strong> {{ $product->quantity }}</p>

    <h3>Hình ảnh sản phẩm</h3>
    <div>
        @forelse($product->images as $image)
            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $product->name }}" style="width: 200px; height: auto; margin-right: 10px;">
        @empty
            <p>Chưa có hình ảnh cho sản phẩm này.</p>
        @endforelse
    </div>

    <a href="{{ route('products.index') }}">Quay lại danh sách sản phẩm</a>

    <hr>

    <h2>Bình luận</h2>

    <!-- Hiển thị danh sách bình luận -->
    <ul>
        @forelse($product->comments as $comment)
            <li>
                <strong>{{ $comment->user->name ?? 'Khách' }}:</strong> {{ $comment->content }}
                <br><em>Thời gian: {{ $comment->created_at->format('d/m/Y H:i') }}</em>
            </li>
        @empty
            <p>Chưa có bình luận nào.</p>
        @endforelse
    </ul>

    <hr>

    <!-- Form thêm bình luận -->
    @if(Auth::check())
        <h3>Thêm bình luận</h3>
        <form action="{{ route('comments.store', $product->id) }}" method="POST">
            @csrf
            <textarea name="content" rows="3" placeholder="Viết bình luận..." required></textarea>
            <br>
            <button type="submit">Gửi bình luận</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Đăng nhập</a> để bình luận.</p>
    @endif
</body>
</html>
