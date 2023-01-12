<?php
  $showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
        $email=$_POST['loginEmail'];
        $pass=$_POST['loginpassword'];

        $sql="SELECT * FROM `users` WHERE user_email='$email'";
   $result=mysqli_query($conn,$sql);
        $numRows= mysqli_num_rows($result);
        if($numRows==1){
        $row = mysqli_fetch_assoc($result);
          $name=$row['user_name'];
            if(password_verify($pass,$row['user_pass']))
            {
            session_start();
            $_SESSION['loggedin']= true;
            $_SESSION['useremail']= $email;
            $_SESSION['username']=$name;
            // echo"logged in".$email;
            header("location:/forum/index.php");
            }
            else{
                $showError ="password or email do not match";    
            header("Location:/forum/index.php?loginsuccess=false&error=$showError");
            }
        }

} ?>