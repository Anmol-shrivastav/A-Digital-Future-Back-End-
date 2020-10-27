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
	  .container  {
		  padding:20px;
		  margin-top:60px;
		  width:400px;
		  background-color:#0F9;
	  }
	</style>
    
  </head>
  
<body class="bg-dark">
<div class="container">
    <h1 align="center">Welcome Admin:</h1>
    <form action="login.php" method="post">
       <div class="form-group">
         <label>Email Address:</label>
        <input type="email" class="form-control"  placeholder="Enter Password" required name="email" >
       </div>
       
       <div class="form-group">
         <label>Password:</label>
         <input type="password" class="form-control" placeholder="Enter Password" required name="password" >
       </div>
       <input type="submit" name="login" class="btn btn-danger" value="Login">
    </form>
 </div> <!-- container div  -->
  
</body>
</html>