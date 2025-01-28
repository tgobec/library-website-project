<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Project1Login.php");
    exit;
}
error_reporting(E_ERROR | E_PARSE);
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>User Search</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            body{ font: 14px sans-serif; text-align: center; }
        </style>
    </head>
    <body>
        <h1>Search for users</h1>
        <form name="UserSearch" action="Project1WhatIsBeingRead.php" method="post">
            Country where you would like to see what is being read:<input type="text" id="Zemlja" name="Zemlja">
            <br>
            <input type="submit" value="What is being read?">
        </form>
        <br>
        <br>
        <p>
            <a href="Project1Welcome.php" class="btn btn-danger">Return to menu</a>
            <a href="Project1Logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>
        <?php
        ///Code that creates the SQL query, automatically throwing out / replacing empty variables ///
        
        
        $Zemlja = " WHERE Zemlja='" . $_POST["Zemlja"] . "' ";
        
        if ($Zemlja == " WHERE Zemlja='' "){
            $Zemlja = ' ';
        }
        ///Print test to check where the code is bugging out:///
        ///echo $Ime . $Prezime . $DOB . $POR . $SOA . $Area . $Username;///
        
        ///End of SQL Query creation///
        
        ///Conecting to the MySQL DB///
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project1";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        ///End of connection code///
        
        
        ///Query set up///
        $sql = "SELECT users.Zemlja, knjiga.Title, knjiga.Author FROM users INNER JOIN knjiga ON users.username = knjiga.BorrowerUsername" . $Zemlja;
        $result = $conn->query($sql);
        
        
        ///Print Table///
        if ($result->num_rows > 0) {
            echo "<table align='center' border='1px' style='text-align:center; width:900px; line-height:40px;'><tr><th>Book Title</th>
            <th>Book Author</th>
            <th>Country where it has been barrowed</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>".$row["Title"]."</td>
                <td>".$row["Author"]."</td>
                <td>".$row["Zemlja"]."</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "No users have been found from that country. Please check if the data has been entered properly.";
        }
        $conn->close();
        ?>
    </body>
</html>