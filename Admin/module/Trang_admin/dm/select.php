<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/tonkho.css">
    <script src="../../../../script.js"></script>
</head>
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
          <!-- xử lý trang hiển thị danh mục -->
      <?php
      //gọi đến file control.php
        include('control.php');
        //kết nối với CSDL
        $conn=connect();
        //tạo một đối tượng mới trong lớp data_sp() 
        $get_data = new data_dm();
        //hiển thị tất cả dữ liệu ở bảng danh mục
        $s = $get_data -> select_dm();
      ?>
      <!-- tọa một bảng gồm các trường tương ứng với
       CSDL để hiện thị dữ liệu ở bảng danh mục -->
       <div class="container_table">
      <table style="margin: 0 auto; margin-top:250px">
        <caption>DANH MỤC <br>
        <center><a style="text-decoration:none" 
        href="insert.php">Thêm mới</a></center>
        </caption>
        
          <tr>
            <th>Mã danh mục</th>
            <th>Tên danh mục</th>
            <th colspan=2 style="width:70px">Tùy chọn</th>
          </tr>
        <!--  lặp dữ liệu các bản ghi của bảng danh mục 
        và hiển thị chúng trong một bảng-->
        <?php
           
            foreach($s as $row){
        ?>
          <tr>
            <!-- đổ dữ liệu từ database ra bảng -->
            <td><?php echo $row['madm']; ?></td>
            <td><?php echo $row['tendm'] ;?></td>
            <!-- các tùy chọn 'sửa', 'xóa' -->
            <td> <a style="text-decoration:none" 
            href="sua.php?up=<?php echo $row['id_dm']?>">Sửa</a></td>
            <td> <a style="text-decoration:none" 
            href="xoa.php?del=<?php echo $row['id_dm']?>"
              onclick="if(confirm('BẠN CÓ CHẮC MUỐN XÓA KHÔNG?'))
                return true;
                else return false;">Xóa</a></td>
          </tr>
        <?php
        }
        ?>

      </table>
      </div>
</body>
</html>