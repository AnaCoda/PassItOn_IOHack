<!-- This is the login page -->
<!DOCTYPE html>
<head>
<script src="javascript/PushNotificationEx.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <!-- end wrap div -->
    <script type="text/javascript">
</script>
    </head>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light"  style="background-color: #70acb1;">
        <a class="navbar-brand" href="#"><img src="images/PIOLogoOnly.png" width="50" height="50" alt="">   Pass It On > Sign Up</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sign up</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Login</a>
            </li>
        </ul>
    </div>
    
    </nav>
<body>
    </div>

    <div id="wrap">
         
        <!-- start php code -->
        <?php
        session_start(); // Access session variables for login
        // If the form is posted with the values
        if(isset($_POST['uname']) && !empty($_POST['uname']) AND isset($_POST['pass']) && !empty($_POST['pass']))
        {
            // Connect to the SQL database (for the prototype, it's being hosted locally)
            $curLink = mysqli_connect("localhost", "root", "SOMEPASSWORD", "passiton_db") or die(printf(mysqli_error())); // Connect to database server(localhost) with username and password.
            $username = $curLink->real_escape_string($_POST['uname']); // Set variable for the username (escape string to prevent injection)
            $password = $curLink->real_escape_string(md5($_POST['pass']));  // Set variable for the password and hash it
            $search = $curLink->query("SELECT * FROM users WHERE username='".$username."' AND password='".$password."'") or die(mysql_error()); 
            $match  = mysqli_num_rows($search); // Query user information so we can put them in session vars
            if($match > 0){
                $msg = 'Login Complete! Thanks';
                $_SESSION['loggedin'] = true;       // Set the session variables
                $_SESSION['username'] = $username;
                while($row = mysqli_fetch_assoc($search)) {
                    $id = $row['id'];
                }
                $_SESSION['id'] = $id;
                //$addProfile = $curLink->query("INSERT INTO profiles (id, grade, name, subjects) VALUES (") or die(mysql_error()); 
                header("Location: profile.php"); // Redirect to the profile page
            }else{
                $msg = 'Login Failed! Please make sure that you enter the correct details and that you have activated your account.';
            }
        }
                 
        ?>
        <!-- stop php code -->
     
        <!-- title and description -->   
        <br><br>
        <div class="container">
        <div class="text-center">
        <h3>Login</h3>
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
            <input type="password" name="pass" placeholder="Password" class="form-control" /><br>
             
            <input type="submit" class="submit_button btn btn-primary" value="Login" />
        </div>
        </div>
        </form>
        <!-- end sign up form -->
        </div>
        
    </div>
    
</body>
</html>