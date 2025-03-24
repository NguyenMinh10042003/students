<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    // Xử lý upload file
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["Hinh"]["name"]);
    move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);

    // Lưu đường dẫn file vào CSDL
    $sql = "INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$target_file', '$MaNganh')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
</head>
<body>
    <h2>Thêm sinh viên</h2>
    <form method="post" enctype="multipart/form-data">
        Mã SV: <input type="text" name="MaSV" required><br>
        Họ tên: <input type="text" name="HoTen" required><br>
        Giới tính: <input type="text" name="GioiTinh"><br>
        Ngày sinh: <input type="date" name="NgaySinh"><br>
        Hình ảnh: <input type="file" name="Hinh"><br>
        Mã ngành: <input type="text" name="MaNganh"><br>
        <button type="submit">Thêm</button>
    </form>
</body>
</html>
