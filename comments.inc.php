<?php

function setComments($conn)
{
	if(isset($_POST['commentSubmit']))
	{
		$uid = $_POST['uid'];
		$date = $_POST['date'];
		$message = $_POST['message'];

		$sql ="INSERT INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message')";
		$result = mysqli_query($conn, $sql);
	}
}

function getComments($conn)
{
	$sql = "SELECT * FROM comments";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result))
	{
		$id = $row['uid'];
		$sql2 = "SELECT * FROM user WHERE id='$id'";
		$result2 = mysqli_query($conn, $sql2);
		if($row2 = mysqli_fetch_assoc($result2))
		{
			echo "<div class = 'comments-box'><p>";
			echo $row2 ['first']." ".$row2 ['last']."  posted on ";
			echo $row ['date'].":<br><br>";
			echo nl2br($row ['message']);
			echo "</p>";
			if(isset($_SESSION['id']))
			{
				if($_SESSION['id'] == $row2 ['id'])
				{
					echo"<form class ='delete-form' method = 'POST' action = '".deleteComments($conn)."'>
						<input type ='hidden' name='cid' value='".$row ['cid']."'>
						<button type='submit' name='commentDelete'>Delete</button>
						</form>

						<form class ='edit-form' method = 'POST' action = 'editComment.php'>
						<input type ='hidden' name='cid' value='".$row ['cid']."'>
						<input type ='hidden' name='uid' value='".$row ['uid']."'>
						<input type ='hidden' name='date' value='".$row ['date']."'>
						<input type ='hidden' name='message' value='".$row ['message']."'>
						<button>Edit</button>
						</form>";
				}
			}

		echo "</div>";

		}
	}
}

function editComments($conn)
{
	if(isset($_POST['commentSubmit']))
	{
		$cid = $_POST['cid'];
		$uid = $_POST['uid'];
		$date = $_POST['date'];
		$message = $_POST['message'];

		$sql ="UPDATE comments SET message='$message' WHERE cid='$cid'";
		$result = mysqli_query($conn, $sql);
		header("Location: index.php");
	}
}

function deleteComments($conn)
{
	if(isset($_POST['commentDelete']))
	{
		$cid = $_POST['cid'];

		$sql ="DELETE FROM comments WHERE cid='$cid'";
		$result = mysqli_query($conn, $sql);
		header("Location: index.php");
	}
}




















?>