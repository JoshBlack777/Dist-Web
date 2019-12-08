<?php
session_start();
	$db = mysqli_connect('localhost', 'root', 'distweb', 'distweb');
	$movieID = $_GET['movieID'];
	$username = $_SESSION['username'];

	$sqlTitle = "SELECT movie_name FROM `movie` WHERE movieID = '" . $movieID . "'";
	$queryTitle = mysqli_query($db, $sqlTitle);
	$rowTitle = mysqli_fetch_array($queryTitle);

	$sqlGenre = "SELECT genre FROM `movie` WHERE movieID = '" . $movieID . "'";
	$queryGenre = mysqli_query($db, $sqlGenre);
	$rowGenre = mysqli_fetch_array($queryGenre);

	$sqlRating = "SELECT mpaa_rating FROM `movie` WHERE movieID = '" . $movieID . "'";
	$queryRating = mysqli_query($db, $sqlRating);
	$rowRating = mysqli_fetch_array($queryRating);

	$sqlRuntime = "SELECT runtime FROM `movie` WHERE movieID = '" . $movieID . "'";
	$queryRuntime = mysqli_query($db, $sqlRuntime);
	$rowRuntime = mysqli_fetch_array($queryRuntime);

	$sqlReleaseDate = "SELECT release_date FROM `movie` WHERE movieID = '" . $movieID . "'";
	$queryReleaseDate = mysqli_query($db, $sqlReleaseDate);
	$rowReleaseDate = mysqli_fetch_array($queryReleaseDate);

	$sqlDescription = "SELECT description FROM `movie` WHERE movieID = '" . $movieID . "'";
	$queryDescription = mysqli_query($db, $sqlDescription);
	$rowDescription = mysqli_fetch_array($queryDescription);


	$movieID = $_GET['movieID'];
	$movieTitle = $rowTitle['movie_name'];
	$movieGenre = $rowGenre['genre'];
	$movieRating = $rowRating['mpaa_rating'];
	$movieRuntime = $rowRuntime['runtime'];
	$movieDate = $rowReleaseDate['release_date'];
	$movieDescription = $rowDescription['description'];

	$movieImage = $movieTitle . ".jpg";
	$video = $movieTitle . ".mp4";

	if(isset($_POST['insert']))
	{
		$connect = mysqli_connect("localhost","root","distweb","distweb");
		$rating = $_POST['rating'];
		$review = $_POST['review'];
		$query = "INSERT INTO Review (username,rating,review,date_reviewed) VALUES ('$username','$rating','$review',CURDATE())";
		mysqli_query($connect,$query);
		$query2 = "INSERT INTO movie_review (movieID, reviewID) VALUES ('$movieID', (SELECT reviewID FROM Review ORDER BY reviewID DESC LIMIT 1))";
		mysqli_query($connect,$query2);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<style>
			body{
				background-color: #FBEEC1;
				font-family: Arial;
			}
			table {
						border-collapse: collapse;
						background-color: white;
						width: 75%;
						align: center;

					}
			table, th, td{
					border: 1px solid black;
					}
			th, td{
					text-align: center;
			}
			tr:nth-child(even) {
					background-color: #f2f2f2;
			}
			th {
					 background-color: #4CAF50;
					 color: white;
			}
			h2{
				padding: 40px;
				text-align: center;
				background: #659DBD;
				color: white;
				font-size: 30px;
			}
			.content{
				display: flex;
				align-items: left;
				padding-left: 600px;
				padding-right: 50px;
			}
			button{
				background-color: #white;
				font-size: 16px;
				border-radius: 12px;
				border: 2px solid black;
				-webkit-transition-duration: 0.4s; /* Safari */
				transition-duration: 0.4s;
			}
			button:hover{
				background-color: #4CAF50; /* Green */
				color: white;
			}
			.button{
				text-align:center;
			}
			label {
			  display: inline-block;
			  width: 90px;
			  text-align: right;
			}

			input,
			textarea {
			  font: 1em sans-serif;
			  width: 300px;
			  box-sizing: border-box;
			  border: 1px solid #999;
			}
			input:focus,
			textarea:focus {
			  border-color: #000;
			}
			textarea {
			  vertical-align: top;
			  height: 5em;
			}
		</style>
	</head>

	<body>
		<div class="header">
			<h2>
			<?php
				echo $movieTitle;
			?>
			</h2>
		</div>
			<div class="content">
				<video width="240" height="320" poster="<?php echo $movieImage; ?>" controls>
					<source src="<?php echo $video; ?>" type="video/mp4">
				</video>
				<?php
					echo "<br>";
					echo "Genre: " . $movieGenre;
					echo "<br>";
					echo "MPAA Rating: " . $movieRating;
					echo "<br>";
					echo "Runtime: " .$movieRuntime;
					echo "<br>";
					echo "Release Date: " .$movieDate;
					echo "<br><br>";
					echo "Description: " .$movieDescription;
					echo "<br><br>";
				?>
			</div>
		<div class="reviews" align="center">
			<?php
			$con = new mysqli("localhost","root","distweb", "distweb");
	        if ($con == false) {
	            die("ERROR: Could not connect. " .mysqli_connect_error());
	        }

	        $sql = "SELECT * FROM Review WHERE reviewID IN (SELECT reviewID FROM movie_review WHERE movieID='". $movieID ."')";
	        $res = mysqli_query($con, $sql) or die('error with query');
	        if(true){
						echo "<br><br><br>";
	            if(mysqli_num_rows($res) > 0 ){
	                        echo "<table><tr><th>User</th><th>Rating</th><th>Review</th><th>Date Reviewed</th></tr>";
	                while($row = mysqli_fetch_array($res)){
	                    echo "<tr>
				<td>". $row['username']. "</td>
				<td>". $row['rating']. "</td>
				<td>". $row['review']. "</td>
				<td>". $row['date_reviewed']. "</td>
				</tr>";
	                    }
	                echo "</table>";

	                }
	           else {
	            echo "No matching records are found.";
	                }
	            }
	        else {
	             echo "ERROR: Could not able to execute $sql. ";
	           }
	        mysqli_close($con);
	        ?>
		</div>
		<br><br>

		<form method="POST" align="center">
			<div>
				<label for="rating">Rating (1-5): </label>
				<input required type="text" id="rating" name="rating">
			</div>
			<div>
				<label for="review">Review:</label>
				<textarea required id="review" name="review" font="1em sans-serif" width="300px" box-sizing="border-box"></textarea>
			</div>
				<input type="hidden" name="insert" value="true">
				<button type="submit" class="btn" name="Add_Review">Add Review</button>
			<!-- <input type="submit" name="insertMovie" value="Add Review" class="btn btn-success" text-align="center"/> -->
		</form>

		<br>
		<div class="button">
			<button onclick="window.location.href='homepage.php'">Return Home</button>
		</div>
	</body>
</html>