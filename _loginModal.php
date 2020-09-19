<?php 
  include '_dbcon.php';
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM `user` where username = '$username'";
    $result = mysqli_query($conn,$sql);
    #echo var_dump($result);
    $fetch = mysqli_num_rows($result);
    #echo var_dump($fetch); 
    if ($fetch) {
      # fetch password using sql query.
      $fpass = mysqli_fetch_assoc($result);
      $db_pass = $fpass['password'];
      $_SESSION['sno'] = $fpass['s_no'];
      $_SESSION['username'] = $fpass['username'];
      
      $pass_decode = password_verify($password,$db_pass);
      if ($pass_decode) {
        $_SESSION['loginsuccessful']= true;
        echo "<script>alert('LOGIN SUCESSFULLY');</script>";
        #echo $username;
        header("location:/fourm_website/index.php"); 
      }else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong>password is wrong!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        header("location:/fourm_website/index.php");
      }
    } else
    {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong>Email is not exist in the databse!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            header("location:/fourm_website/index.php");
    }
  }
?>
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">LOGIN HEAR!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!--  -->

                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>