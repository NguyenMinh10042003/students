<?php
session_start();
include 'config.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

// Lấy danh sách sinh viên từ CSDL
$result = $conn->query("SELECT * FROM sinhvien");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
</head>
<body>
    <h2>Danh sách sinh viên</h2>
    <p>Xin chào, <strong><?= $_SESSION['MaSV'] ?></strong> | <a href="logout.php">Đăng xuất</a></p>
    <a href="create.php">Thêm sinh viên</a>
    <table border="1">
        <tr>
            <th>MaSV</th><th>HoTen</th><th>GioiTinh</th><th>NgaySinh</th><th>Hinh</th><th>Nganh</th><th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['MaSV'] ?></td>
            <td><?= $row['HoTen'] ?></td>
            <td><?= $row['GioiTinh'] ?></td>
            <td><?= $row['NgaySinh'] ?></td>
            <td>
                <?php if (!empty($row['Hinh'])): ?>
                    <img src="<?= $row['Hinh'] ?>" width="50">
                <?php else: ?>
                    <img src="upload/default.png" width="50">
                <?php endif; ?>
            </td>

            <td><?= $row['MaNganh'] ?></td>
            <td>
                <a href="detail.php?MaSV=<?= $row['MaSV'] ?>">Xem</a> | 
                <a href="edit.php?MaSV=<?= $row['MaSV'] ?>">Sửa</a> | 
                <a href="delete.php?MaSV=<?= $row['MaSV'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
