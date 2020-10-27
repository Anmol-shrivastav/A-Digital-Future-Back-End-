<?php
include('config.php');
$id = $_GET['ID'];
$page = $_GET['TITLE'];
$sql = "SELECT * FROM $page WHERE ID = {$id}";
$result = mysqli_query($conn,$sql) or die("SELECT QUERY NOT RUNNING");
$row = mysqli_fetch_assoc($result);
unlink("templates/".$row['FILENAME']);
unlink("images/".$row['IMAGE']);
$sql1 = "DELETE FROM $page WHERE ID = {$id}";
mysqli_query($conn,$sql1) or die("DELETE query not running");
header('location: users.php');


?>