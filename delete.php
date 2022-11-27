<?php
    $id = $_GET['id'];
    $page = $_GET['page'];
    //require_once 'db.php';
$conn = mysqli_connect($servername, $username, $password, $database);
     mysqli_set_charset($conn, "utf8");
     // Check connection
     if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
         exit();
     }
    $query = mysqli_query($conn, "delete from suplier where Id = '$id'");
    header("location: $page");
?>
