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
        <form name="UserSearch" action="Project1UserSearch.php" method="post">
            First name:<input type="text" id="Name" name="Name">
            <br>
            Last name:<input type="text" id="LName" name="LName">
            <br>
            Date of birth:<input type="date" id="DOB" name="DOB">
            <br>
            Country of residance:<input type="text" id="PoR" name="PoR">
            <br>
            School of atendance:<input type="text" id="SoA" name="SoA">
            <br>
            Field of study:<input type="text" id="FieldOfStudy" name="FieldOfStudy">
            <br>
            Username:<input type="text" id="Username" name="Username">
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
        
        
        $Ime = " WHERE Ime='" . $_POST["Name"] . "' ";
        $Prezime = " AND Prezime='" . $_POST["LName"] . "' ";
        $DOB = " AND DatumRođenja='" . $_POST["DOB"] . "' ";
        $POR = " AND Zemlja='" . $_POST["PoR"] . "' ";
        $SOA = " AND Skola='" . $_POST["SoA"] . "' ";
        $Area = " AND Smjer='" . $_POST["FieldOfStudy"] . "' ";
        $Username = " AND username='" . $_POST["Username"] . "' ";
        
        if ($Ime == " WHERE Ime='' "){
            $Ime = ' ';
            $Prezime = " WHERE Prezime='" . $_POST["LName"] . "' ";
        }
        if ($Prezime==" AND Prezime='' " or $Prezime==" WHERE Prezime='' "){
            $Prezime = ' ';
        }
        if ($Prezime==" " and $Ime == " "){
            $DOB = " WHERE DatumRođenja='" . $_POST["DOB"] . "' ";
        }
        if ($DOB==" AND DatumRođenja='' " or $DOB==" WHERE DatumRođenja='' "){
            $DOB = ' ';
        }
        if ($Prezime==" " and $Ime == " " and $DOB == " "){
            $POR = " WHERE Zemlja='" . $_POST["PoR"] . "' ";
        }
        if ($POR==" AND Zemlja='' " or $POR==" WHERE Zemlja='' "){
            $POR = ' ';
        }
        if ($Prezime==" " and $Ime == " " and $DOB == " " and $POR == " "){
            $SOA = " WHERE Skola='" . $_POST["SoA"] . "' ";
        }
        if ($SOA==" AND Skola='' " or $SOA==" WHERE Skola='' "){
            $SOA = ' ';
        }
        if ($Prezime==" " and $Ime == " " and $DOB == " " and $POR == " " and $SOA == " "){
            $Area = " WHERE Smjer='" . $_POST["FieldOfStudy"] . "' ";
        }
        if ($Area==" AND Smjer='' " or $Area==" WHERE Smjer='' "){
            $Area = ' ';
        }
        if ($Prezime==" " and $Ime == " " and $DOB == " " and $POR == " " and $SOA == " " and $Area == " "){
            $Username = " WHERE username='" . $_POST["Username"] . "' ";
        }
        if ($Username==" AND username='' " or $Username==" WHERE username='' "){
            $Username = ' ';
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
        $sql = "SELECT `ID`, `username`, `Ime`, `Prezime`, `DatumRođenja`, `Zemlja`, `Skola`, `Smjer`, `Created_at` FROM `users`" . $Ime . $Prezime . $DOB . $POR . $SOA . $Area . $Username;
        $result = $conn->query($sql);
        
        
        ///Print Table///
        if ($result->num_rows > 0) {
            echo "<table align='center' border='1px' style='text-align:center; width:900px; line-height:40px;'><tr><th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Country of Residance</th>
            <th>School of Adendance</th>
            <th>Field of Study</th>
            <th>Account created on</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>".$row["ID"]."</td>
                <td>".$row["username"]."</td>
                <td>".$row["Ime"]."</td>
                <td>".$row["Prezime"]."</td>
                <td>".$row["DatumRođenja"]."</td>
                <td>".$row["Zemlja"]."</td>
                <td>".$row["Skola"]."</td>
                <td>".$row["Smjer"]."</td>
                <td>".$row["Created_at"]."</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "The user you are looking for does not exist in our registry, please check if the data you have entered is correct.";
        }
        $conn->close();
        ?>
    </body>
</html>