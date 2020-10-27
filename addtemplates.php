<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME']))  {
	header('location:index.php');
}
if(isset($_POST['add']))   {
	
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
	$file_nametemplate = $_FILES['template_name']['name'];
	$file_sizetemplate = $_FILES['template_name']['size'];
	$file_tmptemplate = $_FILES['template_name']['tmp_name'];
	$file_typetemplate = $_FILES['template_name']['type'];
	$file_exttemplate = end(explode('.',$file_nametemplate));
	$extensiontemplate = array("zip","rar");
	
	if(in_array($file_ext,$extension) === false)  {
		$error[] = "This file extension is not valid, please upload zip or rar file";
	}
	if($file_size>10097152)  {
	    $error[] = "File size must be 10mb or Lower";
	}
	if(empty($error)=== true)  {
	    move_uploaded_file($file_tmp,"images/".$file_name);
		move_uploaded_file($file_tmptemplate,"templates/".$file_nametemplate);	
	}  else {
		echo"<pre>";
		echo"print_r($error)";
		echo"</pre>";
		die();
	}

	$page = $_GET['TITLE'];
	$title = $_POST['title'];
	$sql = "INSERT INTO $page(IMAGE,TITLE,FILENAME) VALUES ('{$file_name}','{$title}','{$file_nametemplate}')";
    $result = mysqli_query($conn,$sql) or die("Query not running");
	header('location: users.php');
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
      <li class="nav-item dropdown">
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
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" 
        data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">
        Templates
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php 
		 $sql2 = "SELECT TITLE FROM card";
		 $result2 = mysqli_query($conn,$sql2) or die("Template query not running");
		 if(mysqli_num_rows($result2)>0)  {
			 while($row2 = mysqli_fetch_assoc($result2)) {
		?>
          <a class="dropdown-item " href="template.php?TITLE=<?php echo $row2['TITLE'];?>">
		  <?php echo $row2['TITLE'];?></a>
          <?php } }
		  $page = $_GET['TITLE'];
		  ?>
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
   <h2><?php echo "Add"." ".$page." "."Templates"; ?></h2>
 </div>
 </div><!-- row-->
 <div align="center">
 <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" style="width:400px; text-align:
 left" enctype="multipart/form-data">
   
   <div class="form-group">
    <input type="hidden" name="id" placeholder="Id of card" class="form-control" required>
   </div>
   
   <div class="form-group">
    <label>Title *</label>
    <input type="text" name="title" placeholder="Enter title Of Card" class="form-control" required>
   </div>
   
   <div class="form-group">
   <label>Select Image *</label>
     <input type="file"  placeholder="Select Image" class="form-control-file" name="image" required>
   </div>
   
    <div class="form-group">
   <label>Select File *</label>
     <input type="file"  placeholder="Select File" class="form-control-file" name="template_name" required>
   </div>
   
   <input type="submit" class="btn btn-primary" value="Add" name="add" required>
 </form>

</div> <!-- align center div -->
</div> <!-- container fluid -->

  

  </body>
</html>