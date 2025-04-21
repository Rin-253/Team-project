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
              <li><a href="../dm/insert.php">Danh mục</a></li>
              <li><a href="insert.php">Sản phẩm</a></li>
              <li><a href="../donhang.php">Quản lý đơn hàng</a></li>
            
              <li><a href="../tonkho.php">Quản lý tồn kho</a></li>
                   <li><a href="../doanhthu.php">Quản lý doanh thu</a></li><hr>
              
              
              <li><strong><a href="../Trang_chuadmin.php">Đăng xuất</a></strong></li>
                  
              
          </ul>
          <!-- Thanh menu -->
          <span class="icon">
              <!-- Thanh 3 gạch cho menu -->
              <img src="../../../../icon/menu.png" class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
    </header>
    <!-- tạo 1 form thêm mới 1 sản phẩm -->
    <div  style="margin-top:200px">
    <table  style="margin: 0 auto"> 
    <caption><center>THÊM MỚI SẢN PHẨM</center></caption> 

        <form role="form" method="POST" enctype="multipart/form-data" action="control.php">
            <tr>
                <td>Ảnh </td>
                <td><input type="file" name="anh"></td>
            </tr>
            <tr>
                <td>Mã sản phẩm </td>
                <td><input type="text" name="msp"></td>
            </tr>
            <tr>
                <td>Tên sản phẩm </td>
                <td><input type="text" name="tsp"></td>
            </tr>
            <tr>
                <td>Danh mục</td>
                <td>
                    <!-- lấy ra danh sách danh mục từ CSDL-->

                    <select name="dm" >
                        <?php
                        // gọi tới trang control.php
                            include('control.php');
                            // truy cập tới biến toàn cục $conn
                            // để kết nối với database
                            global $conn;
                            // câu lệnh để lấy ra danh sách danh mục
                            $sql_dm="SELECT * FROM danhmuc";
                            $q=mysqli_query( $conn, $sql_dm);
                            while($k = mysqli_fetch_array($q)){
                        ?>
                            <option value="<?php  echo $k['id_dm'] ?>">
                                <?php  echo $k['tendm'] ?></option>
                        <?php
                            }
                        ?>
                    
                    </select>
                </td>
            </tr>
            <tr>
                <td>Size </td>
                <td>
                    <select name="size" >
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                    
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tóm tắt </td>
                <td><textarea name="tt"  rows="5" 
                style="resize:none"></textarea></td>
            </tr>
            <tr>
                <td>Nội dung </td>
                <td><textarea name="nd" rows="10"></textarea></td>
            </tr>
            <tr>
                <td>Số lượng </td>
                <td><input type="text" name="slg"></td>
            </tr>
            <tr>
                <td>Giá bán </td>
                <td><input type="text" name="gb"></td>
            </tr>
            <tr>
                <td>Giá nhập</td>
                <td><input type="text" name="gn"></td>
            </tr>
           
           
            <tr>
                <td>Nhà cung cấp</td>
                <td>
                    <input type="text" name="ncc" >
                </td>
            </tr>
            <tr>
                <td ><button 
                        type="submit" name="them" >THÊM
                    </button>
                </td>
                <td><a style="text-decoration:none" href="select.php">Hiển thị</a></td>
            </tr>
        </form>    
    </table>
    </div>
    
</body>
</html>
