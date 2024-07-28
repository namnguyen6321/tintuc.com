<form method="post" enctype="multipart/form-data">
    <div>
        <label for="">Chủ đề</label>
        <input type="text" name="chu_de"><br>
        <label for="">Tóm tắt</label>
        <input type="text" name="tom_tat"><br>
        <label for="">Đường dẫn</label>
        <input type="text" name="duong_dan"><br>
        <label for="">Ảnh</label>
        <input type="file" name="fileToUpload"><br>
        <button type="submit" name="Them">Xác nhận</button>
    </div>
</form>
<?php
include 'connect.php';
// $redirectURL = "http://localhost:3000/index.php?page_layout=thongtin";
if (isset($_POST['them'])) {
    //Xử lý ảnh
    $target_dir = "assets/img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $chu_de = $_POST['chu_de'];
    $tom_tat = $_POST['tom_tat'];
    $duong_dan = $_POST['duong_dan'];
    if (
        isset($chu_de) &&
        isset($tom_tat) &&
        isset($duong_dan) &&
        !empty($chu_de) &&
        !empty($tom_tat) &&
        !empty($duong_dan)

    ) {
        $queryCheck = "Select * from tin1 Where 1";
        $resultCheck = mysqli_query($conn, $queryCheck);
        if (mysqli_num_rows($resultCheck) > 0) {
            echo "<script>
                alert('User đã tồn tại);
                </script>";
        } else {
            //Kiểm tra file ảnh có hợp lệ ko
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File chọn ko phải ảnh";
                $uploadOk = 0;
            }

            //Kiểm tra nếu file đã tồn tại
            if (file_exists($target_file)) {
                echo "File đã tồn tại";
                $uploadOk = 0;
            }

            //Cho phép các định dạng file nhất định
            if (
                $imageFileType != "png" &&
                $imageFileType != "jpg" &&
                $imageFileType != "jpeg"
            ) {
                echo "Sai định dạng";
                $uploadOk = 0;
            }

            //Kiểm tra nếu $uploadOk = 0 thì ko upload đc
            if ($uploadOk == 0) {
                echo "File của bạn chưa đc tải lên";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                    $query = "INSERT INTO `tin1`(`chu_de`, `tom_tat`, `duong_dan`,`anh`) VALUES('$chu_de', '$tom_tat', '$duong_dan', '','$anh');";
                    echo $query;
                    if (mysqli_query($conn, $query)) {
                        echo "<script>
                                  alert('Them thanh cong');
                                  window.location.href = 'index.php?page_layout=thongtin';
                              </script>";
                    }
                } else {
                    echo "Chua them duoc";
                }
            }
        }
    }
}
?>