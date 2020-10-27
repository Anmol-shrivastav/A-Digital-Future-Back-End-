
<?php 
$email = $_POST['email'];
$password = $_POST['password'];
$conn = mysqli_connect('localhost','root','','newwebsite') or die('Not Connected With Server');
$sql = "SELECT * FROM adminusers WHERE EMAIL ='{$email}' && PASSWORD = '{$password}' &&ROLE='Admin'";
$result = mysqli_query($conn,$sql) or die('Query Not Running');
if(mysqli_num_rows($result)>0)  {
	while($row = mysqli_fetch_assoc($result))  {
	session_start();
	$_SESSION['USERNAME'] = $row['USERNAME'];
	}
	header('location: users.php');
	
}else {
	echo'<script type="text/javascript">alert("Email Or Password is Incorrect");
	window.location="index.php"</script>';
}
?>