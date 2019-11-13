<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial;
            }
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            }
        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
            }
        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
            }
        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
            }
        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
            }
            table {
                  border-collapse: collapse;
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
    </style>
</head>
    <body>
        <h1>
            <center>Rate These Titles</center>
        </h1>

        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'movies')">Movies</button>
            <button class="tablinks" onclick="openCity(event, 'tv')">TV Shows</button>
        </div>

        <div id="movies" class="tabcontent">
            <h3>Movies</h3>
            <p>IT</P>
            <?php
				$con = new mysqli("localhost","root","student", "testdb");
        if ($con == false) {
            die("ERROR: Could not connect. " .mysqli_connect_error());
        }
        else {
          echo "connected succesfully<br>";
        }

        $sql = "SELECT * FROM Review WHERE reviewID IN (SELECT reviewID FROM movie_review WHERE movieID='1')";
        //$sql = "SELECT * FROM `movie`";
        echo $sql;
        echo "<br>";
        $res = mysqli_query($con, $sql) or die('error with query');
        if(true){
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

        echo "<br>query should have printed";
        mysqli_close($con);
        //$con->close();
            ?>
        </div>

        <div id="tv" class="tabcontent">
            <h3>TV Shows</h3>
            <p>Rate these shows.</p>
        </div>

        <script>
            function openCity(evt, cityName) {
              var i, tabcontent, tablinks;
              tabcontent = document.getElementsByClassName("tabcontent");
              for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
              }
              tablinks = document.getElementsByClassName("tablinks");
              for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
              }
              document.getElementById(cityName).style.display = "block";
              evt.currentTarget.className += " active";
            }
        </script>
    </body>
</html>