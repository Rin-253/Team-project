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
     <?php
     //chuyển trang tới control.php file và 
     //tạo 1 kết nối tới database

        include('control.php');
        $conn=connect();
        $get_data = new data_dm();
        //lấy  dữ liệutừ database
        $s = $get_data ->select_id($_GET['up']);
            foreach($s as $i){
        ?>
        <!-- tạo một form với phương thức POST -->
         <form method="POST">
        <table border="1" aligh="center" style="margin: 0 auto; margin-top:250px"> 
            <caption><center>CẬP NHẬT DANH MỤC</center></caption>
           <!-- hiển thị thông tin danh mục theo id_dm -->
            <tr>
                <td>Mã danh mục </td>
                <td><input type="text" name="mdm" value="<?php echo $i['madm'];?>"></td>
            </tr>
            <tr>
                <td>Tên danh mục </td>
                <td><input type="text" name="tdm" value="<?php echo $i['tendm'];?>"></td>
            </tr>
            <tr>
                <td colspan=2>
                <button type="submit" name="sua" >UPDATE</button>
                </td>
                
            </tr>

            <?php
                }
                ?>   
       
        
        </table>
        </form>
        <?php
        //check nút update có được click vào không?
        //nếu có thì update danh mục
            if(isset($_POST['sua'])){ 
                $u = $get_data -> update_dm($_GET['up'],
                    $_POST['mdm'], $_POST['tdm']);
                
                if ($u)                           
                    echo "<script>alert('SỬA THÀNH CÔNG!');
                    window.location='select.php';</script>";
                else 
                    echo "<script>alert('KHÔNG THỰC THI ĐƯỢC!!')</script>";
            }
        ?>
</body>
</html>
