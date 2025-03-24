<?php
include 'config.php';

// Kiểm tra xem MaSV có tồn tại không
if (isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];
    
    // Truy vấn dữ liệu sinh viên theo MaSV
    $stmt = $conn->prepare("SELECT * FROM sinhvien WHERE MaSV = ?");
    $stmt->bind_param("s", $MaSV);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Kiểm tra xem sinh viên có tồn tại không
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
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sinh viên</title>
</head>
<body>
    <h2>Chi tiết sinh viên</h2>
    <p><strong>Mã số sinh viên:</strong> <?= htmlspecialchars($student['MaSV']) ?></p>
    <p><strong>Họ tên:</strong> <?= htmlspecialchars($student['HoTen']) ?></p>
    <p><strong>Giới tính:</strong> <?= htmlspecialchars($student['GioiTinh']) ?></p>
    <p><strong>Ngày sinh:</strong> <?= htmlspecialchars($student['NgaySinh']) ?></p>
    <p><strong>Hình ảnh:</strong> <img src="<?= htmlspecialchars($student['Hinh']) ?>" alt="Hình ảnh sinh viên" width="100"></p>
    <p><strong>Mã ngành:</strong> <?= htmlspecialchars($student['MaNganh']) ?></p>
    
    <a href="index.php">Quay lại</a>
</body>
</html>
