<?php
include '_dbcon.php';
include '_header.php';
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

    <title>thread</title>
    <style>
    img {
        border-radius: 50%;
    }
    .pe {
        color: red;
    }
    </style>
</head>

<body>
    <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `category` WHERE catagory_id = $id";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $catname= $row['catagory_name'];
            $catdisc = $row['catagory_discription'];
        }
           if (isset($_POST['submit'])) {
            #insert data into the database.. 
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $sno = $_SESSION['sno'];
            
            #to protect xss attake with replace this

            $title = str_replace("<","&lt;",$title);
            $title = str_replace("<","&gt;",$title);

            $desc = str_replace("<","&lt;",$desc);
            $desc = str_replace(">","&gt;",$desc);

            $sql = "INSERT INTO `threads` (`thred_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) 
                  VALUES('$title', '$desc', '$id', '$sno')";
            $result = mysqli_query($conn,$sql);
            if ($result) 
            {
              echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
              <strong>Inserted successfully</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong>Try again!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            }
          else{
            #echo 'error in your code';
          }
    ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname;?> fourms</h1>
            <p class="lead"><?php   echo $catdisc;?></p>
            <hr class="my-4">
            <p class="pe">No Spam / Advertising / Self-promote in the forums. ...<br>
                1.Do not post copyright-infringing material. ...<br>
                2.Do not post “offensive” posts, links or images.... <br>
                3.Do not cross post questions. ...<br>
                4.Do not PM users asking for help. ...<br>
                5.Remain respectful of other members at all times.<br>
            </p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <!-- questions form start -->
    <?php
        if (isset($_SESSION['loginsuccessful']) && $_SESSION['loginsuccessful'] == true){
        echo'<div class="container">
        <h2 class="my-4 py-2">Browse Questions</h2>
        <form method="POST" action= "'.$_SERVER['REQUEST_URI'] .'"
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control" name="title" id="title"
         aria-describedby="emailHelp" required>
        <small id="emailHelp" class="form-text text-muted">Keep your title sort and <b>crisp</b> as possible
        </small>
    </div>
    <div class="container">
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Elibrate your concern</label>
        <textarea class="form-control" id="question" name="desc" rows="3" required></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    </div>';
    }else{
    echo'<div class="container">
        <div class="alert alert-primary" role="alert">
            <h5>To the ask Questions please login first.</h5>
        </div>
    </div>';
    }
    ?>
    <!-- questions for end -->
    <!-- quetion show query -->
    <div class="container my-4">
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
        $msg = true;
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
           $id = $row['thread_id'];
            $msg = false;
            $title = $row['thred_title'];
            $desc = $row['thread_desc'];
            $tuserid =$row['thread_user_id'];
            $ttime = $row['timestramp'];
            
            
        $sql2 = "SELECT username FROM `user` where s_no = '$tuserid'";
        $run = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($run);
        $mail = $row2['username'];
        
        echo '<div class="media my-3  ">
            <img src="j1.png" width="50px" class="mr-3" alt=""/>
            <div class="media-body">
            <p class="font-weight-bold my-0"><span class="pe">'. $mail .'</span> at '.$ttime.'</p>
                <h5 class="mt-0"><a href="_thread.php?threadid='. $id .'"> ' . $title . '</a></h5>
                '. $desc.' 
            </div>
        </div>';
        }
        if ($msg) {
          echo '<div class="alert alert-success" role="alert">
          <h3 class="alert-heading">No Threds Found!</h3>
          <p>Be The first person to ask question<hr>
          <p class="mb-0"></div>';
        }
        
        ?>


    </div>

    <!-- footer section start -->
    <?php include '_footer.php';?>
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