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