

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/tonkho.css">
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

</head>
<body>

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
     
    <div class="text_doanhthu">  QUẢN LÝ HÀNG TỒN KHO</div><hr 
    style="color: aquamarine;margin-top: 6px;">
   
   
  <!-- hiển thị hàng tồn kho -->
  <?php
      //gọi đến trang control.php
      include('sp/control.php');
      //kết nối với CSDL
      $conn=connect();
      //biến slg tồn kho
      $totalInventory  = 0;
      //biến tổng doanh thu
      $totalIncome  = 0;
      //biến tổng doanh thu từng sản phẩm
      $total_item_price = 0;
      //lấy ra thông tin đơn hàng từ bảng sanpham,gio_hang
        $sql= "SELECT sanpham.*, 
              gio_hang.amount,
              sanpham.slg,
              SUM(gio_hang.amount) AS slb, 
              gio_hang.price
              FROM sanpham
              LEFT JOIN gio_hang ON sanpham.id_sp = gio_hang.id_sp
              WHERE gio_hang.status = 'da_thanh_toan'
              GROUP BY sanpham.id_sp";
        $result=mysqli_query($conn,$sql);
        mysqli_close($conn);//đóng kết nối database
      ?>
    <div class="container_table">
    <table class="table table-bordered table-striped"> 
      <tr>
        <th>Ảnh sản phẩm</th>
        <th>Nhập kho</th>
        <th>Xuất kho</th>
        <th>Tồn kho</th>
      </tr>
      <?php
        while ($i = mysqli_fetch_array($result)){
          
          $price_str = $i['price'];
          // loại bỏ bất kỳ khoảng trắng nào và chuỗi "VND" khỏi biến $price_str
          $price_str = str_replace(array(' ', 'VND'), '', $price_str);
          // Hàm intval() được sử dụng để chuyển đổi một chuỗi thành số nguyên.
          $price_numeric = intval($price_str);
          // tính tổng doanh thu của từng sản phẩm
          $total_item_price = $price_numeric * $i['slb'];
          //tổng số lượng tồn kho và doanh thu
          $totalInventory += ($i['slg'] - $i['slb']);
          $totalIncome +=$total_item_price;
      ?>
      <tr>

        <td><img style="width:50px;height:50px;border-radius:50%" 
            src="sp/upload/<?php echo $i['anh']?>"></td>
        <td><?php echo $i['slg']?></td>
        <td><?php echo $i['slb']?></td>
        <td><?php echo $i['slg']- $i['slb']?></td>
        
        
      </tr>
      <?php
        }
      ?>
     
    </table>
  <h4 class="text-center">Tổng hàng tồn kho: <b><?php echo $totalInventory?></b></h4>
  <!-- <h4 class="text-center">Tổng doanh thu: <b><?php //echo $totalIncome?> VND</b></h4> -->
  </div>
 
   
    <script src="../../../script.js"></script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>

 