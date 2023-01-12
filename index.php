<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>just forum</title>
</head>

<body>
    <?php include'partials/_dbconnect.php';?>
    <?php include'partials/_header.php';?>
    <div class="container">
        <h1 class="text-center my-3">JUST DISCUSS-CATEGORIES</h1>
        <div class="row">
            <?php  
                $sql ="SELECT * FROM `catagories`";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)) 
                {   $id=$row['category_id'];
                    $catname=$row['category_name'];
                    $catdesc=$row['cat_discription'];
                    echo '
                    <div class="col-md-4">
                    <div class="card my-2" style="width: 18rem;">
                       <img src="img\card'.$id.'.png" width="200" height="170" class="card-img-top">
                     <div class="card-body">
                        <h5 class="card-title">'.$catname.'</h5>
                        <p class="card-text">'.substr($catdesc,0,50).'...</p>
                        <a href="threds.php?catid='.$id.'" class="btn btn-success">check thread</a>
                     </div>
                     </div>
                    </div>';
                }
                ?>
        </div>
    </div>
    <div class="my-3"></div>
    <?php include'partials/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>