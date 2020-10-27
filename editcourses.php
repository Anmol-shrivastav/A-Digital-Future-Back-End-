<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME']))  {
	header('location:index.php');
}
if(isset($_POST['update'])) {
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
}	
	if(in_array($file_ext,$extension) === false)  {
		$error[] = "This file extension is not valid, please upload jpg or png file";
	}
	if($file_size>2097152)  {
	    $error[] = "File size must be 2mb or Lower";
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
	
	$sql = "UPDATE courses SET 
	       IMAGE='{$file_name}',TITLE='{$title}',DESCRIPTION='{$description}'
		     WHERE ID = {$id}";
    $result = mysqli_query($conn,$sql) or die("Query not running");
	header('location: courses.php');


}
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
    <style>
	  body {
		  margin:0;
		  padding:0;
	  }
	 
	  table {
		  width:100%;
	  }
	  th, tr {
		  border:1px solid white;
		  padding:8px;
		  text-align:center;
	  }
	  td {
		background-color:#CCC;
		padding:5px;
		border:1px solid white;
		text-align:center; 
	  }
	  form {
		  padding-bottom:50px;
		  
	  }
		  
	</style>
    
  </head>
  
  <body>
  <div class="container-fluid">
  <div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12" style="height:auto; 
     background-color:#0F6">
       <h2>Welcome To Admin Panel</h2>
       <p style="color:#999">
       <strong>Welcome Back <?php echo $_SESSION['USERNAME'];?></strong></p>
       
     </div><!--welcome div -->
  </div>  <!-- row div -->
    </div><!-- container -->
 <nav class="navbar navbar-expand-lg navbar-light bg-dark navbar-dark">
  <h4 class="navbar-brand" style="margin-top:6px">Admin Features:</h4>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle active" href="users.php" 
        id="navbarDropdown" role="button" 
        data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">
        Home
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="users.php">users</a>
        
       
          <a class="dropdown-item" href="carousel.php">Carousel</a>
   
          
          <a class="dropdown-item" href="homecard.php">Card</a>
          
          <a class="dropdown-item" href="about.php">About Us</a>
          
          <a class="dropdown-item" href="steps.php">Steps</a>
          
          <a class="dropdown-item" href="courses.php">Courses</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="feedback.php">Feedback</a>
      </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout.php" style="color:white">Logout</a>
        </li>
      </ul>
   </div>
 
</nav>
<!--ending of navbar -->

<div class="container-fluid">
 <div class="row">
 <div class="col-lg-10 col-md-10 col-sm-10 col-10">
   <h2>Edit Courses Card's</h2>
 </div>
 </div><!-- row-->
 <div align="center">
 <?php 
   $id = $_GET['ID'];
   $sql = "SELECT * FROM courses WHERE ID = {$id}";
   $result = mysqli_query($conn,$sql) or die("Query not running");
   if(mysqli_num_rows($result)>0)  {
	   while($row = mysqli_fetch_assoc($result)) {
 ?>
 <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" style="width:400px; text-align:
 left" enctype="multipart/form-data">
 <div class="form-group">
    <input type="hidden" name="id" class="form-control" 
    value="<?php echo $row['ID']; ?>">
   </div>
 
   <div class="form-group">
    <label>Title *</label>
    <input type="text" name="title" placeholder="Enter title Of Card" class="form-control" 
    value="<?php echo $row['TITLE']; ?>" required>
   </div>
   
   <p>Card Description *</p>
   <div class="form-group">
      <textarea name="description" placeholder="Enter Card Description" rows="5" class=
      "form-control" required><?php echo $row['DESCRIPTION']; ?></textarea>
   </div>
   
   
   <div class="form-group">
     <label>Card Image *</label>
      <img src="images/<?php echo $row['IMAGE']; ?>" height="100vh">
     <input type="file" name="image">
     <input type="hidden" name="oldimage" value="<?php echo $row['IMAGE']; ?>">
   </div>
   
   <input type="submit" class="btn btn-primary" value="Update" name="update" required>
 </form>
 <?php } }?>

</div> <!-- align center div -->
</div> <!-- container fluid -->

  

  </body>
</html>