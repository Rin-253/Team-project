<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/tonkho.css">
    <link rel="stylesheet" href="../../../../Trang_chu/style.css">
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
              <img src="../../../icon/menu.png" class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
    </header>
    <!-- Thanh tìm kiếm -->
    <div class="searchBox">
          <form action="tk.php" method="POST">
            <input type="text" name="search" placeholder="Tìm kiếm..." >
            <!-- Thêm icon tìm kiếm -->
            <button name="tk">
            <img src="../../../../icon/search (1).png"  alt="Search icon">
            </button></input>  
          </form> 
      </div>
      <div class="container_table">
        <?php
                //gọi đến trang control.php
            include('control.php');
                //kết nối với CSDL
              $conn=connect();
              //khi nhập từ khóa vào ô tìm kiếm
              //gán tukhoa bằng biến $search
              if($_POST['search']){
                $search=$_POST['search'];
              }else{
                $search='';
              }
        ?>
            
            <?php
            // câu lệnh tìm kiếm theo tên sản phẩm
              $sql="SELECT * FROM sanpham 
                WHERE tensp like '%".$search."%' ";
              $p=mysqli_query($conn,$sql);
            ?>
            <!-- hiển thị kết quả tìm kiếm theo dạng bảng -->
            <div class="container_table">
            <table style="margin-top:200px">
               
            <tr>
                <th>Ảnh</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Size</th>
                <th>Tóm tắt</th>
                <th>Nội dung</th>
                <th>Số lượng</th>
                <th style="width:150px">Giá bán</th>
                <th style="width:150px">Giá nhập</th>
                <th>Nhà cung cấp</th>
                <th colspan=2 style="width:70px">Tùy chọn</th>
            </tr>
            <?php
            // nếu nhấn vào icon 'tìm kiếm' 
            //-> hiển thị kết quả sản phẩm tìm được
                if(isset($_POST['tk'])){
                while($row=mysqli_fetch_array($p)){
                ?>
          <tr>
            <td><img style="width:50px;height:50px;border-radius:50%" 
            src="upload/<?php echo $row['anh']?>"></td>
            <td><?php echo $row['masp']; ?></td>
            <td><?php echo $row['tensp'] ;?></td>
            <td><?php echo $row['id_dm'] ;?></td>
            <td><?php echo $row['size'] ;?></td>
            <td><?php echo $row['tt'] ;?></td>
            <td><?php echo $row['nd'] ;?></td>
            <td><?php echo $row['slg'] ;?></td>
            <td><?php echo $row['gb'] ;?></td>
            <td><?php echo $row['gn'] ;?></td>
            <td><?php echo $row['ncc'] ;?></td>
            <td> <a style="text-decoration:none" 
            href="update.php?up=<?php echo $row['id_sp']?>">Sửa</a></td>
            <td> <a style="text-decoration:none" 
            href="control.php?del=<?php echo $row['id_sp']?>"
              onclick="if(confirm('BẠN CÓ CHẮC MUỐN XÓA KHÔNG?'))
                return true;
                else return false;">Xóa</a></td>
          </tr>
                
            <?php
              }
            }else echo "KHÔNG TÌM THẤY SẢN PHẨM";
            ?>  
        </div>
    
</body>
</html>