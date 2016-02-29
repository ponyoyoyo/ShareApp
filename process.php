<?php
session_start();

include_once 'includes/dbconnect.php';
$dbconn = pg_connect($connection) or die('Could not connect: ' . pg_last_error());

if(isset($_SESSION['email']) != "") {
	header("Location: retrieveinfo.php");
}

if(isset($_POST['login-submit'])) {
	//".$GET['item']." are enclosed in SQL ''
	$email = pg_escape_string($_POST['email']);
	$password = pg_escape_string($_POST['password']);
   	$query = "SELECT * FROM member WHERE email = '$email' AND password = '$password'";
    //$query = "select email, password from member where email = '{$email}' and password = '{$password}'";
    $result = pg_query($query);
    $rst = pg_num_rows($result);
   if ($rst > 0)  {
   	header("Location: retrieveinfo.php"); 
	$_SESSION['email'] = $email; 
   }
   else 
     //echo '<html><header><title></title></header>'
     echo "Invalid User";
   	 //echo '<body><button type="button" class="btn btn-link" action="index.php">Return to Login</button></body></html>';
   pg_close($dbconn);
}

if(isset($_POST['register-submit'])) {
	$username = pg_escape_string($_POST['username']);
	$email = pg_escape_string($_POST['email']);
	$password = pg_escape_string($_POST['password']);
	$confirmpassword= pg_escape_string($_POST['confirm-password']);	
	$address = pg_escape_string($_POST['address']);
	$contact = pg_escape_string($_POST['contact']);
	
	if($username == '') {
		echo "<script>alert('Please enter a username')</script>";
		exit();
	}
	
	if($email == '') {
		echo "<script>alert('Please enter an email')</script>";
	}
	
	if($password == '') {
		echo "<script>alert('Please enter a password')</script>";
	}
	
	if($confirmpassword == '') {
		echo "<script>alert('Please confirm your password')</script>";
	}
	
	$rquery = "Select * FROM member WHERE email='$email'";
	$rresult = pg_query($rquery);
	$rrst = pg_num_rows($rresult);
	if ($rrst > 0) {
		echo "<script>alert('The email you have entered is already in use.')</script>";
	}

	if ($password == $confirmpassword) {
		$result = pg_query("INSERT INTO member VALUES('$username', '$email', '$password', '$address', '$contact', '".$_POST['adminflag']."')");
	} 
	
	header("Location: retrieveinfo.php"); 
   	pg_close($dbconn);
}
?> 
