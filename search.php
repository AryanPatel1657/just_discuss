<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>just forum</title>
    <style>
        .container{
            min-height:89vh;
        }
        .jb{
            border-radius:10px;
            background: black;
            max-height:500px;
            color:white;

        }
    </style>
</head>

<body>
    <?php include'partials/_dbconnect.php';?>
    <?php include'partials/_header.php';?>

  
   <!-- search results start here -->
   <div class="container my-3">
       <h1>Search results for <em>"<?php echo $_GET['search']?>"</em></h1>
       <?php
       $querry=$_GET['search'];
       $noresult=true;
        $sql ="SELECT * FROM `threds`where MATCH(thred_title,thred_desc) against('$querry')";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)) 
                {  $noresult=false;
                    $title=$row['thred_title']; 
                    $desc=$row['thred_desc'];
                    $thred_id=$row['thred_id'];
                    $url="thred.php?thredid=".$thred_id;
                   echo '<div class="results">
                    <h3><a href='.$url.' class="text-dark">'.$title.'</a></h3>
                    <p>'.$desc.'</p>
                </div>';
                }
                if($noresult){
                    echo'<div class="jumbotron jumbotron-fluid ">
                    <div class=" p-5 jb d-block">
                      <b><h2 class="display-4">No results Found</h2></b>
                      Suggestions:
                      <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                        <li>Try fewer keywords.</li>
                        </ul>
                    </div>
                  </div>';
                }
?>

   
   </div>


    <div class="my-3"></div>
    <?php include'partials/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>