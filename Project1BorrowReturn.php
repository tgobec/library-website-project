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
        <title>Borrow or return books</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            body{ font: 14px sans-serif; text-align: center; }
        </style>
    </head>
    
    <body>
        
        
        <h1>Borrow a book</h1>
        <form name="BorrowABook" action="Project1BorrowReturn.php" method="post">
            Title:<input type="text" id="TitleBorrow" name="TitleBorrow">
            <br>
            Author:<input type="text" id="AuthorBorrow" name="AuthorBorrow">
            <br>
            Please fill out all fields in this form to borrow a book.
            <br>
            <input type="submit" value="Borrow">
        </form>
        <?php
        $BookTitleBorrow = " WHERE Title='" . $_POST["TitleBorrow"] . "'";
        $BookAuthorBorrow = " AND Author='" . $_POST["AuthorBorrow"] . "' ";
        
        if($BookTitleBorrow == " WHERE Title=''"){
            $BookTitleBorrow = "This string fixes the bug";
        }
        
        $date = date('Y-m-d');
        $DoDate = date('Y-m-d', strtotime('+1 months'));
        $user = htmlspecialchars($_SESSION["username"]);
        
        ///echo "UPDATE `knjiga` SET `Returned`= '" . $date . "',`BorrowerUsername`= NULL,`CopiesRemaining`=`CopiesRemaining`+1 " . $BookTitle . $BookAuthor;
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
        
        $sql = "UPDATE `knjiga` SET Borrowed= '" . $date . "', Returned= NULL, BorrowerUsername= '" . $user . "', CopiesRemaining= CopiesRemaining-1 " . $BookTitleBorrow . $BookAuthorBorrow;

        if ($conn->multi_query($sql) === TRUE) {
            echo "The book ahs been borrowed to you. Please return the booky by " . $DoDate . ", at the latest.";
        } else {
            echo "There was an error in processing that request, please check if all fields are filled out properly.";
        }
        
        mysqli_close($conn);
        ?>
        
        <h1>Return a book</h1>
        <form name="Returns" action="Project1BorrowReturn.php" method="post">
            Title:<input type="text" id="TitleReturn" name="TitleReturn">
            <br>
            Author:<input type="text" id="AuthorReturn" name="AuthorReturn">
            <br>
            Please fill out all fields in this form to return a book.
            <br>
            <input type="submit" value="Return">
        </form>
        <?php
        $BookTitle = " WHERE Title='" . $_POST["TitleReturn"] . "'";
        $BookAuthor = " AND Author='" . $_POST["AuthorReturn"] . "' ";
        
        if($BookTitle == " WHERE Title=''"){
            $BookTitle = "This string fixes the bug";
        }
        
        $date = date('Y-m-d');        
        
        ///echo "UPDATE `knjiga` SET `Returned`= '" . $date . "',`BorrowerUsername`= NULL,`CopiesRemaining`=`CopiesRemaining`+1 " . $BookTitle . $BookAuthor;
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
        
        $sql = "UPDATE `knjiga` SET Returned= '" . $date . "', Borrowed= NULL, BorrowerUsername= NULL, CopiesRemaining= CopiesRemaining+1 " . $BookTitle . $BookAuthor;

        if ($conn->multi_query($sql) === TRUE) {
            echo "The book has been returned.";
        } else {
            echo "There was an error in processing that request, please check if all fields are filled out properly.";
        }
        
        mysqli_close($conn);
        ?>
        
        <h1>Search the collection</h1>
        <form name="BookSearch" action="Project1BorrowReturn.php" method="post">
            Title:<input type="text" id="Title" name="Title">
            <br>
            Author:<input type="text" id="Author" name="Author">
            <br>
            Genre:<input type="text" id="Genre" name="Genre">
            <br>
            Borrowed from <input type="date" id="DateOfBorrowing" name="DateOfBorrowing" value="<?php date('Y-m-d'); ?>" /> till <input type="date" id="DateOfReturning" name="DateOfReturning" value="<?php date('Y-m-d'); ?>" />
            <br>
            Avalable for borrowing: <input type="checkbox" name="Borrowed" id="Borrowed" value="Borrowed">
            <br>
            <input type="submit" value="Search">
        </form>
        <br>
        <br>
        <p>
            <a href="Project1Welcome.php" class="btn btn-danger">Return to menu</a>
            <a href="Project1Logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>
        <?php
        ///Code that creates the SQL query, automatically throwing out / replacing empty variables ///
        
        $Title = " WHERE Title='" . $_POST["Title"] . "' ";
        $Author = " AND Author='" . $_POST["Author"] . "' ";
        $Genre = " AND Genre='" . $_POST["Genre"] . "' ";
        $DateOfBorrowing = " AND Borrowed>='" . $_POST["DateOfBorrowing"] . "' ";
        $DateOfReturning = " AND Returned<='" . $_POST["DateOfReturning"] . "' ";
        $IsBarrowed = " ";
               
        if ($Title==" WHERE Title='' "){
            $Title = ' ';
            $Author = " WHERE Author='" . $_POST["Author"] . "' ";
        }
        
        if ($Author==" AND Author='' " or $Author==" WHERE Author='' "){
            $Author = ' ';
        }
        if ($Author==" " and $Title == " "){
            $Genre = " WHERE Genre='" . $_POST["Genre"] . "' ";
        }
        if ($Genre==" AND Genre='' " or $Genre==" WHERE Genre='' "){
            $Genre = ' ';
        }
        if ($Author==" " and $Title == " " and $Genre == " "){
            $DateOfBorrowing = " WHERE Borrowed>='" . $_POST["DateOfBorrowing"] . "' ";
        }
        if ($DateOfBorrowing==" AND Borrowed>='' " or $DateOfBorrowing==" WHERE Borrowed>='' "){
            $DateOfBorrowing = ' ';
        }
        if ($Author==" " and $Title == " " and $Genre == " " and $DateOfBorrowing == " "){
            $DateOfReturning = " WHERE Returned<='" . $_POST["DateOfReturning"] . "' ";
        }
        if ($DateOfReturning==" AND Returned<='' " or $DateOfReturning==" WHERE Returned<='' "){
            $DateOfReturning = ' ';
        }
        if($_POST["Borrowed"] == "Borrowed"){
            $IsBarrowed = " AND Borrowed IS NULL";
        }
        ///echo $IsBarrowed;
        
        if ($Author==" " and $Title == " " and $Genre == " " and $DateOfBorrowing == " " and $DateOfReturning == " " and $_POST["Borrowed"] == "Borrowed"){
            $IsBarrowed = ' WHERE Borrowed IS NULL';
        }
        
        ///Print test to check where the code is bugging out:///
        ///echo $Title . $Author . $Genre . $DateOfBorrowing . $DateOfReturning . $IsBarrowed;///
        
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
        $sql = "SELECT * FROM knjiga" . $Title . $Author . $Genre . $DateOfBorrowing . $DateOfReturning  . $IsBarrowed;
        $result = $conn->query($sql);
        
        
        ///Print Table///
        if ($result->num_rows > 0) {
            echo "<table align='center' border='1px' style='text-align:center; width:900px; line-height:40px;'><tr><th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>Thoughts</th>
            <th>Borrowed on</th>
            <th>Returned on</th>
            <th>BWho has the Book</th>
            <th>Copies Remaining</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>".$row["ID"]."</td>
                <td>".$row["Title"]."</td>
                <td>".$row["Author"]."</td>
                <td>".$row["Genre"]."</td>
                <td>".$row["Rating"]."</td>
                <td>".$row["Thoughts"]."</td>
                <td>".$row["Borrowed"]."</td>
                <td>".$row["Returned"]."</td>
                <td>".$row["BorrowerUsername"]."</td>
                <td>".$row["CopiesRemaining"]."</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "There exist no books with such descriptors in our collection. Please check if every paramater was properly given.";
        }
        $conn->close();
        ?>
    </body>
</html>