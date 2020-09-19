<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">i Discuss</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link" href="/fourm_website/index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/fourm_website/partial/_about.php">About</a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Categorys
        </a>


      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql ="SELECT catagory_name, catagory_id FROM `category` LIMIT 3";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
          $id = $row['catagory_id'];
        echo'<a class="dropdown-item" href="/fourm_website/partial/_threadspages.php?catid='.$id.'">'. $row['catagory_name'] .'</a>';
        }
      echo '</div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/fourm_website/partial/_contect.php" tabindex="-1">Contect Us</a>
    </li>
  </ul>
  <div class="rowmx-2">';
  if (isset($_SESSION['loginsuccessful']) && $_SESSION['loginsuccessful'] == true) {
  echo '<form class="form-inline my-2 my-lg-0" action="/fourm_website/partial/_search.php">
      <input class="form-control mr-sm-2" type="search"  name="search" placeholder="Search" aria-label="Search" required>
      <button class="btn btn-outline-primary mr-2 my-2 my-sm-0">Search</button>
      <p class="text-light my-0 mx-2" style="text-transform:uppercase;">welcome '. $_SESSION['username'].'</p>
      <a href="/fourm_website/partial/_logout.php" class="btn btn-danger ml-2">Logout</a>
  </form>';
}else{ 
   echo '
   <form class="form-inline my-2 my-lg-0" action="/fourm_website/partial/_search.php">
       <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search" required>
       <button class="btn btn-outline-primary mr-2 my-2 my-sm-0">Search</button>
       <!--  Ragistration Button trigger modal -->
       <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
           data-target="#ragisterModal">Ragister</button>
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</button>
   </form>';
}
  echo '</div>
</div>
</nav>';
include '_loginModal.php';
include '_ragisterModal.php';
?>
