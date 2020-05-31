<!DOCTYPE html>
<head>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    </head>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light"  style="background-color: #70acb1;">
        <a class="navbar-brand" href="#"><img src="images/PIOLogoOnly.png" width="50" height="50" alt="">   Pass It On > Sign Up</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Sign up<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
        </ul>
    </div>
    </nav>
<body>
    </div>

    <div id="wrap">
         
        <!-- start php code -->
        <?php
 
        if(isset($_POST['uname']) && !empty($_POST['uname']) AND isset($_POST['email']) && !empty($_POST['email']))
        {
            // Form Submitted
            $name = $_POST['uname'];    // Turn our posts into local variables
            $email = $_POST['email'];  
            $pass = $_POST['pass'];     
            $pass2 = $_POST['pass2'];

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Return Error - Invalid Email
                $msg = 'The email you have entered is invalid, please try again.';
            }
            else
            {
                if(!(substr_compare($email, ".edu", -strlen(".edu")) === 0) && !(substr_compare($email, "educbe.ca", -strlen("educbe.ca")) === 0)) // Check if it's a known education email
                {
                    $msg = 'You must use a .edu email or other known education domain to sign up. Contact us if your school district does not use .edu emails.';
                }
                else if($pass != $pass2)
                {
                    // Return Error - Passwords do not match
                    $msg = 'The passwords you have entered do not match, please try again.';
                }
                else
                {
                    // Connect to the SQL database (for the prototype, it's being hosted locally)
                    $curLink = mysqli_connect("localhost", "root", "PASSWORD", "passiton_db") or die(printf(mysqli_error())); // Connect to database server(localhost) with username and password.
                    
                    // Prevent SQL injection
                    $name = $curLink->real_escape_string($name);
                    $email = $curLink->real_escape_string($email);
                    $pass = md5($curLink->real_escape_string($pass)); // Encrypt the password
                    // Return Success - Valid Email
                    $msg = 'Your account has been made';
                    // Insert the values into the database
                    $curLink->query("INSERT INTO users (username, password, email) VALUES(
                        '$name', 
                        '$pass', 
                        '$email')") or die(mysqli_error($curLink));
                    $search = $curLink->query("SELECT * FROM users WHERE username='".$name."'") or die(mysql_error()); 
                    while($row = mysqli_fetch_assoc($search)) {
                        $id = $row['id'];
                    }
                    $curLink->query("INSERT INTO profiles (id, grade, name, subjects) VALUES(
                        '$id', 
                        8, 
                        '',
                        0)") or die(mysqli_error($curLink));
                    header("Location: login.php"); // Redirect to the login page
                    exit;
                }
            }
        }
                 
        ?>
        <!-- stop php code -->
     
        <!-- title and description -->   
        <br><br>
        <div class="container">
        <div class="text-center">
        <h3>Signup Form</h3>
        <p>Please enter your name and email address to create your Pass It On account.<br>Please note that Pass It On is NOT a homework service.</p>
        <?php 
            if(isset($msg)){                                  // Check if $msg is not empty
                echo '<div class="statusmsg">'.$msg.'</div>'; // Display our error/success message and wrap it with a div with the class "statusmsg".
            } 
        ?>
        <!-- start sign up form -->  
        <form action="" method="post" class="form-horizontal" role="form" autocomplete="off">
        <div class="form-group d-flex justify-content-center align-items-center container">
        <div style="width:500px" class="text-center">
            <input type="text" name="uname" placeholder="Username" class="form-control" /><br>
            <input type="text" name="email" placeholder="Email" class="form-control" /><br>
            <input type="password" name="pass" placeholder="Password" class="form-control" /><br>
            <input type="password" name="pass2" placeholder="Confirm Password" class="form-control" /><br>
             
            <input type="submit" class="submit_button btn btn-primary" value="Sign up" />
        </div>
        </div>
        </form>
        <!-- end sign up form -->
        </div>
         
    </div>
    <!-- end wrap div -->
</body>
</html>