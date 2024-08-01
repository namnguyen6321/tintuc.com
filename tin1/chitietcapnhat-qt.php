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
        <h1>CHI TIẾT
            CẬP NHẬT</h1>
    </section>
    <a href="insert-capnhat.php" class="styled-link">Thêm cập nhât mới</a>
    <?php

    include('connect.php');

    $sql = "SELECT * FROM capnhat WHERE 1";

    $data = mysqli_query($conn, $sql);

    $capnhat = [];

    while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
        $capnhat[] = array(
            'id'             => $row['id'],
            'title'          => $row['title'],
            'text'           => $row['text'],
            'picture'        => $row['picture']
        );
    }
    $listcapnhat = array_reverse($capnhat);
    $limit = 3;

    ?>
    <section class="noi-dung">
        <ul class="danhsach-noidung clearfix">
            <?php foreach (array_slice($listcapnhat, 0, $limit) as $cn) : ?>
                <li>
                    <a href="delete-capnhat.php?id=<?php echo $cn["id"] ?>">Xóa</a>|| <a href="update-capnhat.php?id=<?php echo $cn["id"] ?>">Sửa</a>
                    <?php echo '<p class="service-image"><img src="' . $cn['picture'] . '" alt="#" class="img-noidung">'; ?>
                    <div class="inner">
                        <h3><?= $cn['title'] ?></h3>
                        <p class="info"><?= $cn['text'] ?></p>
                    </div>

                </li>
            <?php endforeach; ?>

        </ul>
    </section>

    <?php
    include_once __DIR__ . '/footer.php';
    ?>

</body>

</html>