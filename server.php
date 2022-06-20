<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $databasename = 'learningform';

    //connect database
    $conn = mysqli_connect($servername, $username, $password, $databasename);

    if($conn){
    }else{
        die("connect failed" . mysqli_connect_error());
    }


?>