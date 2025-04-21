

<!-- quản lý đơn hàng -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
              <li><a href="tonkho.php">Quản lý Tồn kho</a></li>
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
    <?php
    // gọi đến file control.php để thiết lập kết nối đến CSDL
    include('sp/control.php');
    
    // kết nối đến database
    $conn = connect();
    
    // lấy các bản ghi từ bảng thanh_toan
    $sql = "SELECT name, phone, address, created_at, 
        id_giohang FROM thanh_toan";
    $result = mysqli_query($conn, $sql);

    // kiểm tra xem có bản ghi nào trong bảng thanh_toan không
    if ($result) {
        echo '<div class="text_doanhthu">QUẢN LÝ ĐƠN HÀNG </div>
        <hr style="color: aquamarine;margin-top: 6px;">';
        echo '<div class="container_table">';
        echo '<table>';
        echo '<tr>';
        echo '<th>Tên khách hàng</th>';
        echo '<th>Số điện thoại</th>';
        echo '<th>Địa chỉ</th>';
        echo '<th>Thời gian đặt hàng</th>';
        echo '<th>Số lượng</th>';
        echo '<th>Tình trạng</th>';
        echo '</tr>';

        // lấy dữ liệu từ bảng thanh_toan
        while ($order = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $order['name'] . '</td>';
            echo '<td>' . $order['phone'] . '</td>';
            echo '<td>' . $order['address'] . '</td>';
            echo '<td>' . $order['created_at'] . '</td>';

            // Giải mã dữ liệu được mã hóa JSON trong trường id_giohang
            $cartIds = json_decode($order['id_giohang']);

            // Khởi tạo biến tổng số lượng
            $totalQuantity = 0;

            // Lặp  từng đối tượng giỏ hàng
            foreach ($cartIds as $cart) {
                // Trích xuất giá trị cart_id từ mỗi đối tượng
                $cartId = $cart->cart_id;

                // Truy vấn bảng gio_hang để truy xuất các mục khớp với cart_id
                $query = "SELECT SUM(amount) AS total_quantity, gio_hang.status 
                        FROM gio_hang WHERE id_giohang = $cartId  ";
                $gioHangResult = mysqli_query($conn, $query);

                // Kiểm tra xem truy vấn có thành công không
                if ($gioHangResult) {
                    // gán cho biến $gioHang mảng giá trị của kết quả truy vấn
                    $gioHang = mysqli_fetch_assoc($gioHangResult);

                    // tính tổng số lượng
                    $totalQuantity += $gioHang['total_quantity'];
                } else {
                    // đưa ra thông báo lỗi nếu không thực thi được truy vấn
                    echo "Error in querying gio_hang table: " . mysqli_error($conn);
                }
            }

            // Xuất ra tổng số lượng mặt hàng mà khách hàng đã mua 
            //trong đơn đặt hàng
            echo '<td>' . $totalQuantity . '</td>';
            echo '<td>' . $gioHang['status'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>'; // đóng container_table
    } else {
        // In thông báo lỗi nếu truy vấn truy xuất đơn hàng không thành công
        echo "Error in querying thanh_toan table: " . mysqli_error($conn);
    }

    // đóng kết nối database
    mysqli_close($conn);
?>




    <script src="../../../script.js"></script>
</body>
</html>

 