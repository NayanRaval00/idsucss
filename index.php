<?php
  include 'partial/_dbcon.php';
  include 'partial/_header.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>NAYAN'S FOURM</title>
</head>
<style>
/* width */
::-webkit-scrollbar {
    width: 20px;
}

/* Track 
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius:;
}*/

/* Handle */
::-webkit-scrollbar-thumb {
    background: #222;
    border-radius: px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: darkcyan;
}
</style>

<body>
    <!-- start slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/nav-1.jfif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/nav-2.jfif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/nav-3.jfif" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <h3 class="text-center my-3" style="color:gray;">i Discuss - Categorys</h3>
    <div class="container">
        <!-- card section start -->
        <div class="container row">
            <!-- fetch all the cetagorys -->
            <?php
      $sql = "SELECT * FROM `category`";
      $result = mysqli_query($conn,$sql);
      # use for loop itrate through cetagorys 

      while ($row = mysqli_fetch_assoc($result)) {
        $card = $row['catagory_name'];
        $desc = $row['catagory_discription'];
        $id = $row['catagory_id']; 
        #insert card
        #api unsplesh https://source.unsplash.com/500x400/?
        echo '<div class="col-md-4 my-4">
        <div class="card" style="width: 18rem;">
          <img src="img/card-' . $id . '.jfif" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">
            <a href="partial/_threadspages.php?catid=' . $id . '" style="text-decoration:none;">' . $card . '</a>
            </h5> 
            <p class="card-text">' . substr($desc,0,90) . '...</p>
            <a href="partial/_threadspages.php?catid=' . $id . '" class="btn btn-primary">View Threads</a>
          </div>
        </div>
      </div>';
      
      }
      
      
      
      ?>


        </div>
        <!-- card section end -->
    </div>
    <!-- footer section start -->
    <?php include 'partial/_footer.php';?>
    <!-- footer section end -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

</html>