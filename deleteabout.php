<?php 
include('config.php');
$id = $_GET['ID'];
$sql = "DELETE FROM about WHERE ID = {$id}";
$result = mysqli_query($conn,$sql) or die("query not running");
header('location: about.php');
?>