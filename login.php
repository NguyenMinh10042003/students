<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];

    // Kiểm tra tài khoản trong database
    $stmt = $conn->prepare("SELECT * FROM sinhvien WHERE MaSV = ?");
    $stmt->bind_param("s", $MaSV);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['MaSV'] = $MaSV;
        header("Location: index.php");
        exit();
    } else {
        $error = "Sai Mã SV!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        Mã Sinh Viên: <input type="text" name="MaSV" required><br>
        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>
