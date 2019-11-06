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
            $con = new mysqli("127.0.0.1", "root", "366Andr!dge", "mydb");
            $sql = "SELECT reviewID, user, rating, review, date_reviewed FROM Review WHERE reviewID IN (SELECT reviewID FROM Movie_Review WHERE movieID=\"1\")";
            $results = $con->query($sql);

            if($results->num_rows>0){
                echo "<table><tr><th>User</th><th>Rating</th><th>Review</th><th>Date Reviewed</th></tr>";
                while($row = $results->fetch_assoc()){
                    echo "<tr><td>". $row['user']. "</td><td>". $row['rating']. "</td><td>". $row['review']. "</td><td>". $row['date_reviewed']. "</td></tr>";
                    }
                echo "</table>";
                }
            $con->close();
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