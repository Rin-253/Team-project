<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/indexad.css">
    <script src="../../../../script.js"></script>
</head>
<style>
    table {
        margin: 0 auto;
        border-collapse: collapse;
        width: 400px;
    }

    caption {
        text-align: center;
        font-weight: bold;
        padding: 10px;
        background-color: #333;
        color: #fff;
    }

    td {
        padding: 8px;
        border: 1px solid #ccc;
    }

    input[type="file"],
    input[type="text"],
    textarea,
    select {
        padding: 5px;
        width: 100%;
        box-sizing: border-box;
    }

    textarea {
        resize: none;
    }

    button {
        background-color: #333;
        color: #fff;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }

    a {
        text-decoration: none;
        color: #333;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
<body>
    <header>
            <!-- Logo -->
            <a href="#" class="logo">logo</a>
            <div class="group">
            <!-- Navigation menu -->
            <ul class="navigation">
            <li><a href="../ql_user.php">Quản lý người dùng</a></li>
                <li><a href="insert.php">Danh mục</a></li>
              <li><a href="../sp/insert.php">Sản phẩm</a></li>
              <li><a href="../donhang.php">Quản lý đơn hàng</a></li>
                
                <li><a href="../tonkho.php">Quản lý tồn kho</a></li>
                    <li><a href="../doanhthu.php">Quản lý doanh thu</a></li><hr>
                
                
                <li><strong><a href="../Trang_chuadmin.php">Đăng xuất</a></strong></li>
                    
                
            </ul>
            <!-- Thanh menu -->
            <span class="icon">
                <!-- Thanh 3 gạch cho menu -->
                <img src="../../../icon/menu.png" class="menuToggle" 
                style="width: 30px;">
            </span>
        </div>
        
        </header>
        <!-- tạo 1 form để thêm danh mục -->
    <table border="1" aligh="center" style="margin: 0 auto; margin-top:250px"> 
        <caption><center>THÊM MỚI DANH MỤC</center></caption> 
        <form method="POST">
           
            <tr>
                <td>Mã danh mục </td>
                <td><input type="text" name="mdm"></td>
            </tr>
            <tr>
                <td>Tên danh mục </td>
                <td><input type="text" name="tdm"></td>
            </tr>

            <tr>
                <td ><input type="submit" name="them" value="Thêm"></td>
                <td><a style="text-decoration:none" 
                href="select.php">Hiển thị</a></td>
            </tr>
        </form>    
    </table>
    <!-- xử lý form thêm danh mục -->
    <?php
    // chuyển trang với trang control.php
        include('control.php');
        // gọi class data_dm
        $conn=connect();
        $get_data = new data_dm();
        //Kiểm tra có nhấn vào nút thêm hay ko?
        if(isset($_POST['them'])){
            // nếu để trrongs các trường -> thông báo  không được bỏ trống
            // nếu không để trống -> thêm mới danh mục

            if(empty($_POST["mdm"]) || empty($_POST["tdm"])) {
                echo "<script>alert('Vui lòng không được bỏ trống')</script>";
            }
            else{
                $in = $get_data ->insert_dm($_POST['mdm'],
                    $_POST['tdm']);
                if($in)
                    echo "<script>alert('THÊM MỚI THÀNH CÔNG!!');
                    window.location='insert.php';</script> ";
                else
                    echo "<script>alert('KHÔNG THỰC THI ĐƯỢC!!')</script>";
            }
        }    

            
    ?>
    
</body>
</html>
