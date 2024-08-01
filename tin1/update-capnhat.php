<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="update.css">
</head>
<style>
</style>

<body>
    <?php
    // 1.mo ket noi 
    include('connect.php');

    // 2.chuan bi cau enh tim du lieu
    $id = $_GET['id'];
    $sql = "SELECT * FROM capnhat
    WHERE id=$id";

    // 3.thuc Thi 
    $datacu = mysqli_query($conn, $sql);
    // 4 phan tach lieu thanh mang trong php 
    $arrDuLieuCu = [];
    $arrDuLieuCu = mysqli_fetch_array($datacu, MYSQLI_ASSOC);
    ?>

    <div>
        <div class="container">
            <h1>Sửa cập nhật</h1>
            <form action="" name="frmSua" method="POST" enctype="multipart/form-data">
                <label for="title">Tiêu Đề:</label>
                <input type="text" id="title" name="title" value="<?= $arrDuLieuCu['title'] ?>">
                <label for="summary">Tóm Tắt:</label>
                <input type="text" name="text" value="<?= $arrDuLieuCu['text'] ?>"><br>
                <button type="submit" name="add">Gửi</button>
            </form>
        </div>
    </div>

    <?php
    // Nếu người dùng bấm nút thêm thì mới xử lí
    if (isset($_POST['add'])) {
        // 1.Mở kết nối
        include('connect.php');
        $title = $_POST['title'];
        $text = $_POST['text'];

        // 2.Chuẩn bị câu lệch 
        $sql = "UPDATE capnhat
            SET title='$title',text='$text'
            WHERE id = $id";
        // 3 thuc thi 
        mysqli_query($conn, $sql);

        // 4chuyen huong ve index 
        echo '<script>location.href ="chitietcapnhat-qt.php"</script>';
    }
    ?>
</body>

</html>