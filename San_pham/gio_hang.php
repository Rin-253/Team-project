
<!-- hiển thị sản phẩm trong giỏ hàng -->

<!DOCTYPE html>
<html lang="">
<head>
    <!-- Meta tags and title -->
    <!-- Bootstrap CSS -->
    <title>giỏ hàng</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="giay2.css">
    <script src="../script.js"></script>
</head>
<body>
<?php 
      include('../Admin/module/Trang_admin/dm/control.php');
      $get_data =new data_dm();
      $s = $get_data->select_dm();
      ?>
<header>
        <!-- Logo -->
        <a href="#" class="logo">logo</a>
        <div class="group">
          <!-- Navigation menu -->
          <ul class="navigation">
              <li><a href="../User/indexuser.php">Trang chủ</a></li>
              <li><a href="../User/gioithieu.php">Giới thiệu</a></li>
              <!-- Mục Sản phẩm và mục con -->
              <li>
                  <a href="#">Danh mục <img src="../icon/chevron.png" ></a>
                  <ul class="submenu">
                  <?php
                          while($t=mysqli_fetch_array($s)){
                    ?>
                      <li>
                      <a href="../User/tranggiay.php?id_dm=<?php echo $t['id_dm']?>">
                          <?php echo $t['tendm']?></a>
                      </li>
                      <?php
                        }
                      ?>
                  </ul>
              </li>
              
              
              <li><a href="../User/lienhe.php">Liên hệ</a></li>
              <hr>
              <li>
              <?php
              session_start();
                  // hiển thị tên dăng nhập 
                  if (!empty($_SESSION['taikhoan'])) {
                    // Nếu người dùng đã đăng nhập, hiển thị tên người dùng và nút "Thoát"
                      echo "<span class='nav-link'>Hello: " . $_SESSION['taikhoan'];
                  } else {
                  // Nếu chưa đăng nhập, hiển thị nút "Đăng nhập"
                    echo "<a class='nav-link' href='../Dang_nhapuser/loginuser.php'><b>ĐĂNG NHẬP</b></a>";
                  }
                ?>  
              </li>
                  
              
          </ul>
          <!-- Thanh menu -->
          <span class="icon">
              <!-- Thanh 3 gạch cho menu -->
              <img src="../icon/menu.png" class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
</header>

    <button class="cart-button">
      <a href="gio_hang.php"><img class="cart-icon"
       src="../icon/shopping-cart.png" alt="Giỏ hàng"></a>
      <span class="cart-count"></span>
      
    </button>
    <h1 class="text-center">Giỏ hàng của bạn</h1>
    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="col-md-12">
            <a href="../User/indexuser.php" class="btn btn-info">
                Quay lại trang sản phẩm</a>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Thành tiền</th>
                        <th>Kích thước</th>
                        <th>Số lượng</th>
                        <th>Hành động</th>
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
                    $sql = "SELECT gio_hang.*, sanpham.anh, sanpham.tensp, gio_hang.size 
                            FROM gio_hang 
                            INNER JOIN sanpham ON gio_hang.id_sp = sanpham.id_sp
                            WHERE gio_hang.status = 'pending';";
                    $result = mysqli_query($conn, $sql);

                  // Kiểm tra xem trong giỏ hàng có sản phẩm nào không
                    if (mysqli_num_rows($result) > 0) {
                     // Lặp qua từng hàng và hiển thị các mục trong giỏ hàng cùng với thông tin sản phẩm
                        while ($row = mysqli_fetch_assoc($result)) {
                            //// Tính tổng giá cho từng mặt hàng và cộng vào biến tổng giá
                            $price_str = $row['price'];
                            $price_str = str_replace(array(' ', 'VND'), '', $price_str);
                            $price_numeric = intval($price_str);
                            $total_price += $price_numeric * $row['amount'];
                            ?>
                            <tr>
                                <td><img src="../imagegiay/<?php echo $row['anh']; ?>" style="width: 100px;"></td>
                                <td><?php echo $row['tensp']; ?></td>
                                <td>
                                    <?php
                                   // Hiển thị tổng giá của mặt hàng hiện tại
                                    $total_item_price = $price_numeric * $row['amount'];
                                    echo number_format($total_item_price, 0, ',', ' ') . ' VND';
                                    ?>
                                </td>
                                <td>
                                    <?php echo $row['size']; ?>
                                    <form action="cap_nhat_size.php" method="post">
                                        <label for="">Sửa kích thước</label>
                                        <select name="size" id="input" class="form-control" required="required">
                                            <option value="36">36</option>
                                            <option value="37">37</option>
                                            <option value="38">38</option>
                                            <option value="39">39</option>
                                            <option value="40">40</option>
                                        </select>
                                        <input type="hidden" name="cart_id" value="<?php echo $row['id_giohang'] ?>">
                                        <button type="submit" class="btn btn-primary" style="position:relative;margin-top:50px;">Lưu</button>
                                        
                                    </form>
                                </td>
                                <td>
                                    <?php echo $row['amount']; ?>
                                    <form action="cap_nhat_so-luong.php" method="post">
                                        <label for="">Sửa số lượng</label>
                                        <input type="number" name="amount" class="form-control"> 
                                        <input type="hidden" name="cart_id" value="<?php echo $row['id_giohang'] ?>">
                                        <button type="submit" class="btn btn-primary" style="position:relative;margin-top:50px;">Lưu</button>
                                        
                                    </form>
                                </td>
                                <td>
                                  <form action="xoa_gio_hang.php" method="get">
                                    <input type="hidden" name="cart_id" value="<?php echo $row['id_giohang'] ?>">
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Bạn có muốn xoá không?');" 
                                    style="position:relative;margin-top:50px;">Xoá</button>
                                    </div>
                                  </form>
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
               <div class="flex">
                <legend>Tổng tiền: <?php echo number_format($total_price, 0, ',', ' '); ?> VND</legend>
               </div>
                <div class="flex">
                   <a href="xoa_gio_hang.php" class="btn btn-danger" 
                   onclick="return confirm('Bạn có muốn xoá hết không?');">xoá hết</a>
                   <a href="thanh_toan.php" class="btn btn-primary">Đặt hàng</a>
                </div>
            </div>
        </div>
     </div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
