<?php
// Đảm bảo chỉ hiển thị nội dung nếu đã đăng nhập thành công
session_start();

// Kiểm tra nếu có session login, nếu không, chuyển hướng về trang đăng nhập
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: dangnhap.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
    <link rel="stylesheet" href="tin1.css">
</head>

<body>
    <?php
    include_once __DIR__ . '/header-qt.php';
    ?>
    <section id="banner">
        <h1>Tin tức</h1>
    </section>
    <a href="insert-capnhap.php" class="styled-link">Thêm tin tức mới</a>
    <?php

    include('connect.php');

    $sql = "SELECT * FROM new WHERE 1";

    $data = mysqli_query($conn, $sql);

    $Tin = [];

    while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
        $Tin[] = array(
            'id'        => $row['id'],
            'title'        => $row['title'],
            'text'       => $row['text'],
            // 'duong_dan'     => $row['duong_dan'],
            'picture'           => $row['picture']
        );
        $danhSachTin = array_reverse($Tin);
        $limit = 3;
    }
    // var_dump($danhSachTin);
    ?>
    <section class="noi-dung">
        <ul class="danhsach-noidung clearfix">
            <?php foreach (array_slice($danhSachTin, 0, $limit) as $tin) : ?>
                <li>
                    <a href="delete-tin.php">Xóa</a>|| <a href="update-tin.php">Sửa</a>
                    <?php echo '<p class="service-image"><img src="' . $tin["picture"] . '" alt="#" class="img-noidung">'; ?>
                    <div class="inner">
                        <h3><?= $tin['title'] ?></h3>
                        <p class="info"><?= $tin['text'] ?></p>
                    </div>
                    </a>
                </li>
            <?php endforeach; ?>

        </ul>
    </section>


</body>

</html>