<!-- xử lý chức năng cập nhật size cho giày -->

<?php 
   include('../Admin/module/Trang_admin/dm/control.php');
   $conn = connect();
   // Kiểm tra xem có tồn tại biến cart_id và size không
   if($_POST['cart_id']){
     $cart_id = $_POST['cart_id'];
     $size = $_POST['size'];
   //   cập nhật size giày ở giỏ hàng
     $sql_update = "UPDATE gio_hang SET size = $size 
        WHERE id_giohang = $cart_id AND status ='pending'";
        if(mysqli_query($conn, $sql_update)) {
           // Cập nhật số lượng sản phẩm thành công, chuyển hướng đến gio_hang.php
            header("Location: gio_hang.php");
            exit(); 
        } else {
            echo "Error: " . mysqli_error($conn);
        }
   }
?>