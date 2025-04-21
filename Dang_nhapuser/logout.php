<?php session_start(); 
 
if (isset($_SESSION['taikhoan'])){
    unset($_SESSION['taikhoan']); // xóa session login
}
?>
<a href="../Trang_chu/index.php">HOME</a>