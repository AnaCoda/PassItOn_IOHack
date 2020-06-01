<!-- Form for the user to create a new help request -->
<!DOCTYPE html>
<head>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" />

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <script src="javascript/PushNotificationEx.js"></script>
        <script>
            $(".select").selectpicker("refresh");
        </script>
    </head>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #70acb1;">
	<a class="navbar-brand" href="#">
		<img src="images/PIOLogoOnly.png" width="50" height="50" alt="">Pass It On > Requests Stream</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item"> <a class="nav-link" href="profile.php">Profile</a>
			</li>
			<li class="nav-item active"> <a class="nav-link" href="#">Request Help</a>
			</li>
			<li class="nav-item"> <a class="nav-link" href="requestsStream.php">Requests Stream</a>
			</li>
		</ul>
    </div>
    <div class="navbar-nav ml-auto"><img src="images/notificationBell.png" width="30" height="30" alt=""></div>
</nav>
<body>
    </div>
    <!-- end header div -->  
     
    <!-- start wrap div -->  
    <div id="wrap">
         
        <!-- start php code -->
        <?php
        session_start();
        // Check that they're logged in, otherwise redirect
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            if(isset($_POST['subject'])) // The user submitted the form
            {
                $curLink = mysqli_connect("localhost", "root", "SOMEPASSWORD", "passiton_db") or die(printf(mysqli_error())); // Connect to database server(localhost) with username and password.
                
                // Form Submitted
                $subject = $_POST['subject'];     // Turn our posts into a local variable 
                $time = $_POST['time'];
                echo $subject;
                // Insert a new request into the database and include the user who made it and the options they selected
                $curLink->query("INSERT INTO requests (user_id, subject, estim_time) VALUES(
                    '".$_SESSION['id']."', 
                    '$subject', 
                    '$time')") or die(mysqli_error($curLink));
            }
        }
        else
        {
            header("Location: login.php"); // Redirect to the login page
        }
        ?>
        <!-- stop php code -->
     
        <!-- title and description -->   
        <br><br>
        <div class="container">
        <h3>Help Request Form</h3>
        <div class="col dform-group justify-content-center align-items-center container">
        
        <!-- start sign up form -->  
        <form class="form-horizontal" role="form" method="POST" action="" >
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Choose the subject you would like help in:</label>
                            <div class="col-lg-8">
                                <select class="selectpicker w-auto" data-live-search="true" name="subject">
                                    <optgroup label="Math">
                                        <option value="1">Trigonometry</option>
                                        <option value="2">Calculus</option>
                                        <option value="3">Algebra</option>
                                    </optgroup>

                                    <optgroup label="Languages">
                                        <option value="4">English</option>
                                        <option value="5">French</option>
                                    </optgroup>

                                    <optgroup label="Sciences">
                                        <option value="6">Physics</option>
                                        <option value="7">Chemistry</option>
                                        <option value="8">Biology</option>
                                    </optgroup>
                                    <optgroup label="Other">
                                        <option value="9">Computer Science</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">How long do you expect the lesson to take?</label>
                            <div class="col-lg-8">
                                <select class="selectpicker w-auto" name="time">
                                    <option value="1">A few minutes</option>
                                    <option value="2">Less than an hour</option>
                                    <option value="3">Around an hour</option>
                                    <option value="4">2 hours</option>
                                    <option value="5">Multiple lessons needed</option>
                                    <option value="6">Not sure</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-primary" id="subRequest" value="Submit Request" />
                                <span></span>
                            </div>
                        </div>
                    </form>
        <!-- end sign up form -->
        </div>
    </div>
    <!-- end wrap div -->
</body>
<script src="javascript/requestHelp.js"></script>
</html>