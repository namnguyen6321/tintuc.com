<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
    <link rel="stylesheet" href="tin1.css">
</head>

<body>
    <div id="header">
        <nav class="conteiner">
            <a href="" id="logo">
                <img src="\TINTUC.COM\assets\img\logo.jpg" alt="Tintuc">
            </a>
            <ul id="main-menu">
                <li><a href="">Nóng </a></li>
                <li><a href="">Mới</a></li>
                <li><a href="">Video</a></li>
                <li><a href="">Chủ Đề</a></li>
                <li><a href="">Năng lượng tích cực</a></li>
                <li><a href="">Khám phá thế giới </a></li>
                <li><a href="">Khám phá Việt Nam</a></li>

            </ul>
        </nav>
    </div>
    <!-- <div>
        <img src="assets/img/tin1-1.png" alt="banner">
    </div> -->
    <section id="banner">
        <h1>Tin tức</h1>
    </section>
    <?php

    include('connect.php');

    $sql = "SELECT * FROM tin1 WHERE 1";

    $data = mysqli_query($conn, $sql);

    $danhSachTin = [];

    while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
        $danhSachTin[] = array(
            'ma_tin'        => $row['ma_tin'],
            'chu_de'        => $row['chu_de'],
            'tom_tat'       => $row['tom_tat'],
            'duong_dan'     => $row['duong_dan'],
            'anh'           => $row['anh']
        );
    }
    // var_dump($danhSachTin);
    ?>
    <section class="noi-dung">
        <ul class="danhsach-noidung clearfix">
            <?php foreach ($danhSachTin as $tin) : ?>
                <li><a href="<?= $tin['duong_dan'] ?>">
                        <?php echo '<p class="service-image"><img src="' . $tin['anh'] . '" alt="#" class="img-noidung">'; ?>
                        <!-- <p class="service-image"><img src="<?= $tin['anh'] ?>" alt="#" class="img-noidung"></p> -->
                        <div class="inner">
                            <h3><?= $tin['chu_de'] ?></h3>
                            <p class="info"><?= $tin['tom_tat'] ?></p>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>

        </ul>
    </section>
    <a href="insert.php">Thêm mới</a>

</body>

</html>