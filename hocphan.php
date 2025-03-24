<?php
session_start();
include 'config.php';

// Kiểm tra xem sinh viên đã đăng nhập chưa
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];

// Xử lý đăng ký học phần
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['MaHP'])) {
    $MaHP = $_POST['MaHP'];

    // Kiểm tra sinh viên đã đăng ký chưa
    $check = $conn->prepare("SELECT * FROM dangkyhocphan WHERE MaSV=? AND MaHP=?");
    $check->bind_param("ss", $MaSV, $MaHP);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO dangkyhocphan (MaSV, MaHP) VALUES (?, ?)");
        $stmt->bind_param("ss", $MaSV, $MaHP);
        $stmt->execute();
        echo "<script>alert('Đăng ký thành công!');</script>";
    } else {
        echo "<script>alert('Bạn đã đăng ký học phần này rồi!');</script>";
    }
}

// Lấy danh sách học phần
$result = $conn->query("SELECT * FROM hocphan");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Học Phần</title>
    <style>
        table { width: 60%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        button { background-color: green; color: white; border: none; padding: 5px 10px; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">DANH SÁCH HỌC PHẦN</h2>
    <table>
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['MaHP'] ?></td>
            <td><?= $row['TenHP'] ?></td>
            <td><?= $row['SoTinChi'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="MaHP" value="<?= $row['MaHP'] ?>">
                    <button type="submit">Đăng Ký</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
