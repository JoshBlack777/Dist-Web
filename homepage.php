<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial;
            background-color: #FBEEC1;
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
            width: 60%;
            background-color: #F2F2F2;
            }
        table, th, td{
            border: 1px solid black;
            }
        th, td{
            text-align: left;
            padding-left: 15px;
        }
        th:nth-child(1){
          text-align: center;
          padding-top: 10px;
          padding-bottom: 10px;
        }
        h3 {
          padding: 40px;
          text-align: center;
          background: #659DBD;
          color: white;
          font-size: 30px;
        }
        th:nth-child(3){
          text-align: center;
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
    </style>
</head>
    <body>
        <h1>
            <center>5 Star Reviews</center>
        </h1>

        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'movies')">Movies</button>
            <button class="tablinks" onclick="openCity(event, 'tv')">TV Shows</button>
        </div>

        <!-- movie tab starts here -->
        <div id="movies" class="tabcontent">
            <h3>Movies</h3>
            <table align="center">
              <?php
              $con = new mysqli("localhost","root","distweb", "distweb");
              if ($con == false) {
                  die("ERROR: Could not connect. " .mysqli_connect_error());
              }

              $sql = "SELECT * FROM movie ORDER BY movie_name ASC";
              $res = mysqli_query($con, $sql) or die('error with query');
              if(mysqli_num_rows($res) > 0){
                while($row = mysqli_fetch_array($res)){
                  echo "<tr><th><img src='". $row['movie_name'] .".jpg'/></th><th>";
                  echo "Movie: ". $row['movie_name']
                    ."<br><br>Genre: ". $row['genre']
                    ."<br><br>Rating: ". $row['mpaa_rating']
                    ."<br><br>Runtime: ". $row['runtime']
                    ."<br><br>Release Date: ". $row['release_date'] ."</th>";
                  echo "<th><button onclick=\"window.location.href='movie.php?movieID=". $row['movieID']
                    ."'\">See Reviews</button></th></tr>";
                }
              }
              ?>
            </table>
        </div>

        <!-- tv tab starts here -->
        <div id="tv" class="tabcontent">
            <h3>TV Shows</h3>
            <table align="center">
              <?php
              $con = new mysqli("localhost","root","distweb", "distweb");
              if ($con == false) {
                  die("ERROR: Could not connect. " .mysqli_connect_error());
              }

              $sql = "SELECT * FROM tv ORDER BY name ASC";
              $res = mysqli_query($con, $sql) or die('error with query');
              if(mysqli_num_rows($res) > 0){
                while($row = mysqli_fetch_array($res)){
                  echo "<tr><th><img src='". $row['name'] .".jpg'/></th><th>";
                  echo "Title: ". $row['name']
                    ."<br><br>Genre: ". $row['genre']
                    ."<br><br>Rating: ". $row['esrb_rating']
                    ."<br><br>Release Date: ". $row['release_date']
                    ."<br><br>Seasons: ". $row['seasons']
                    ."<br><br>Episodes: ". $row['episodes']
                    ."<br><br>On Air: ". $row['on_going'] ."</th>";
                  echo "<th><button onclick=\"window.location.href='tv.php?tv_showID=". $row['tv_showID']
                    ."'\">See Reviews</button></th></tr>";
                }
              }
              ?>
            </table>
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
