<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <title>Movie Review</title>
        <style>
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
    </body>
</html>