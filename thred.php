<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
                        .card{
                color: black;
                border: 2px solid gray;
                border-radius: 5px;
                padding: 10px;
                
            }
            #commentfont{
                font: 2px;
            }
           
        </style>
    <title>just forum</title>
</head>

<body>
    <?php include'partials/_dbconnect.php';?>
    <?php include'partials/_header.php';?>
    <?php 

    // fetch thred data to display as heading in page as reference
    $id=$_GET['thredid'];
     $sql = "SELECT * FROM `threds` WHERE thred_id=$id";
     $result = mysqli_query($conn,$sql);
     while($row = mysqli_fetch_assoc($result)){
        $title=$row['thred_title'];
        $desc=$row['thred_desc'];
        $user=$row['thred_user_id'];
     }
    ?>



<!-- php block for push comment data into data base -->
<?php
        $method=$_SERVER['REQUEST_METHOD'];
        $showalert=false;
        if($method =='POST'){
            $comment_desc=$_POST['comment'];
            $comment=str_replace("<","&lt;",$comment);
            $comment=str_replace(">","&gt;",$comment);
            $name=$_SESSION['username'];
            $sql = "INSERT INTO `comments` ( `comment_content`, `thred_id`, `comment_by`, `comment_time`) VALUES ( '$comment_desc', '$id', '$name', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            $showalert=true;
        }  
        if($showalert){
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> your comment is added in list.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
<!-- display thred data  -->

        <div class="container my-5">
          <div class="card bg-dark text-light">
                 <div class="card-body">
                     <h1 class="card-title"><?php echo $title?> </h1>
                     <p class="card-text"><?php echo $desc ?></p>
                     <p><b>Posted By:<?php echo $user?></b></p>
                 </div>
             </div>
         </div>


        <div class="container" style="min-height:500px;">

 <!-- form tu get comments for data base -->
 <h1>Start a Discussion</h1>           
         <?php  
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
       {
         echo'<div class="container">
                <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                    <div class="form-group my-3">
                        <label for="desc"><b>Comment</b></label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>
                <button type="submit" class="btn btn-primary my-3">Post Comment</button>
                </form>
            </div>';
        }
        else{
            echo'<div class="container">
            <h2 class="my-5">please Login For Make New Comments</h2>
        </div>';
        }
            ?>
<h1 class="py-2" >Discussion</h1>
 <!-- comments displaying acording to thred id -->
            <?php  
                $sql ="SELECT * FROM `comments` WHERE thred_id=$id";
                $result = mysqli_query($conn,$sql);
                $noresult=true;
                while($row = mysqli_fetch_assoc($result)) 
                {   $id=$row['comment_id'];
                    $content=$row['comment_content'];
                    $commenter=$row['comment_by'];
                    $noresult=false;
                        echo '<div class="card mb-2 d-block">
                        <img src="img/user.png" width="54px"  alt="...">'.$commenter.'
                        <h5 class="mt-0" id="commentfont">'.$content.'</h5>
                        </div>';
                   
                }
                if($noresult){
                    echo'<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h2 class="display-4">No comments Found</h2>
                      <p class="lead">Be the first person to add comment</p>
                    </div>
                  </div>';
                }
                ?> 

           
        </div>

    <?php include'partials/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>