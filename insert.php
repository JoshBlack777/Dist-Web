<?php

session_start();
$username = $_SESSION['username'];

if(isset($_POST['Add_Review']))
{
	$connect = mysqli_connect("localhost","root","distweb","distweb");
	$rating = $_POST['rating'];
	$review = $_POST['review'];
	$query = "INSERT INTO Review (username,rating,review,date_reviewed) VALUES ('$username','$rating','$review',CURDATE())";
	mysqli_query($connect,$query);
	echo "True";
}
else if(isset($_POST['TV_Review']))
{
	$connect = mysqli_connect("localhost","root","distweb","distweb");
	$rating = $_POST['rating'];
	$review = $_POST['review'];
	$query = "INSERT INTO Review (username,rating,review,date_reviewed) VALUES ('$username','$rating','$review',CURDATE())";
	mysqli_query($connect,$query);
}

?>
