<?php
include('config.php');
if(empty($_FILES['image']['name'])) {
	$file_name = $_POST['oldimage'];
}  
else {	
	$error = array();
	
	$file_name = $_FILES['image']['name'];
	$file_size = $_FILES['image']['size'];
	$file_tmp = $_FILES['image']['tmp_name'];
	$file_type = $_FILES['image']['type'];
	$file_ext = end(explode('.',$file_name));
	$extension = array("jpeg","jpg","png");
	
	if(in_array($file_ext,$extension) === false)  {
		$error[] = "This file extension is not valid, please upload jpg or png file";
	}
	if($file_size>2097152)  {
	    $error[] = "File size must be 2mb or Lower";
	}
}
	if(empty($error)=== true)  {
	    move_uploaded_file($file_tmp,"images/".$file_name);	
	}  else {
		echo"<pre>";
		echo"print_r($error)";
		echo"</pre>";
		die();
	}

	$id = $_POST['id'];
	$title = $_POST['title']; 
	$description = $_POST['description'];
	
	$sql = "UPDATE card SET IMAGE='{$file_name}',TITLE='{$title}',DESCRIPTION='{$description}'
	 WHERE ID = {$id}";
    $result = mysqli_query($conn,$sql) or die("Query not running");
	header('location: homecard.php');

?>