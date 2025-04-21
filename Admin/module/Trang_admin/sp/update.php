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
              <img src="../../../icon/menu.png" class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
    </header>
     <?php
        //kết nối với file control.php
            include('control.php');
            //lấy id tư đường dẫn sản phẩm để update
            $id = $_GET['up'];
            $conn=connect();
            // lấy thông tin sản phẩm theo id
                $sql="SELECT * FROM  sanpham  WHERE id_sp=$id";
                $result=mysqli_query($conn,$sql);
                $i=0;
                while($i=mysqli_fetch_array($result)){
        ?>
    <!-- tạo form để hiển thị sản phẩm cần update -->
        <table border="1" aligh="center" style="margin: 0 auto; margin-top:100px"> 
            <caption><center>CẬP NHẬT SẢN PHẨM</center></caption>
            <form method="POST" enctype="multipart/form-data">
            <tr>
                <td>Ảnh </td>
                <td>
                    <input type="file" name="anh" >
                    <img style="width:50px;height:50px;border-radius:50%" 
                    src="upload/<?php echo $i['anh']?>">
                </td>
            </tr>
            <tr>
                <td>Mã sản phẩm </td>
                <td><input type="text" name="msp" value="<?php echo $i['masp'];?>"></td>
            </tr>
            <tr>
                <td>Tên sản phẩm </td>
                <td><input type="text" name="tsp" value="<?php echo $i['tensp'];?>"></td>
            </tr>
            <tr>
                <td>Danh mục</td>
                <td>
                    <select name="dm" >
                        <?php
                            $sql_dm="SELECT * FROM danhmuc";
                            $q=mysqli_query( $conn, $sql_dm);
                            while($k=mysqli_fetch_array($q)){
                                //so sánh madm với vòng lặp. 
                                //nếu danhmuc.madm=sanpham.madm
                                //->chọn. k thì chạy bình thường
                                if($k['id_dm']==$k_1['id_dm']){
                        ?>
                                <option selected value="<?php  echo $k['id_dm'] ?>">
                                    <?php  echo $k['tendm'] ?></option>
                            <?php
                                }
                                    else{
                            ?>
                                    <option value="<?php  echo $k['id_dm'] ?>">
                                    <?php  echo $k['tendm'] ?></option>
                                <?php
                                    }
                                
                                ?>
                            <?php
                            }
                            ?>
                        </select>
                </td>
            </tr>
            <tr>
                <td>Size</td>
                <td>
                    <select name="size" >
                        <option value="<?php echo $i['size'];?>">
                                        <?php echo $i['size'];?>
                        </option>
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
                <td><textarea name="tt" cols="10" rows="5" >
                    <?php echo $i['tt'];?>
                </textarea></td>
                <!-- textarea: k có value -->
            </tr>
            <tr>
                <td>Nội dung </td>
                <td><textarea name="nd" cols="15" rows="10" >
                    <?php echo $i['nd'];?>
                </textarea></td>
            </tr>
            <tr>
                <td>Số lượng </td>
                <td><input type="text" name="slg" value="<?php echo $i['slg'];?>"></td>
            </tr>
            <tr>
                <td>Giá bán </td>
                <td><input type="text" name="gb" value="<?php echo $i['gb'];?>"></td>
            </tr>
            
            <tr>
                <td>Giá nhập</td>
                <td><input type="text" name="gn" value="<?php echo $i['gn'];?>"></td>
            </tr>
            <tr>
                <td>Nhà cung cấp</td>
                <td>
                <input type="text" name="ncc" value="<?php echo $i['ncc'];?>">
                </td>
            </tr>
            <tr>
                <td colspan=2>                
                    <button type="submit" name="sua" >UPDATE</button>  
                </td>
            </tr>

        <?php
         }
        ?>   
       
        </form>
        </table>
        <?php
             //kiểm tra xem có nhấn nút sửa hay không
            if(isset($_POST['sua'])){ 
                $anh = $_FILES['anh'];
                move_uploaded_file($anh['tmp_name'], 
                'upload/' . $anh['name']);
                //lấy dữ liệu từ form
                $a=$anh['name'];$size=$_POST['size'];
                $id=$_GET['up']; $ten=$_POST['tsp'];
                $ma= $_POST['msp']; $tt=$_POST['tt'];
                $nd= $_POST['nd']; $slg= $_POST['slg'];
                $gb= $_POST['gb']; $gn= $_POST['gn'];
                $dm=$_POST['dm']; $ncc= $_POST['ncc'];

                //kiểm tra xem 'anh' có rỗng k.
                //nếu có thì giữ nguyên ảnh cũ
                //ngược lại update tất cả thông tin mới
                if (empty($a)) { 
                    foreach($result as $i){
                         $a=  $i['anh'];
                     }
                    
                    //update tất cả thông tin sản phẩm
                    $sql_update="UPDATE sanpham SET anh='$a',masp='$ma',
                    tensp='$ten',id_dm='$dm', size='$size',
                    tt='$tt',nd='$nd',slg='$slg',gb='$gb',gn='$gn',
                    ncc='$ncc' WHERE id_sp=$id";

                    
                }
                else
                { 
                    //xóa ảnh cũ trong folder upload
                    $sql1= "SELECT * FROM sanpham WHERE  id_sp = $id LIMIT 1";
                    $p=mysqli_query($conn,$sql1);
                    while($row = mysqli_fetch_array($p)){
                        unlink('upload/'.$row['anh']);
                    }
                    //update ảnh mới và tất cả thông tin sản phẩm
                    $sql_update="UPDATE sanpham SET anh='$a',masp='$ma',
                    tensp='$ten',id_dm='$dm',size='$size',
                    tt='$tt',nd='$nd',slg='$slg',gb='$gb',gn='$gn',
                    ncc='$ncc' WHERE id_sp=$id";
                }
                //thực thi câu lệnh update
                if (mysqli_query($conn,$sql_update))                           
                    echo "<script>alert('Sửa thành công!');
                    window.location='select.php';</script>";
                else 
                    echo "<script>alert('KHÔNG THỰC THI ĐƯỢC!!')</script>";
            }
        ?>
</body>
</html>
