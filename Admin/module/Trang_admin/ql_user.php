
<?php
   // bắt đầu 1 phiên làm việc 
   session_start();
   //kiểm tra xem có nhấn vào nút đăng nhập không
   //hoặc có tồn tại phiên đăng nhập hay không
   //mếu có thì vào được trang quản trị của admin
   //nếu không thì phải đăng nhập
    if(!isset($_SESSION['dn']) || $_SESSION['dn'] != true){
      header('Location: ../Tai_khoan/dangnhap.php');
      exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/tonkho.css">
    
    <script src="../../../../script.js"></script>
</head>
<body>
<header>
        <!-- Logo -->
        <a href="#" class="logo">logo</a>
        <div class="group">
          <!-- Navigation menu -->
          <ul class="navigation">
          <li><a href="ql_user.php">Quản lý người dùng</a></li>
              <li><a href="dm/insert.php">Danh mục </a></li>
              <li><a href="sp/insert.php">Sản phẩm</a></li>
              <li><a href="donhang.php">Quản lý đơn hàng</a></li>
              <li><a href="tonkho.php">Quản lý tồn kho</a></li>
              <li><a href="doanhthu.php">Doanh thu</a></li><hr>
              <li>
                <?php 
                // xóa session login
                if (isset($_SESSION['dn'])){
                    unset($_SESSION['dn']); 
                }
                ?>
                <strong><a href="Trang_chuadmin.php">Đăng xuất</a></strong>
              </li>
                  
              
          </ul>
          <!-- Thanh menu -->
          <span class="icon">
              <!-- Thanh 3 gạch cho menu -->
              <img src="../../../icon/menu.png" class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
    </header>
          <!-- xử lý trang quản trị user -->
      <?php
      //gọi đến file control.php
        include('dm/control.php');
        //kết nối với CSDL
        $conn=connect();
         //lấy ra thông tin user
         $sql= "SELECT * FROM userdk ";
        $result= mysqli_query($conn,$sql);
      ?>
      <!-- tọa một bảng gồm các trường tương ứng với
       CSDL để hiện thị dữ liệu ở bảng danh mục -->
       <div class="container_table">
      <table style="margin: 0 auto; margin-top:200px">
        <caption>THÔNG TIN KHÁCH HÀNG
        </caption>
        <br>
          <tr>
            <th>Số điện thoại<i></i></th>
            <th>Tên khách hàng</th>
            <th>Mật khẩu</th>
            <th>Email</th>
            <th style="width:70px">Tùy chọn</th>
          </tr>
        <!--  lặp dữ liệu các bản ghi của bảng userdk
        và hiển thị chúng trong một bảng-->
        <?php
           
            foreach($result as $row){
        ?>
          <tr>
            <!-- đổ dữ liệu từ database ra bảng -->
            <td><?php echo $row['sdt']; ?></td>
            <td><?php echo $row['ten'] ;?></td>
            <td><?php echo $row['pass'] ;?></td>
            <td><?php echo $row['email'] ;?></td>
            <!-- các tùy chọn  'xóa' -->
            <td> <a style="text-decoration:none" 
            href="xoa.php?del=<?php echo $row['id_u']?>"
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