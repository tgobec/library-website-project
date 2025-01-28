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
        <title>Add a book</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            body{ font: 14px sans-serif; text-align: center; }
        </style>
    </head>
    
    <body>
        <h1>Add a book</h1>
        <form name="UserSearch" action="Project1AddBook.php" method="post">
            Title:<input type="text" id="TitleAdd" name="TitleAdd">
            <br>
            Author:<input type="text" id="AuthorAdd" name="AuthorAdd">
            <br>
            Genre:<input type="text" id="GenreAdd" name="GenreAdd">
            <br>
            Rating from 1-10:<input type="number" id="RatingAdd" name="RatingAdd">
            <br>
            Thoughts on the book:<input type="text" id="ThoughtsAdd" name="ThoughtsAdd">
            <br>
            All Fields are reqiered to be filled out
            <br>
            <input type="submit" value="Insert Into Database">
        </form>
        <br>
        <br>
        <p>
            <a href="Project1Welcome.php" class="btn btn-danger">Return to menu</a>
            <a href="Project1Logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>
        <?php
        $TitleInsert = "'" . $_POST["TitleAdd"] . "'";
        $AuthorInsert = "'" . $_POST["AuthorAdd"] . "'";
        $GenreInsert = "'" . $_POST["GenreAdd"] . "'";
        $Rating = $_POST["RatingAdd"];
        $ThoughtsInsert = "'" . $_POST["ThoughtsAdd"] . "'";
        
        
        ///echo "INSERT INTO `knjiga`(`Title`, `Author`, `Genre`, `Rating`, `Thoughts`, `CopiesRemaining`) VALUES (" . $TitleInsert . ", " . $AuthorInsert . ", " . $GenreInsert . ", " . $Rating . ", " . $ThoughtsInsert . ");";
        
        ///----------------------------------------///
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
        
        $sql = "INSERT INTO `knjiga`(`Title`, `Author`, `Genre`, `Rating`, `Thoughts`, `Borrowed`, `Returned`, `BorrowerUsername`, `CopiesRemaining`) VALUES (" . $TitleInsert . ", " . $AuthorInsert . ", " . $GenreInsert . ", " . $Rating . ", " . $ThoughtsInsert . ", NULL, NULL, NULL, 1);";

        if ($conn->multi_query($sql) === TRUE) {
            echo "The book has been added to the database.";
        } else {
            echo "Please check if all fields have been filled out with correct data.";
        }
        
        mysqli_close($conn);
        ?>
    </body>
</html>