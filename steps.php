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
    <title>Admin Panel</title>
    
     <!-- bootstrap 4 files -->
    <link rel="stylesheet" type="text/css" href="mycss/file.css">
    <script src="myjquery/jqueryfirst.js" type="text/javascript"></script>
    <script src="myjquery/secondproper.js" type="text/javascript"></script>
    <script src="myjquery/thirdbootstrap.js" type="text/javascript"></script>
    <style>
	  body {
		  margin:0;
		  padding:0;
	  }
	  button {
		  margin-top:4px;
		  float:right;
	  }
	  table {
		  width:100%;
	  }
	  th {
		  border:1px solid white;
		  padding:8px;
		  text-align:center;
	  }
	  tr {
		  border:1px solid white;
		  text-align:center;
		  
	  }
	  td {
		background-color:#CCC;
		padding:5px;
		border:1px solid white;
		text-align:center; 
	  }
	  table {
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
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="users.php" id="navbarDropdown" role="button" 
        data-toggle="dropdown" aria-haspopup="true"aria-expanded="false">
        Home
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="users.php">users</a>
        
       
          <a class="dropdown-item" href="carousel.php">Carousel</a>
   
          
          <a class="dropdown-item" href="homecard.php">Card</a>
          
          <a class="dropdown-item" href="about.php">About Us</a>
          
            <a class="dropdown-item active" href="steps.php">Steps</a>
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
 <div class="col-lg-8 col-md-8 col-sm-8 col-8">
   <h2>Steps for Development Section.</h2>
 </div>
 <div class="col-lg-4 col-md-4 col-sm-4 col-4" style="width:100%">
    <button class="btn btn-dark" onClick="location.href='addsteps.php'">
    Add card</button>
 </div>
 </div><!-- row div -->
 <div class="row">
 <div class="col-lg-12 col-md-12 col-sm-12 col col-12">
 
  <table>
     <thead style="background-color:#333">
       <tr>
         <th style="color:white">Id</th>
         <th style="color:white">Image</th>
         <th style="color:white">Title</th>
         <th style="color:white">Description</th>
         <th style="color:white">Edit</th>
         <th style="color:white">Delete</th>
       </tr>
     </thead>
     <tbody>
     <?php  
	   $sql ="SELECT * FROM steps ORDER BY ID DESC";
	   $result = mysqli_query($conn,$sql) or die("query not running");
	   if(mysqli_num_rows($result)>0)  {
		   while($row = mysqli_fetch_assoc($result)) {
	 ?>
        <tr>
          <td><?php echo $row['ID']; ?></td>
           <td><?php echo $row['IMAGE']; ?></td>
            <td><?php echo $row['TITLE']; ?></td>
            <td><?php echo $row['DESCRIPTION']; ?></td>
          <td><a href="editsteps.php?ID=<?php echo $row['ID']; ?>"><i>Edit.</i></a></td>
          <td><a href="deletesteps.php?ID=<?php echo $row['ID']; ?>"><i>Delete.</i></a></td>
        </tr>
        <?php }}?>
       
     </tbody>
  </table>
  
  </div> <!-- col - 12 div -->
 </div><!-- row div-->
</div> <!-- container fluid -->

  

  </body>
</html>