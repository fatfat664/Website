<?php
	include 'header.php';
	include 'dbh.php';
	$first = $_POST['first'];
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php

	$sql = "SELECT * FROM user WHERE first='$first'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$id = $row['id'];
			$sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
			$resultImg = mysqli_query($conn, $sqlImg);
			while ($rowImg = mysqli_fetch_assoc($resultImg))
			{
				echo "<div class='user-container'>";
				if ($rowImg['status'] == 0)
				{
					echo "<img src='uploads/profile".$id.".jpg?'".mt_rand().">";
				}
				else
				{
					echo "<img src='uploads/profiledefault.jpg'>";
				}
				echo"<p><a href='result.php?id=".$row['id']."'>".$row['first'].' '.$row['last']."</a></p>";
				echo "</div>";
			}
		}
	}
	else
	{
		echo "<br><br><br><img src='search.jpg'>";
		echo "<br><br>Oops! We couldn't find anyone with that name!";
	}

?>

</body>
</html>