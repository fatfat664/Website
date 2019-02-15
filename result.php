<?php
	date_default_timezone_set('Asia/Kolkata');
	include 'header.php';
	include 'dbh.php';
	include 'comments.inc.php';
	$uid = $_GET['id'];
?>

<!DOCTYPE html>

<html>

<head>

	<title></title>

</head>

	<body>
		<?php

			echo "<div class='profile'>";

			$sqlImg = "SELECT * FROM profileimg WHERE userid='$uid'";
			$resultImg = mysqli_query($conn, $sqlImg);
			$rowImg = mysqli_fetch_assoc($resultImg);
			if ($rowImg['status'] == 0)
			{
				echo "<img src='uploads/profile".$uid.".jpg?'".mt_rand().">";
			}
			else
			{
				echo "<img src='uploads/profiledefault.jpg'>";
			}

			echo "<p>";

			$sql = "SELECT * FROM user WHERE id= '$uid'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);

			echo "Name: ".$row['first'].' '.$row['last']."<br>";
			echo "Hometown: ".$row['home']."<br>";
			echo "Currect Location: ".$row['por']."<br>";

			echo "</p>";
			echo "</div>";

			$fat = $_SESSION['id'];

			echo "<div class='wall'>";
			
			echo "<form method = 'POST' action = '".setComments($conn)."'>
					<input type ='hidden' name='uid' value='".$fat."'>
					<input type ='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
					<textarea name='message'></textarea><br><br>
					<button type='submit' name='commentSubmit'>Post</button>
				</form>";

			getComments($conn);

			echo "</div>";
		?>
	</body>

</html>