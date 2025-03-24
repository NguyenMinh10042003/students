<?php
include 'config.php';

// Kiểm tra nếu MaSV tồn tại trong URL
if (isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];

    // Truy vấn thông tin sinh viên theo MaSV
    $stmt = $conn->prepare("SELECT * FROM sinhvien WHERE MaSV = ?");
    $stmt->bind_param("s", $MaSV);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra nếu sinh viên tồn tại
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sinh viên!";
        exit();
    }
    $stmt->close();
} else {
    echo "Thiếu mã số sinh viên!";
    exit();
}

// Xử lý khi người dùng gửi form cập nhật
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];

    // Xử lý hình ảnh nếu có tải lên mới
    if ($_FILES['Hinh']['name']) {
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["Hinh"]["name"]);
        move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);
        $sql = "UPDATE sinhvien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', Hinh='$target_file' WHERE MaSV='$MaSV'";
    } else {
        $sql = "UPDATE sinhvien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh' WHERE MaSV='$MaSV'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }



    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sinh viên</title>
</head>
<body>
    <h2>Sửa thông tin sinh viên</h2>
    <form method="post" enctype="multipart/form-data">
    Họ tên: <input type="text" name="HoTen" value="<?= $student['HoTen'] ?>" required><br>
    Giới tính: <input type="text" name="GioiTinh" value="<?= $student['GioiTinh'] ?>"><br>
    Ngày sinh: <input type="date" name="NgaySinh" value="<?= $student['NgaySinh'] ?>"><br>
    Hình ảnh: <input type="file" name="Hinh"><br>
    <button type="submit">Cập nhật</button>
</form>

</body>
</html>
