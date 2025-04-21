
<!--  
xử lý dữ liệu
thêm các hàm: kết nối đến CSDL(mysql),
thêm, sửa, xóa, hiển thị sản phẩm.
-->

<?php
        //hàm để kết nối đến database
         function connect(){
            //thiết lập một kết nối đến CSDL sử dụng mysqli_connect()
            //nếu connect lỗi -> thông báo lỗi và dừng chương trình
             $conn = mysqli_connect('localhost','root','','admin') 
             or die('Không thể kết nối!');
            //  thiết lập các ký tự là 'utf8': nhập được tiếng việt
             mysqli_set_charset($conn, 'utf8');
             return $conn;
         }
         //gọi đến hàm connect() đẻ kết nối đến CSDL
        $conn=connect(); 

         //xử lý dữ liệu
         // thêm sản phẩm
        if(isset($_POST['them'])){
                //chuyển ảnh tới upload folder
            move_uploaded_file($_FILES['anh']['tmp_name'],
            'upload/'.$_FILES['anh']['name']);

            //lấy dữ liệu từ form
            $ma=$_POST['msp'];$ten=$_POST['tsp'];
            $a=$_FILES['anh']['name'];$tt=$_POST['tt'];
            $size=$_POST['size'];$nd= $_POST['nd'];
            $slg= $_POST['slg'];$gb= $_POST['gb'];
            $gn= $_POST['gn'];$ncc= $_POST['ncc'];
            $dm=$_POST['dm'];

            //kiểm tra xem có dẫ nhập 2 trường mã sản phẩm 
            //và tên sản phẩm chưa
            if($ma == "" || $ten == "")
                echo "<script>alert('BẠN CHƯA NHẬP ĐỦ THÔNG TIN!');
                window.location='insert.php';</script>";	
            else{
                 //thêm sản phẩm vào CSDL
                $sql="INSERT INTO sanpham(anh,masp,tensp,id_dm,
                size,tt,nd,slg,gb,gn,ncc)
                VALUES('$a','$ma','$ten','$dm','$size','$tt','$nd',
                '$slg','$gb','$gn','$ncc')";
                //thực thi câu lệnh INSERT INTO
                if(mysqli_query($conn,$sql))
                    echo "<script>alert('Thêm mới thành công!');
                        window.location='insert.php';</script>";
                else 
                    echo "<script>alert('Không thực thi được!!)</script>";
            }
        }
        //Xóa sản phẩm 
        //kiểm tra xem có nhán vào nút xóa 
        //và id_sp có là số không
        elseif(isset($_GET['del']) && is_numeric($_GET['del'])){
            $id = $_GET['del'];
             //lấy ra tất cả thông tin của sản phẩm theo id_sp
            $sql= "SELECT * FROM sanpham WHERE  id_sp = $id LIMIT 1";
            $result=mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                //xóa file cũ trong folder upload
                unlink('upload/'.$row['anh']);
            }
            $sql1="DELETE FROM sanpham WHERE id_sp=$id ";
            
            //thực thi câu lệnh xóa sản phẩm theo id_sp
            if(mysqli_query($conn,$sql1))
                echo "<script>alert('Xóa thành công!');
                window.location='select.php';</script>";
            else
                echo "<script>alert('Không thực thi được!!)</script>";
        }
        else {
            echo '';
        }

    
?>
