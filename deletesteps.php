<?php 
$id = $_GET['ID'];
include('config.php');
$sql1 = "SELECT * FROM steps WHERE ID = {$id}";
$result = mysqli_query($conn,$sql1) or die("Select Query not running");
$row = mysqli_fetch_assoc($result);
unlink("images/".$row['IMAGE']);
$sql = "DELETE FROM card WHERE ID ={$id}";
mysqli_query($conn,$sql) or die("Query not running");
header('location: steps.php');
?>
