<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><b>JUST DISCUSS</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

          $sql="SELECT * FROM `catagories` LIMIT 4";
          $result=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_assoc($result)){
           echo'<li><a class="dropdown-item" href="/FORUM/threds.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
          }
           
        echo  '</ul>
        </li>
      </ul>';
      echo'<form class="d-flex" action="search.php" method="get">
      <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      </form>';
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
      {echo'
        <p class="text-light my-0 mx-2">welcome '.$_SESSION['username'].'</p>
        <div class="d-flex"> 
        <a href="partials/_logout.php" class="btn btn-outline-success" >log out</a>
        </div>';
      }
      else{
        echo'
        <div class="mx-2"> 
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginmodal">login</button>
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupmodal" >sign up</button>
        </div>';
      }
      echo'<div>               
  </div>
</nav>';

include'partials/_loginmodal.php';
include'partials/_signupmodal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']== "true"){
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success</strong> you can now login
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']== "false"){
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Wrong cradentials</strong> please enter coerrect password
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>