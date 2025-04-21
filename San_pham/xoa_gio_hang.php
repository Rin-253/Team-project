z<?php
// ket noi vs db
$conn = mysqli_connect('localhost', 'root', '', 'admin') 
or die('Could not connect to database!');
mysqli_set_charset($conn, 'utf8');

if(isset($_GET['cart_id'])) {
    // xoa sản phẩm theo ID giỏ hàng
    $cart_id = $_GET['cart_id'];
    $sql = "DELETE FROM gio_hang WHERE id_giohang = $cart_id";
    $result = mysqli_query($conn, $sql);

  // Kiểm tra xem việc xóa có thành công không
    if($result) {
       // Chuyển hướng về trang gio_hang.php sau khi xóa thành công
        header("Location:gio_hang.php");
        exit();
    } else {
        // Hiển thị thông báo lỗi nếu xóa không thành công
        echo "Error deleting gio_hang item: " . mysqli_error($conn);
    }

} else {
    // xoa tat ca cac san pham trong gio hang
    $sql = "DELETE FROM gio_hang";
    $result = mysqli_query($conn, $sql);

   // Kiểm tra xem việc xóa có thành công không
    if ($result) {
        header("Location:gio_hang.php");
        exit();
    } else {
        echo "Error deleting items from gio_hang table: " . mysqli_error($conn);
    }
}

// Close database
mysqli_close($conn);
?>
