<!-- Xử lý trang thanh toán -->
<?php
// kiểm tra form đã submit chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //lấy dữ liệu từ form
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $note = $_POST['note'];

    // kết nối db
    $conn = mysqli_connect('localhost', 'root', '', 'admin') 
    or die('Could not connect to database!');
    mysqli_set_charset($conn, 'utf8');

    // thêm record vào bảng thanh_toan
    $sql_select_gio_hang = "SELECT * FROM gio_hang WHERE status = 'pending'";
    $result_select_gio_hang = mysqli_query($conn, $sql_select_gio_hang);

    $sql_insert_thanh_toan = "INSERT INTO thanh_toan 
    (name, email,phone, address, type,note) 
    VALUES ('$name', '$email', '$phone', '$address', '$type','$note')";
    mysqli_query($conn, $sql_insert_thanh_toan);


    // khơi tạo một mảng rỗng để lưu cart
    $cart_items = array();

    //Lặp lại từng bản ghi trong bảng gio_hang và thêm vào mảng cart_items
    while ($row = mysqli_fetch_assoc($result_select_gio_hang)) {
        $cart_items[] = array(
            'cart_id' => $row['id_giohang']
        );
    }

    // biến đổi thành dạng json
    $gio_hang_id = json_encode($cart_items);

    // thêm gio_hang_id vào bảng thanh_toan
    $sql_update_thanh_toan = "UPDATE thanh_toan 
    SET id_giohang = '$gio_hang_id' WHERE id = LAST_INSERT_ID()";
    mysqli_query($conn, $sql_update_thanh_toan);

    // cập nhật lại giỏ hàng
    $sql_update_gio_hang = "UPDATE gio_hang SET status = 'da_thanh_toan'";
    mysqli_query($conn, $sql_update_gio_hang);

    // Close the database connection
    mysqli_close($conn);

    // chuyển hướng sau khi thanh toán thành công
    header("Location:thank.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>thanh toán</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../San_pham/style.css">
        <link rel="stylesheet" href="giay2.css">
        <script src="../script.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
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
              <li><a href="../User/index.php">Trang chủ</a></li>
              <li><a href="../User/gioithieu.php">Giới thiệu</a></li>
              <!-- Mục Sản phẩm và mục con -->
              <li>
                  <a href="#">Danh mục <img src="../icon/chevron.png" ></a>
                  <ul class="submenu">
                  <?php
                          while($t=mysqli_fetch_array($s)){
                    ?>
                      <li>
                      <a href="../San_pham/tranggiay.php?id_dm=<?php echo $row['id_dm']?>">
                          <?php echo $t['tendm']?></a>
                      </li>
                      <?php
                        }
                      ?>
                  </ul>
              </li>
              
              <li><a href="../User/khuyenmai.php">Khuyến mại</a></li>
              <li><a href="../User/lienhe.php">Liên hệ</a></li>
              <hr>
              <li><a href="../User/lichsu.php">Lịch sử mua hàng</a></li>
              <li><strong><a href="../User/info.php">Tài khoản</a></strong></li>
                  
              
          </ul>
          <!-- Thanh menu -->
          <span class="icon">
              <!-- Thanh 3 gạch cho menu -->
              <img src="../icon/menu.png" class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
</header>

    <button class="cart-button">
      <a href="gio_hang.php">
        <img class="cart-icon" src="../icon/shopping-cart.png" alt="Giỏ hàng"></a>
      <span class="cart-count"></span>
      
    </button>
        <h1 class="text-center">Thanh toán</h1>
        <div class="container" style="margin-top:50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-5">
                    <form action="thanh_toan.php" method="post">
                            <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input type="text" class="form-control" name="name" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                        
                        <div class="form-group">
                                <select name="type" id="input" class="form-control" required="required">
                                    <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                                    
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ghi chú</label>
                            <textarea name="note" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group" style="position:relative;margin-top:50px;">
                            <button type="submit" class="btn btn-primary">THANH TOÁN</button>
                        </div>
                    </form>
                    </div>
                    <div class="col-md-6">
                        
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Thành tiền</th>
                                <th>Kích thước</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           // Kết nối với cơ sở dữ liệu
                            $conn = mysqli_connect('localhost', 'root', '', 'admin') 
                            or die('Could not connect to database!');
                            mysqli_set_charset($conn, 'utf8');

                            // bien tổng
                            $total_price = 0;

                            // Truy vấn SQL để chọn các mục từ gio_hang cùng với thông tin sản phẩm từ sanpham
                            $sql = "SELECT gio_hang.*, sanpham.anh, sanpham.tensp, gio_hang.size 
                                    FROM gio_hang 
                                    INNER JOIN sanpham ON gio_hang.id_sp = sanpham.id_sp
                                    WHERE gio_hang.status = 'pending';";
                            $result = mysqli_query($conn, $sql);

                           // Kiểm tra xem trong giỏ hàng có sản phẩm nào không
                            if (mysqli_num_rows($result) > 0) {
                                // Lặp qua từng hàng và hiển thị các mục trong giỏ hàng 
                                //cùng với thông tin sản phẩm
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Tính tổng giá cho từng mặt hàng và cộng vào biến tổng giá
                                    $price_str = $row['price'];
                                    $price_str = str_replace(array(' ', 'VND'), '', $price_str);
                                    $price_numeric = intval($price_str);
                                    $total_price += $price_numeric * $row['amount'];
                                    ?>
                                    <tr>
                                        <td><img src="../imagegiay/<?php echo $row['anh']; ?>" 
                                        style="width: 100px;"></td>
                                        <td><?php echo $row['tensp']; ?></td>
                                        <td>
                                            <?php
                                            // Hiển thị tổng giá của mặt hàng hiện tại
                                            $total_item_price = $price_numeric * $row['amount'];
                                            echo number_format($total_item_price, 0, ',', ' ') . ' VND';
                                            ?>
                                        </td>
                                        <td><?php echo $row['size']; ?></td>
                                        <td><?php echo $row['amount']; ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                              // Không tìm thấy sản phẩm nào trong giỏ hàng
                                ?>
                                <tr>
                                    <td colspan="5">Không có sản phẩm nào trong giỏ hàng.</td>
                                </tr>
                                <?php
                            }

                            // Close  database 
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                <div class="flex">
                    <legend>Tổng tiền: <?php echo number_format($total_price, 0, ',', ' '); ?> VND</legend>
                </div>
            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <!-- jQuery Query là một thư viện JavaScript mã nguồn mở giúp đơn giản hóa 
        việc phát triển các ứng dụng web. Nó cung cấp các phương thức để thao tác với DOM, xử lý sự kiện, 
        tạo hiệu ứng động, gọi Ajax để gửi và nhận dữ liệu từ máy chủ, thao tác với CSS và nhiều hơn nữa.  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!--  Bootstrap JavaScript là một thư viện mã nguồn mở, đa nền tảng cho phép 
        bạn thêm các chức năng khác nhau vào trang web của mình. Nó được xây dựng trên jQuery 
        và cung cấp một loạt các tiện ích -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
