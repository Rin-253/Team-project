<?php
// Connect database
function connect(){
    $conn = mysqli_connect('localhost', 'root', '', 'admin') 
    or die('Could not connect to database!');
    mysqli_set_charset($conn, 'utf8');
    return $conn;
}

// // Kiểm tra xem sản phẩm_id có được cung cấp trong URL không
if(isset($_POST['id_sp'])) {
    $id_sp = $_POST['id_sp'];
    $size = $_POST['size_'.$id_sp];
    $amountPattern = 'amount_'.$id_sp;
    $amounts = $_POST[$amountPattern];
    var_dump($amounts);
    var_dump($id_sp);
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

        //Cập nhật số lượng cho sản phẩm hiện có
        $sql_update = "UPDATE gio_hang SET amount = $amount 
        WHERE id_sp = $id_sp AND status ='pending'";
        if(mysqli_query($conn, $sql_update)) {
           // Cập nhật số lượng sản phẩm thành công, chuyển hướng đến gio_hang.php
            header("Location:gio_hang.php");
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
                // Cập nhật số lượng sản phẩm thành công, chuyển hướng đến gio_hang.php
                header("Location:gio_hang.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Product not found.";
        }
    }

    // Đóng kết nối cơ sở dữ liệu
    mysqli_close($conn);
} else {
    echo "Product ID not provided.";
}
// Kiểm tra xem sản phẩm_id có được cung cấp trong URL không
?>
