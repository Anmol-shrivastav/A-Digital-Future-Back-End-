<?php
include('config.php');
$id = $_GET['ID'];
$sql = "DELETE FROM userdata Where ID = '{$id}'";
mysqli_query($conn,$sql) or die("Query not running");
header('location: users.php');
?>