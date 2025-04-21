<!-- Xử lý xóa khách hàng theo id -->

<?php
        include('dm/control.php');
        $conn=connect();
        // Define the inactivity period (6 months)
        $inactivity_period = 1; // 183 days = 6 months

        // Get the current timestamp
        $current_timestamp = time();

        // Query to find inactive users
        $query = "SELECT * FROM userdk 
        WHERE status < DATE_SUB(CURDATE(), INTERVAL $inactivity_period DAY)";
        $result = $conn->query($query);
       
        $id=$_GET['del'];
        //cấp bộ nhớ cho lớp data_dm() 
        $sql= "DELETE  FROM userdk WHERE id_u=$id";
        $result= mysqli_query($conn,$sql);
        // xóa một bản ghi từ CSDL dựa trên đối số 'del' 
        //truyền vào đường dẫn

        if($result) header('location:ql_user.php');
        else 
            echo "<script>alert('KHÔNG THỰC THI ĐƯỢC')</script>";
?>