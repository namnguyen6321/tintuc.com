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
    include_once __DIR__ . '/header.php';
    ?>
    <section id="banner">
        <h1>CHI TIẾT
            CẬP NHẬT</h1>
    </section>
    <?php

    include('connect.php');

    $sql = "SELECT * FROM new WHERE 1";

    $data = mysqli_query($conn, $sql);

    $capnhat = [];

    while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
        $capnhat[] = array(
            'ma_capnhat'        => $row['ma_capnhat'],
            'chu_de'            => $row['chu_de'],
            'tom_tat'           => $row['tom_tat'],
            'duong_dan'         => $row['duong_dan'],
            'anh'               => $row['anh']
        );
    }
    // var_dump($danhSachTin);
    ?>
    <section class="noi-dung">
        <ul class="danhsach-noidung clearfix">
            <?php foreach ($capnhat as $cn) : ?>
                <li><a href="<?= $cn['duong_dan'] ?>">
                        <?php echo '<p class="service-image"><img src="' . $cn['anh'] . '" alt="#" class="img-noidung">'; ?>
                        <!-- <p class="service-image"><img src="<?= $tin['anh'] ?>" alt="#" class="img-noidung"></p> -->
                        <div class="inner">
                            <h3><?= $cn['chu_de'] ?></h3>
                            <p class="info"><?= $cn['tom_tat'] ?></p>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>

        </ul>
    </section>



</body>

</html>