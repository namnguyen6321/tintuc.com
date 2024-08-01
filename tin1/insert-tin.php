<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Tin Tức</title>
    <link rel="stylesheet" href="insert.css">
</head>

<body>
    <div>
        <div class="container">
            <!-- <h1>Thêm Tin Tức Mới</h1> -->
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="title">Tiêu Đề:</label>
                <input type="text" id="title" name="title">
                <label for="summary">Tóm Tắt:</label>
                <input type="text" name="text"><br>
                <label for="image">Ảnh:</label>
                <input type="file" id="fileToUpload" name="fileToUpload">
                <button type="submit" name="add">Gửi</button>
            </form>
        </div>
    </div>

    <?php
    include 'connect.php';
    $redirectURL = "http://localhost:3000/index.php?page_layout=thongtin";

    if (isset($_POST['add'])) {
        // Xử lý ảnh
        $target_dir = "pic";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $title = $_POST['title'];
        $text = $_POST['text'];

        if (
            isset($title) &&
            isset($text) &&
            !empty($title) &&
            !empty($text)
        ) {
            $queryCheck = "SELECT * FROM new WHERE title = '$title'";
            $resultCheck = mysqli_query($conn, $queryCheck);

            if (mysqli_num_rows($resultCheck) > 0) {
                echo "<script>alert('Tiêu đề đã tồn tại');</script>";
            } else {
                // Kiểm tra file ảnh có hợp lệ ko
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File chọn không phải ảnh";
                    $uploadOk = 0;
                }

                // Kiểm tra nếu file đã tồn tại
                if (file_exists($target_file)) {
                    echo "File đã tồn tại";
                    $uploadOk = 0;
                }

                // Cho phép các định dạng file nhất định
                if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
                    echo "Sai định dạng";
                    $uploadOk = 0;
                }

                // Kiểm tra nếu $uploadOk = 0 thì không upload được
                if ($uploadOk == 0) {
                    echo "File của bạn chưa được tải lên";
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $picture = $target_file;
                        $query = "INSERT INTO `new`(`title`, `text`, `picture`) VALUES ('$title', '$text', '$picture');";
                        if (mysqli_query($conn, $query)) {
                            echo "<script>
                                    alert('Thêm thành công');
                                    // window.location.href = 'index.php?page_layout=thongtin';
                                </script>";
                        } else {
                            echo "Chưa thêm được";
                        }
                    } else {
                        echo "Chưa thêm được";
                    }
                }
            }
        }
    } ?>
</body>

</html>