<?php

	include 'header.php';
	include_once 'dbh.php';
	$id = $_SESSION['id'];

	if(isset($_POST['submit']))
	{
		$file = $_FILES['file'];

		$fileName = $file['name'];
		$fileTmpName = $file['tmp_name'];
		$fileSize = $file['size'];
		$fileError = $file['error'];
		$fileType = $file['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png');
		if (in_array($fileActualExt, $allowed))
		{
			if($fileError ==0)
			{
				if ($fileSize < 1000000)
				{
					$fileNameNew = "profile".$id.".".$fileActualExt;
					$fileDestination = 'uploads/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					$sql = "UPDATE profileimg SET status=0 WHERE userid='$id';";
					$result = mysqli_query($conn, $sql);
					header("Location: index.php?uploadsuccess");
				}
				else
				{
					echo "<br>Your file is too big!";
				}

			}
			else
			{
				echo "<br>There was an error uploading your file!";
			}
		}
		else
		{
			echo "<p>";
			echo "You cannot upload files of this type!";
			echo "</p>";
		}
	}
?>