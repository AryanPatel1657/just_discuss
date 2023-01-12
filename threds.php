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
            .card1{
                text-decoration:none;
                color: black;
            }
            
        </style>
    <title>just forum</title>
</head>

<body>
    <?php include'partials/_dbconnect.php';?>
    <?php include'partials/_header.php';?>
    <?php 
    $id=$_GET['catid'];
     $sql = "SELECT * FROM `catagories` WHERE category_id=$id";
     $result = mysqli_query($conn,$sql);
     while($row = mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['cat_discription'];
     }
    ?>
    <?php
    $showalert= false;
        $method=$_SERVER['REQUEST_METHOD'];
        if($method =='POST'){
            $th_title=$_POST['title'];
            $th_title=str_replace("<","&lt;",$th_title);
            $th_title=str_replace(">","&gt;",$th_title);
            $th_desc=$_POST['desc'];
            $th_desc=str_replace("<","&lt;",$th_desc);
            $th_desc=str_replace(">","&gt;",$th_desc);
            $name=$_SESSION['username'];
            $sql = "INSERT INTO `threds` ( `thred_title`, `thred_desc`, `thred_cat_id`, `thred_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$name', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            $showalert=true;
        }
        if($showalert){
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> your question is added in thred list.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    ?>

       <div class="container my-5">
         <div class="card bg-dark text-light">
                <div class="card-body">
                    <h1 class="card-title">welcome to <?php echo $catname ?> </h1>
                    <p class="card-text"><?php echo $catdesc ?></p>
                    <a href="#" class="btn btn-primary">learn more</a>
                </div>
            </div>
        </div>
           <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
           {
               echo'  <div class="container">
               <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
               <h1>Start a Discussion</h1>           
               <div class="form-group">
               <label for="title">Problem Title</label>
               <input type="text" class="form-control" id="title" name="title" >
               </div>
               <div class="form-group">
               <label for="desc">Ellobrate your concern</label>
               <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
               </div>
               <button type="submit" class="btn btn-primary my-3">Submit</button>
               </form>
               </div>';
            }
            else{
                echo'<div class="container">
                <h2>please Login For Post New Questions</h2>
            </div>';
            }
            ?>
            
         <div class="container" style="min-height:500px;">
            <h1 class="py-2" >Question</h1>

            <?php  
                $sql ="SELECT * FROM `threds` WHERE thred_cat_id=$id";
                $result = mysqli_query($conn,$sql);
                $noresult=true;
                while($row = mysqli_fetch_assoc($result)) 
                {  $noresult=false;
                     $id=$row['thred_id'];
                    $title=$row['thred_title'];
                    $desc=$row['thred_desc'];
                    $name=$row['thred_user_id'];
                        echo '<a class="card1" href="thred.php?thredid='.$id.'"> 
                        <div class="media my-3 card d-inline-flex">
                        <img src="img/user.png" width="54px" class="mr-3 " >'.$name.'
                        <h5 class="mt-0 ">'.$title.'</h5>'.$desc.'
                        </div> 
                        </a>';
                }
                if($noresult){
                    echo'<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h1 class="display-4">No Questions Found</h1>
                      <p class="lead">Be the first person to ask question</p>
                    </div>
                  </div>';
                }
                ?>


            <!-- <div class="media my-3" style="max-width:500px;"> 
                <img src="img/user.png" width="50px" class="mr-3" alt="">
              <div class="media-body">
                <h5 class="mt-0">unable tu downlode pyoudio</h5>
                h d eofyhfuoehoufwe shfoe ofhewfhew sdhpidhpi  houvs vph piww{v v v;wkjv/v ;h}
              </div>
            </div> -->

           
        </div>

    <?php include'partials/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>