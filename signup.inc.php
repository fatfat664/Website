<?php

	include 'header.php';
	include 'dbh.php';

	$email=$_POST['email'];
	$first=$_POST['first'];
	$last=$_POST['last'];
	$uid=$_POST['uid'];
	$pwd=$_POST['pwd'];
	$home=$_POST['home'];
	$por=$_POST['por'];

	$sql= "SELECT email FROM user WHERE email = '$email'";
	$result = mysqli_query($conn, $sql);
	$emailcheck = mysqli_num_rows($result);
	if ($emailcheck > 0)
	{
		header('Location: signup.php?error=email');
		exit();
	}
	
	$sql= "SELECT uid FROM user WHERE uid = '$uid'";
	$result = mysqli_query($conn, $sql);
	$uidcheck = mysqli_num_rows($result);
	if ($uidcheck > 0)
	{
		header('Location: signup.php?error=username');
		exit();
	}

	else
	{
		$sql = "INSERT INTO user (email, first, last, uid, pwd,home,por) 
		VALUES ('$email','$first','$last','$uid','$pwd','$home','$por')";
		$result = mysqli_query($conn, $sql);
		$sql = "SELECT * FROM user WHERE uid='$uid' AND first='$first'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0)
		{
			while ($row = mysqli_fetch_assoc($result))
			{
				$userid = $row['id'];
				$sql = "INSERT INTO profileimg (userid, status)
				VALUES ('$userid', 1)";
				mysqli_query($conn, $sql);
				header("Location: index.php");
			}
		}
	}
?>