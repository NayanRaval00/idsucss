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
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
            $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            #$id = $row['thread_cat_id'];
            $title= $row['thred_title'];
            $discription = $row['thread_desc'];
        }
        
          if(isset($_POST['submit'])){
            $comment = $_POST['comment'];
            $sno = $_POST['sno'];
            #to protect xss attekes
            $comment = str_replace("<","&lt;",$comment);
            $comment = str_replace(">","&gt;",$comment);
            
            $sql = "INSERT INTO `comments` (`comment_name`, `thread_id`, `comment_time`,`comment_by`)
                    VALUES ('$comment','$id', current_timestamp(),'$sno')";
            $result = mysqli_query($conn,$sql);
            if ($result) {
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Successfully</strong> insert your comment!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong>Somthing went\'s to worong! try again.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          }
        }
       ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="lead"><?php   echo $discription;?></p>
            <hr class="my-4">
            <p class="pe">No Spam / Advertising / Self-promote in the forums. ...<br>
                1.Do not post copyright-infringing material. ...<br>
                2.Do not post “offensive” posts, links or images.... <br>
                3.Do not cross post questions. ...<br>
                4.Do not PM users asking for help. ...<br>
                5.Remain respectful of other members at all times.<br>
            </p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Posted By Nayan</a>
        </div>
    </div>
    <?php
       if(isset($_SESSION['loginsuccessful']) && $_SESSION['loginsuccessful'] == true){
        echo'<div class="container my-4">
        <h2>Start Comments</h2>
        <form method="POST" action=" '.$_SERVER['REQUEST_URI'] .'"> 
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Comment hear</label>
        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
        <input type="hidden" name="sno" class="form-control" value="'.$_SESSION["sno"].'">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>';
    }else{
    echo'<div class="container">
        <div class="alert alert-primary" role="alert">
            <h5>To the start Comments please login first.</h5>
        </div>
    </div>';

    }
    ?>
    <div class="container my-4">
        <h2 class="my-2 py-2">Comments</h2>
        <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
            $result = mysqli_query($conn, $sql);
            $msg =true;
          while ($row = mysqli_fetch_assoc($result)){
            $id = $row['comment_id'];
            $msg = false;
            $cname = $row['comment_name']; 
            $comment_date = $row['comment_time'];

            $cid =$row['comment_by'];            
            $sql2 = "SELECT username FROM `user` where s_no = '$cid'";
            $run = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($run);
            $mail = $row2['username'];
                
        
            echo '<div class="media my-3">
            <img src="j1.png" width="50px" class="mr-3" alt="image is not load" />
            <div class="media-body">
            <p class="font-weight-italic"><span class="pe">'. $mail .'</span>&nbsp;at '. $comment_date .'</p>
            <h5 class="mt-0">'. $cname . '</h5>
            </div>
            </div>';
          }
          
        if ($msg) {
          echo '<div class="alert alert-primary" role="alert">
          <h3 class="alert-heading">No Comments start kindly wait some time!</h3>
          <p>Be The first person to start discussion<hr>
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