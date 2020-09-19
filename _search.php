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

    <title>NAYAN'S FOURM</title>
</head>
<style>
/* width */
::-webkit-scrollbar {
    width: 20px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #222;
    border-radius: px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: darkcyan;
}

.main {
    min-height: 100vh;
}
</style>

<body>
    <!-- search result start hear -->
    <div class="container main my-3">
        <h1 class="text-dark">Searech results for <?php echo $_GET['search'];?></h1>
        <?php
        $text = $_GET['search'];
        #SEARCH IN MYSQLI DATABSE
        $sql2 = "SELECT * FROM threads WHERE MATCH(thred_title,thread_desc) against ('$text')";
        $result = mysqli_query($conn,$sql2);
        $no = true;
        while($row = mysqli_fetch_assoc($result)){
            $no = false;
            $catid = $row['thread_cat_id'];
            $url = "/fourm_website/partial/_threadspages.php?catid=".$catid;    
            echo '<h3 class="text-success"><a href="'.$url.'">'.$row['thred_title'].'</a></h3>';
            echo '<p class="text-dark">'.$row['thread_desc'].'</p>';
        }
        if ($no=='true') {
            echo '<div class="alert alert-danger" role="alert">
            <h3 class="alert-heading">No Results found!</h3>
            <p></p>
            <hr>
            <p class="mb-0"></p>
        </div>';
        }
        ?>

    </div>
</body>

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