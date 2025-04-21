<?php
    include('PHPMailer/src/Exception.php');
    include('PHPMailer/src/OAuth.php');
    include('PHPMailer/src/POP3.php');
    include('PHPMailer/src/PHPMailer.php');
    include('PHPMailer/src/SMTP.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="lienhe.css">
</head>
<style>
  
  input[type="tel"],
    input[type="text"],
    input[type="email"],
    textarea {
      width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
    }
</style>
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
              <li><a href="index.php">Trang chủ</a></li>
              <li><a href="gioithieu.php">Giới thiệu</a></li>
              <!-- Mục Sản phẩm và mục con -->
              <li>
                <a href="#">Danh mục <img src="../icon/chevron.png" ></a>
                    <ul class="submenu">
                      <?php
                              while($t=mysqli_fetch_array($s)){
                      ?>
                          <li>
                            <a href="tranggiay.php?id_dm=<?php echo $t['id_dm']?>">
                              <?php echo $t['tendm']?></a>
                          </li>
                          <?php
                            }
                          ?>
                    </ul>
              </li>
              
              <li><a href="lienhe.php">Liên hệ</a></li>
              <hr>

              
              <li>
              <li><a href="../Dang_nhapuser/loginuser.php">Đăng nhập/Đăng ký</a></li>
              </li>
            <li>
            <?php 
              // xóa session login
              if (isset($_SESSION['taikhoan'])){
                  unset($_SESSION['taikhoan']); 
              }
              ?>  
            <strong><a href="../Trang_chu/index.php">Đăng xuất</a></strong></li>

                  
              
          </ul>
          <!-- Thanh menu -->
          <span class="icon">
              <!-- Thanh 3 gạch cho menu -->
              <img src="../icon/menu.png" class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
    </header>
      
    <script src="../script.js"></script>
    

    <div class="lienhe">
        <a href="index.php"><img src="../icon/arrow.png" ></a>
           <h2>CẦN HỖ TRỢ ?</h2>
           <h3>Liên hệ với chúng tôi</h3>
            <form action="lienhe.php" method="POST">
              <label for="name">Họ và tên:</label>
             <input type="text" id="name" name="name" required>
        
             <label for="email">Email:</label>
              <input type="email" id="email" name="email" required>

              <label for="phone">Số điện thoại:</label>
              <input type="tel" id="phone" name="phone" required>

              <label for="subject">Tiêu đề:</label>
              <input type="text" id="subject" name="subject" required>
        
              <label for="message">Nội dung:</label>
             <textarea id="message" name="message" rows="4" cols="50" required></textarea>
        
              <input type="submit" name ="send"value="Gửi">
        </form>
          </div>
          <?php
    // kết nối đến database
    
    $mail = new PHPMailer(true);
    try{
        if(isset($_POST['send'])){
          $in = $get_data -> insert_contact($_POST['name'],
                $_POST['email'],$_POST['phone'],
                $_POST['subject'],$_POST['message']);
            
        
        $mail->SMTPDebug = 0;
        $mail->isSMTP();    //set de su dung SMTP
        $mail->Host = 'smtp.gmail.com'; //may chu gui mail
        $mail->SMTPAuth = true;
        $mail->Username ='suculashop@gmail.com';
        $mail->Password ='ziijojhtcknharxq';
        $mail->SMTPSecure='tls';
        $mail->Port = 587;
        $mail->Charset ='UTF-8';
        $mail->setFrom('suculashop@gmail.com');
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body = 'Cảm ơn bạn đã quan tâm đến shop. 
        Chúng tôi sẽ phản hồi trong thời gian sớm nhất!!';
        $mail->send();
        
        echo "<script>alert('Đã gửi thành công.')</script>";
        }
    }catch(Exception $e){
            echo 'Email không gửi được!!.',$mail->ErrorInfo;

    } 
     
    ?>
          <footer>
            <div class="container_footer1">
              <div class="text_footer1">
                <p class="contact_info"><strong>Liên hệ:</strong> 05577847378<br></br>
                  <strong>Địa chỉ:</strong> Tàng 4, UKB, Bắc Ninh<br><br>
                  <strong>Phone:</strong> 190 015 08<br><br>
                  <strong>Email:</strong> suculashop@gmail.com<br></p>
                
              </div>
            </div>
          
            <div class="container_footer2">
          
              <strong>@  </strong> Bản quyền thuộc về Sucula
            </div>
            </div>
          </footer>

</body>
</html>