<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php
    session_start(); // Bắt đầu session

    // Kiểm tra xem thông tin đăng nhập có được gửi hay không
    if (isset($_POST['submit'])) {
        // Thông tin tài khoản và mật khẩu quản trị viên
        $admin_username = 'admin';
        $admin_password = 'password123';

        // Lấy dữ liệu từ form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Kiểm tra thông tin đăng nhập
        if ($username === $admin_username && $password === $admin_password) {
            // Đăng nhập thành công
            $_SESSION['logged_in'] = true;
            header('Location: tintuc-qt.php'); // Chuyển hướng đến trang quản trị
            exit;
        } else {
            // Đăng nhập thất bại
            echo '<p style="color: red;">Sai tên tài khoản hoặc mật khẩu.</p>';
        }
    }
    ?>

    <form action="#" method="post">
        <label for="username">Tài khoản:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" name="submit" value="Đăng nhập">
    </form>
</body>

</html>