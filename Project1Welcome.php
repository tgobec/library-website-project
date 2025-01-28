<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Project1Login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="Project1BookSearch.php" class="btn btn-danger">Look for a book in our colection</a>  <a href="Project1BorrowReturn.php" class="btn btn-danger">Borrow or returna a book</a>  <a href="Project1UserSearch.php" class="btn btn-danger">Find other users</a>  <a href="Project1AddBook.php" class="btn btn-danger">Add a book to the colection</a>  <a href="Project1WhatIsBeingRead.php" class="btn btn-danger">Take a look at what is being read in a particular country</a>
    </p>
    <br>
    <br>
    <p>
        
        <a href="Project1Logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>