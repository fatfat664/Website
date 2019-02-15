<?php
	date_default_timezone_set('Asia/Kolkata');
	include 'header.php';
	include 'dbh.php';
	include 'comments.inc.php';
?>

<!DOCTYPE html>

<html>

<head>

	<title></title>

</head>

	<body>
		<?php
			if(isset($_SESSION['id']))
			{
				echo "<div class='profile'>";

				$id = $_SESSION['id'];
				$sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
				$resultImg = mysqli_query($conn, $sqlImg);
				$rowImg = mysqli_fetch_assoc($resultImg);
				if ($rowImg['status'] == 0)
				{
					$filename = "uploads/profile".$id."*";
					$fileinfo = glob($filename);
					$fileext = explode(".",$fileinfo[0]);
					$fileactualext = $fileext[1];
					echo "<img src='uploads/profile".$id.".".$fileactualext."?".mt_rand()."''>";
				}
				else
				{
					echo "<img src='uploads/profiledefault.jpg'>";
				}

				echo "<p>";

				$fat = $_SESSION['id'];
				$sql = "SELECT * FROM user WHERE id = '$fat'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);

				echo "Name: ".$row['first'].' '.$row['last']."<br>";
				echo "Hometown: ".$row['home']."<br>";
				echo "Currect Location: ".$row['por']."<br>";

				echo "<br>Upload your profile picure:<br><br>
					<form action = 'upload.php' method = 'POST' enctype = 'multipart/form-data'>
					<input type = 'file' name = 'file'>
					<button type = 'submit' name = 'submit'>Upload</button>
					</form>";

				echo "<br>Delete your profile picure:
					<form action= 'deleteimg.php' method = 'POST'>
					<button type = 'submit' name = 'submit'>Delete</button>
					</form>";

				echo "</p>";
				echo "</div>";



				echo "<div class='wall'>";

				echo "<form method = 'POST' action = '".setComments($conn)."'>
					<input type ='hidden' name='uid' value='".$fat."'>
					<input type ='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
					<textarea name='message'></textarea><br><br>
					<button type='submit' name='commentSubmit'>Post</button>
					</form>";

				getComments($conn);

				echo "</div>";
			}

			else
			{
				echo "<div class='stub'>";

				echo "<p>";

				echo "<br><br><img src='uploads/profiledefault.jpg'>";
				echo "<br><br>Hello! You are not logged in yet!";

				echo "</p>";

				echo "</div>";
			}
		?>

	</body>

</html>