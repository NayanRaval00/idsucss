<?php 
  include '_dbcon.php';
  if(isset($_POST['ragister'])){

  $username =$_POST['username'];
  $password =$_POST['password'];
  $cpassword =$_POST['cpassword'];
  $pass = password_hash($password,PASSWORD_BCRYPT);
  $cpass = password_hash($cpassword,PASSWORD_BCRYPT);
  $sql = "SELECT * FROM `user` where username = '$username'";
  $result = mysqli_query($conn,$sql);
  $count_email = mysqli_num_rows($result);
  
    if ($count_email>0) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Sorry!</strong>you can not use this email beacuse it is alrady in use.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
  }else{
  if ($password == $cpassword) {
    $insert = "INSERT INTO user(`username`, `password`, `cpassword`, `user_date`)
               VALUES ('$username', '$pass', '$cpass', current_timestamp())";
    $result = mysqli_query($conn, $insert);


      echo '<script>alert("data inserted successfully!");</script>';
  }else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Sorry!</strong>password is wrong!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
    }     
    }
}
?>
<!-- Modal -->
<div class="modal fade" id="ragisterModal" tabindex="-1" aria-labelledby="ragisterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ragisterModalLabel">Ragister Hear!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" name="username" class="form-control" id="username" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Confirm password</label>
                        <input type="password" name="cpassword" class="form-control" id="cpassword" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="ragister">Ragister</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>