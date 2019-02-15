<?php
	
	include 'header.php';
	include 'dbh.php';
	$uid=$_POST['uid'];
	$pwd=$_POST['pwd'];
	
	$sql = "SELECT * FROM user WHERE uid='$uid' AND pwd='$pwd'"; 
	$result = mysqli_query($conn, $sql);
	
	if(!$row=mysqli_fetch_assoc($result))
	{

		echo "<br><br>Your username or password is incorrect!";

	}
	else
	{
		$_SESSION['id'] = $row['id'];
		header("Location: index.php");
	}
	
?>