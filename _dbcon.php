<?php
    $servername = "localhost";
    $username = 'root';
    $password = '';
    $databasename = 'idiscuss';
    
    $conn=mysqli_connect($servername, $username, $password, $databasename);

    if (!$conn) {
        echo 'database was not connecet beacuse-->'.mysqli_connect_error();
    }else {
        #echo 'successfully connect';
    }
?>