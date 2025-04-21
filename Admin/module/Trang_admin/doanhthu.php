


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doanh thu</title>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/doanhthu.css">
    
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
              <li><a href="dm/insert.php">Danh mục</a></li>
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
              <img src="../../../icon/menu.png" 
              class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
    </header>
     
    <div class="text_doanhthu">QUẢN LÝ DOANH THU</div><hr 
        style="color: aquamarine;margin-top: 6px;">

    <div class="container_table">
    <table class="table table-bordered">
      <thead>
          <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Мã</th>
            <th>Tên sản phẩm</th>
            <th>Giá bán ( VND )</th>
            <th>Số lượng đã bán</th> 
            <!-- <th>Số lượng tồn kho</th> -->
            <th>Doanh thu</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // ket noi vs db
          $conn = mysqli_connect('localhost', 'root', '', 'admin') 
          or die('Could not connect to database!');
          mysqli_set_charset($conn, 'utf8');

          // biến tổng giá
          $total_price = 0;

        // Truy vấn SQL để chọn các mục từ gio_hang cùng với thông tin sản phẩm từ sanpham
        $sql = "SELECT gio_hang.*, 
        sanpham.anh, 
        sanpham.tensp,
        sanpham.gb,
        sanpham.masp,
        sanpham.slg, 
        gio_hang.size,
        SUM(gio_hang.amount) as ghsl
        FROM gio_hang 
        INNER JOIN sanpham ON gio_hang.id_sp = sanpham.id_sp
        WHERE gio_hang.status = 'da_thanh_toan' 
        GROUP BY gio_hang.id_sp";

          $result = mysqli_query($conn, $sql);
         $n = 1;
         $total = 0;
         $total_item_price = 0;
         $totalIncome  = 0;
        // Kiểm tra xem trong giỏ hàng có sản phẩm nào không
        if (mysqli_num_rows($result) > 0) {
          // Lặp qua từng hàng và hiển thị các mục trong giỏ hàng cùng với thông tin sản phẩm
            while ($row = mysqli_fetch_assoc($result)) {
                //// Tính tổng giá cho từng mặt hàng và cộng vào biến tổng giá
                $price_str = $row['price'];
                $price_str = str_replace(array(' ', 'VND'), '', $price_str);
                $price_numeric = intval($price_str);
                $total_price += $price_numeric * (int)$row['amount'];
                $total_item_price = $price_numeric * $row['ghsl'];
                $totalIncome +=$total_item_price;
                ?>
                <tr>
                    <td><?php echo $n++ ?></td>
                    <td><img src="../../../imagegiay/<?php echo $row['anh']; ?>" style="width: 100px;"></td>
                    <td>
                      <?php echo $row['masp'] ?>
                    </td>
                    <td>
                       <?php echo $row['tensp']; ?>
                    </td>
                    <td>
                        <?php echo $row['gb']; ?>
                    </td>
                    
                     <td><?php echo $row['ghsl'] ?></td> 
                    <!-- <td><?php //echo $row['slg'] - $row['amount'] ?></td> -->
                    <td>
                        <?php
                        // Hiển thị tổng giá của mặt hàng hiện tại
                        $total_item_price = $price_numeric * $row['ghsl'];
                        echo number_format($total_item_price, 0, ',', ' ') . ' VND';
                        ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            
            ?>
            <tr>
                <td colspan="5">Không có sản phẩm nào trong giỏ hàng.</td>
            </tr>
            <?php
        }

        
        mysqli_close($conn);
        ?>
    </tbody>
  </table>
   <h4 class="text-center">Tổng doanh thu:<b><?php echo $totalIncome?> VND</b></h4>
</div>

    <div class="container_footer2">
  
      <strong>@  </strong> Bản quyền thuộc về Sucula
    </div>
    </div>
  </footer> 
  <script src="../../../script.js"></script>
</body>
</html>