<?php 
include('config.php');
$id = $_GET['ID'];
$sql = "DELETE FROM feedback WHERE ID = {$id}";
mysqli_query($conn,$sql) or die("Query not running");
header('location: feedback.php');
?>