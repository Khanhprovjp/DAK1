<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Đăng nhập</button>
    </form>
    <a href="{{ route('register') }}">Tạo tài khoản mới</a> <!-- Link đến form đăng ký -->
</body>
</html>
