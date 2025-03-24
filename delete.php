<?php
include 'config.php';

// Kiểm tra nếu MaSV được truyền vào
if (isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];

    // Sử dụng Prepared Statement để xóa sinh viên
    $stmt = $conn->prepare("DELETE FROM sinhvien WHERE MaSV = ?");
    $stmt->bind_param("s", $MaSV);  // "s" là kiểu string
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Lỗi: Không tìm thấy mã sinh viên cần xóa!";
}
?>
