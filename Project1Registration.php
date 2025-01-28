<?php
// Include config file
require_once "Project1Config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password  = $mail = $ime = $prezime = $datumr = $zemlja= $adresa = $skola = $smjer =  "";

$username_err = $password_err = $confirm_password_err = $mail_err = $ime_err = $prezime_err = $datumr_err = $zemlja_err= $adresa_err = $skola_err = $smjer_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
	
	
 // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	

	    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	
	
	
	// Validate Mail
    if(empty(trim($_POST["mail"]))){
        $mail_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE Mail = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_mail);
            
            // Set parameters
            $param_mail = trim($_POST["mail"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $mail_err = "This mail is already used.";
                } else{
                    $mail = trim($_POST["mail"]);
                }
            } else{
                echo "Oops! Something went wrong with mail. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	
	
	
		// Validate Ime
    if(empty(trim($_POST["ime"]))){
        $ime_err = "Please enter your name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE Ime = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_ime);
            
            // Set parameters
            $param_ime = trim($_POST["ime"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $ime = trim($_POST["ime"]);
                
            } else{
                echo "Oops! Something went wrong with name. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
			// Validate Prezime
    if(empty(trim($_POST["prezime"]))){
        $prezime_err = "Please enter your last name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE Prezime = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_prezime);
            
            // Set parameters
            $param_prezime = trim($_POST["prezime"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $prezime = trim($_POST["prezime"]);
                
            } else{
                echo "Oops! Something went wrong last name. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	
	
	
	
	// Validate datum rođenja
    if(empty(trim($_POST["datumr"]))){
        $datumr_err = "Please enter your date of birth.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE DatumRođenja = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_datumr);
            
            // Set parameters
            $param_datumr = trim($_POST["datumr"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $datumr = trim($_POST["datumr"]);
                
            } else{
                echo "Oops! Something went wrong with the date. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	// Validate Adresa
    if(empty(trim($_POST["zemlja"]))){
        $zemlja_err = "Please your country.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE Zemlja = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_zemlja);
            
            // Set parameters
            $param_zemlja = trim($_POST["zemlja"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $zemlja = trim($_POST["zemlja"]);
                
            } else{
                echo "Oops! Something went wrong with the adress. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	
	
	
	// Validate Adresa
    if(empty(trim($_POST["adresa"]))){
        $adresa_err = "Please your adress.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE Adresa = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_adresa);
            
            // Set parameters
            $param_adresa = trim($_POST["adresa"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $adresa = trim($_POST["adresa"]);
                
            } else{
                echo "Oops! Something went wrong with the adress. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	
	
	// Validate skola
    if(empty(trim($_POST["skola"]))){
        $skola_err = "Please your School.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE Skola = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_skola);
            
            // Set parameters
            $param_skola = trim($_POST["skola"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $skola = trim($_POST["skola"]);
                
            } else{
                echo "Oops! Something went wrong with the school. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	
	// Validate smjer
    if(empty(trim($_POST["smjer"]))){
        $smjer_err = "Please your smjer.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE Smjer = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_smjer);
            
            // Set parameters
            $param_smjer = trim($_POST["smjer"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $smjer = trim($_POST["smjer"]);
                
            } else{
                echo "Oops! Something went wrong with the smjer. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

    
	
	

	
	
	
	
    

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, Mail, Ime, Prezime, DatumRođenja, Zemlja, Adresa, Skola, Smjer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_username, $param_password, $param_mail, $param_ime, $param_prezime, $param_datumr, $param_zemlja, $param_adresa, $param_skola, $param_smjer);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
			$param_mail = $mail;
			$param_ime = $ime;
			$param_prezime =$prezime;
			$param_datumr = $datumr;
			$param_zemlja = $zemlja;
			$param_adresa = $adresa;
			$param_skola = $skola;
			$param_smjer = $smjer;
			
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: Project1Login.php");
            } else{
                echo "Something went wrong with cheking inputs. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
			<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            
			<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            
			<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
			 
			<div class="form-group <?php echo (!empty($mail_err)) ? 'has-error' : ''; ?>">
                <label>E-mail</label>
                <input type="email" name="mail" class="form-control" value="<?php echo $mail; ?>">
                <span class="help-block"><?php echo $mail_err; ?></span>
            </div>
			
			
			
			
			<div class="form-group"<?php echo (!empty($ime_err)) ? 'has-error' : ''; ?>>
                <label>Ime</label>
                <input type="text" name="ime" class="form-control" value="<?php echo $ime; ?>">
                <span class="help-block"><?php echo $ime_err; ?></span>
            </div>
			
			<div class="form-group <?php echo (!empty($prezime_err)) ? 'has-error' : ''; ?>">
                <label>Prezime</label>
                <input type="text" name="prezime" class="form-control" value="<?php echo $prezime; ?>">
                <span class="help-block"><?php echo $prezime_err; ?></span>
            </div>
			
			<div class="form-group <?php echo (!empty($datumr_err)) ? 'has-error' : ''; ?>">
                <label>Datum rođenja</label>
                <input type="date" name="datumr" class="form-control" value="<?php  echo $datumr;  ?>">
                <span class="help-block"><?php echo $datumr_err; ?></span>
            </div>
			
			<div class="form-group <?php echo (!empty($zemlja_err)) ? 'has-error' : ''; ?>">
                <label>Zemlja</label>
                <input type="text" name="zemlja" class="form-control" value="<?php echo $zemlja; ?>">
                <span class="help-block"><?php echo $zemlja_err; ?></span>
            </div>
			
			
			<div class="form-group <?php echo (!empty($adresa_err)) ? 'has-error' : ''; ?>">
                <label>Adresa</label>
                <input type="text" name="adresa" class="form-control" value="<?php echo $adresa; ?>">
                <span class="help-block"><?php echo $adresa_err; ?></span>
            </div>
			
			
			
			<div class="form-group <?php echo (!empty($skola_err)) ? 'has-error' : ''; ?>">
                <label>Škola/Faks</label>
                <input type="text" name="skola" class="form-control" value="<?php echo $skola; ?>">
                <span class="help-block"><?php echo $skola_err; ?></span>
            </div>
			
			<div class="form-group <?php echo (!empty($smjer_err)) ? 'has-error' : ''; ?>">
                <label>Smjer</label>
                <input type="text" name="smjer" class="form-control" value="<?php echo $smjer; ?>">
                <span class="help-block"><?php echo $smjer_err; ?></span>
            </div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
            
			<div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="Project1Login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>