<!-- xử lý chức năng thêm vào giỏ hàng -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php 
include('../Admin/module/Trang_admin/dm/control.php');
if(isset($_POST['product_id'])) {
    $id_sp = $_POST['product_id'];
    $size = 36;
    $amounts = 1;
    // Connect database
    $conn = connect();
    
    // Kiểm tra xem sản phẩm đã tồn tại trong bảng gio_hang chưa
    $sql_check = "SELECT * FROM gio_hang 
    WHERE id_sp = $id_sp AND status ='pending'";
    $result_check = mysqli_query($conn, $sql_check);

    // Nếu sản phẩm tồn tại trong bảng gio_hang
    if(mysqli_num_rows($result_check) > 0) {
        $row = mysqli_fetch_assoc($result_check);
        $amount = $row['amount'] + $amounts;

  // Cập nhật số lượng cho sản phẩm hiện có
        $sql_update = "UPDATE gio_hang SET amount = $amount 
        WHERE id_sp = $id_sp AND status ='pending'";
        if(mysqli_query($conn, $sql_update)) {
           // Cập nhật số lượng sản phẩm thành công, chuyển hướng đến gio_hang.php
            header("Location: ../San_pham/gio_hang.php");
            exit(); 
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Lấy thông tin chi tiết sản phẩm từ cơ sở dữ liệu dựa trên id_sp
        $sql = "SELECT * FROM sanpham WHERE id_sp = $id_sp";
        $result = mysqli_query($conn, $sql);

        // Nếu sản phẩm tồn tại
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $product_name = $row['tensp'];
            $product_price = $row['gb'];
            
                // Chèn sản phẩm vào bảng gio_hang
                $sql_insert = "INSERT INTO gio_hang (name, price, amount,size, id_sp) 
                VALUES ('$product_name', '$product_price', '$amounts','$size','$id_sp')";
                if(mysqli_query($conn, $sql_insert)) {
                // Sản phẩm được thêm vào giỏ hàng thành công, chuyển hướng đến gio_hang.php
                    header("Location:../San_pham/gio_hang.php");
                    exit(); 
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            
        } else {
            echo "Product not found.";
        }
    }

    // Close the database 
    mysqli_close($conn);
} else {
    echo "Product ID not provided.";
}
?>
</body>
</html>