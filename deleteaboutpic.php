<?php
include('config.php');
$id = $_GET['ID'];
$sql1 = "SELECT * FROM aboutpic WHERE ID = {$id}";
$result1 = mysqli_query($conn,$sql1) or die("select query not running");
$row = mysqli_fetch_assoc($result1);
unlink("images/".$row['IMAGE']);
$sql = "DELETE FROM aboutpic WHERE ID = {$id}";
$result = mysqli_query($conn,$sql) or die("Delete query not running"); 
header('location: about.php');
?>