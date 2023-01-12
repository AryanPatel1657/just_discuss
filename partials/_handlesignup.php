<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $name=$_POST['username'];
    $pass=$_POST['signuppassword'];
    $cpass=$_POST['signupcpassword'];

   $exitsql="SELECT * from `users` where user_email ='$user_email'";
   $result=mysqli_query($conn,$exitsql);
   $numRows= mysqli_num_rows($result);
   if($numRows>0){
    $showError ="Email is alreday in use";
   }
   else {
    if($pass== $cpass){
        $hash= password_hash($pass, PASSWORD_DEFAULT);
        $sql="INSERT INTO `users` ( `user_email`,`user_name`, `user_pass`, `timestamp`) VALUES ( '$user_email','$name','$hash', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        if($result){
            $showAlert=true;
            header("Location:/forum/index.php?signupsuccess=true");
            exit();
        }
    }
    else{
    $showError ="password do not match";        
    
}
}
header("Location:/forum/index.php?signupsuccess=false&error=$showError");
}
?>
