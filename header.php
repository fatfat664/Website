<?php
	session_start();
?>

<!DOCTYPE html>

<html>

	<head>
		<meta charset="UTF-8">
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="fatter.css">
	
	</head>
	
	<body>
		<header> 
			<nav>
				<h1>WEEBOOK</h1>
				<ul>
					<?php
						if(!isset($_SESSION['id']))
						{
							echo"<li><a href='signup.php'>Signup</a></li>";
						}
					?>
					<li><a href="index.php">Home</a></li>
					<?php
						if(isset($_SESSION['id']))
						{
							echo "<form action='search.php' method='POST'>
									<input type='text' name='first' placeholder='Enter the first name' required>
									<button type='submit'>Search</button>
								</form>";
							echo"<form action='logout.inc.php'>
									<button>Logout</button>
								</form>";
						}
						else
						{
							echo "<form action='login.inc.php' method='POST'>
									<input type='text' name='uid' placeholder='Username' required>
									<input type='password' name='pwd' placeholder='Password' required>
									<button type='submit'>Login</button>
								</form>";
						}
					?>
				</ul>
			</nav>
		</header>
	</body>
</html>

