<?php
$host = "localhost"; // Máy chủ MySQL (localhost là mặc định cho XAMPP)
$user = "root"; // Tài khoản mặc định của XAMPP
$pass = ""; // Mặc định XAMPP không có mật khẩu
$db = "test1"; // Tên database bạn muốn kết nối

// Kết nối MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    echo "Kết nối thành công!";
}
?>
