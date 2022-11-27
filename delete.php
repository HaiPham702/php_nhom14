<?php
    $id = $_GET['id'];
    require_once 'db.php';
    $query = mysqli_query($conn, "delete from suplier where Id = '$id'");
    header("location: NhaPhanPhoi.php");
?>