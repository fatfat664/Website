<?php

	include 'header.php';

	echo "<br><br>Welcome!<br><br> Create a new account by filling out the following details:<br><br>";

	$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	if (strpos($url,'error=username')!==false)
	{
		echo"<br><br>Username already exists!";
	}
	if (strpos($url,'error=email')!==false)
	{
		echo"<br><br>That email has already been taken!";
	}
	if(isset($_SESSION['id']))
	{

		echo "<br><br>You are already logged in!";

	}
	else
	{
		echo "<br><br><form action='signup.inc.php' method='POST'>
				<input type='email' name='email' placeholder='Email' input title='Enter a valid Email address' required><br><br>
				<input type='text' name='first' placeholder='Firstname' required pattern='[A-Za-z]+'><br><br>
				<input type='text' name='last' placeholder='Lastname' required pattern='[A-Za-z]+'><br><br>
				<input type='text' name='uid' placeholder='Username' input title='Usernames must only contain alphabets, numbers and underscores' required pattern='\w+'><br><br>
				<input type='password' name='pwd' placeholder='Password' input title='Password must contain at least 6 characters, including UPPER/lowercase and numbers' required pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}'><br><br>
				<input type='text' name='home' placeholder='Hometown' required pattern='[A-Za-z]+'><br><br>
				<input type='text' name='por' placeholder='Current Location' required pattern='[A-Za-z]+'><br><br>
				<button type='submit'>Sign Up</button>
			</form>";
	}
?>