<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME']))  {
	header('location:index.php');
}
if(isset($_POST['add']))   {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$role = $_POST['role'];
	if($password === $repassword)  {
		$sql1 = "SELECT * FROM userdata WHERE 
		     NAME='{$username}'&&EMAIL='{$email}'&&PASSWORD ='$password' &&ROLE='$role'";
	$result = mysqli_query($conn,$sql1) or die("First query is not running");
	if(mysqli_num_rows($result)>0)
	 {
		echo '<script type="text/javascript">
               alert("Already have an account")
			   window.location="addusers.php"
              </script>';
	 }else {
		 if($role === "Normal User") {
			 $sql = "INSERT INTO userdata(NAME,EMAIL,PASSWORD,ROLE)
	                 VALUES('{$username}','{$email}','{$password}','{$role}');";
	         mysqli_query($conn,$sql) or die("Query not running");
	         header('location: users.php');
		 } else {
			  $sql = "INSERT INTO adminusers(USERNAME,EMAIL,PASSWORD,ROLE)
	                 VALUES('{$username}','{$email}','{$password}','{$role}');";
	         mysqli_query($conn,$sql) or die("Query not running");
	         header('location: users.php');
		 }
	
	 }
	}else  {
		echo'<script type="text/javascript">alert("Password Does not matched");
		window.location="addusers.php";
		</script>';
	}
}
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Admin Pannel</title>
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
       <h2>Welcome To Admin Pannel</h2>
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
        <a class="nav-link dropdown-toggle active" href="users.php" id="navbarDropdown" 
        role="button" 
        data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">
        Home
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="users.php">users</a>
        
       
          <a class="dropdown-item" href="carousel.php">Carousel</a>
   
          
          <a class="dropdown-item" href="homecard.php">Card</a>
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
   <h2>Add Users</h2>
 </div>
 </div><!-- row-->
 <div align="center">
 <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" style="width:400px; text-align:left">
   <div class="form-group">
    <label>UserName *</label>
    <input type="text" name="username" placeholder="Enter Name" class="form-control" required>
   </div>
   
   <div class="form-group">
    <label>Email Address *</label>
    <input type="email" name="email" placeholder="Enter Email Address" class="form-control" required>
   </div>
   
   <div class="form-group">
    <label>Password *</label>
    <input type="password" name="password" placeholder="Enter Password" class="form-control" required>
   </div>
   
   <div class="form-group">
    <label>Confirm-password *</label>
    <input type="password" name="repassword" placeholder="Enter Password" class="form-control"
    required>
   </div>
   
   <div class="form-group">
    <label>Role *</label>
    <select class="form-control" name="role">
        <option>Normal User</option>
        <option>Admin</option>
    </select>
   </div>
   
   <input type="submit" class="btn btn-primary" value="Add" name="add" required>
 </form>

</div> <!-- align center div -->
</div> <!-- container fluid -->

  

  </body>
</html>