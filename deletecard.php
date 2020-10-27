<?php 
$id = $_GET['ID'];
$title = $_GET['TITLE'];
include('config.php');
$sql1 = "SELECT * FROM card WHERE ID = {$id}";
$result = mysqli_query($conn,$sql1) or die("Select Query not running");
$row = mysqli_fetch_assoc($result);
unlink("images/".$row['IMAGE']);
$sql = "DELETE FROM card WHERE ID ={$id}";
mysqli_query($conn,$sql) or die("Query not running");
$sql2 = "DROP TABLE $title";
$result1 = mysqli_query($conn,$sql2) or die("Drop query not running");
header('location: homecard.php');
?>
