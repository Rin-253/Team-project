<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="loginuser.css">
</head>
<style>


/* Thêm các quy tắc CSS khác nếu cần */
</style>
<body>

    
    <div class="bangdk">
    <h3 >Đổi mật khẩu</h3>
            <form id="signup-form" method="POST" action="doimatkhau.php">
                <br><br>
                <div class="form_group">
                    Số điện thoại
                    <input type="text"  name="sdt" placeholder="0123456789" required />
                </div>
               
                <div class="form-group">
                    Mật khẩu cũ
                    <input type="password"  name="passcu" placeholder="*********" required />
                </div><br><br>
                <div class="form-group">
                    Mật khẩu mới
                    <input type="password"  name="passmoi" placeholder="*********" required />
                </div><br><br>
                <a style="text-decoration:none"href="loginuser.php">Đăng nhập</a><br>
                <br><div class="form-group">
                    <button type="submit" name="dmk"style="  width: 100%;
                    padding: 10px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;">Đổi mật khẩu</button>
                </div>
            </form>
            <?php
            // session_start() sẽ đăng ký phiên làm việc của người dùng trên Server, 
            //từ đó Server sẽ tạo ra một ID riêng không trùng lặp 
            //để nhận diện cho client hiện tại.

            include('control.php');
              if(isset($_POST['dmk'])){
                //Lấy dữ liệu nhập vào
                $tk= $_POST['sdt'];
                //mã hóa password
                $cu=md5($_POST['passcu']);
                $moi=md5($_POST['passmoi']);
                //Kiểm tra tên đăng nhập có tồn tại không
                $s ="SELECT * FROM userdk WHERE sdt='$tk' AND
                    pass='$cu'";
                    // thực thi câu lệnh
                $query = mysqli_query($conn, $s);
                // Nếu kết quả trả về lớn hơn 0 (dữ liệu có tồn tại)
                if (mysqli_num_rows($query) > 0) {
                    $sql_update="UPDATE userdk SET  pass='$moi'";
                    $t=mysqli_query($conn,$sql_update);
                    echo "<br> Mật khẩu đã dược thay đổi";
                    
                }else{
                    echo "Tên đăng nhập hoặc mật khẩu cũ không đúng. 
                    Vui lòng kiểm tra lại.";
                    exit;
                }
            }
              
            ?>
  
     
      </div>
   

    <footer>
      <div class="container_footer1">
        <div class="text_footer1">
          <p class="contact_info"><strong>Liên hệ:</strong> 05577847378<br></br>
            <strong>Địa chỉ:</strong> Tàng 4, UKB, Bắc Ninh<br><br>
            <strong>Phone:</strong> 190 015 08<br><br>
            <strong>Email:</strong> sucula@gmail.com<br></p>
          
        </div>
      </div>
    
      <div class="container_footer2">
    
        <strong>@  </strong> Bản quyền thuộc về Sucula
      </div>
      
    </footer>

    <script src="../script.js"></script>
</body>
</html>
