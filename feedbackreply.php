
<?php
include('config.php');
session_start();
if(!isset($_SESSION['USERNAME']))  {
	header('location:index.php');
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
        <a class="nav-link dropdown-toggle" href="users.php" id="navbarDropdown" role="button" 
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
   <h2><u>Reply</u></h2>
 </div>
 </div><!-- row-->
 <div align="center">
 <?php 
    $id = $_POST['id'];
    $email = $_POST['email'];
    $username = $_POST['username'];
	$sql = "SELECT * FROM feedback WHERE ID = {$id}";
    $result = mysqli_query($conn,$sql) or die("Query not running");
	if(mysqli_num_rows($result)>0)  {
		while($row = mysqli_fetch_assoc($result))  {
	 
 ?>
 <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" 
 style="width:400px; text-align:left">
   <div class="form-group">
    <input type="hidden" name="id" class="form-control" 
    value="<?php echo $row['ID'];?>" 
    readonly required style="background-color:white">
   </div>
     
   <div class="form-group">
    <label>User Name</label>
    <input type="text" name="username" class="form-control" 
    value="<?php echo $row['USERNAME'];?>" 
    readonly required style="background-color:white">
   </div>
   
   <div class="form-group">
    <label>User Email Address</label>
    <input type="email" name="email" class="form-control" readonly required 
    value="<?php echo $row['EMAIL'];?>" style="background-color:white">
   </div>
   
   <div class="form-group">
   <label>Reply * </label>
   <textarea class="form-control" rows="5" placeholder="Type Your Reply Here...." 
   style="background-color:white" required></textarea>
   </div>
   
   
   <input type="submit" class="btn btn-success" value="Reply" name="add" required>
 </form>
 <?php } }?>

</div> <!-- align center div -->
</div> <!-- container fluid -->

  

  </body>
</html>