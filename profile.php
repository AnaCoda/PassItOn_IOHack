<!DOCTYPE html>
<html lang="en">
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
    <a class="navbar-brand" href="index.php"><img src="images/PIOLogoOnly.png" width="50" height="50" alt="">   Pass It On > Profile</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Profile<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="requestHelp.php">Request Help</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="requestsStream.php">Requests Stream</a>
            </li>
        </ul>
    </div>
    <div class="navbar-nav ml-auto"><img src="images/notificationBell.png" width="30" height="30" alt=""></div>
</nav>
    <?php
        session_start(); // Access session variables for login
        //Make sure they're logged in, otherwise redirect.
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $curLink = mysqli_connect("localhost", "root", "SOMEPASSWORD", "passiton_db") or die(printf(mysqli_error())); // Connect to database server(localhost) with username and password.
            $search = $curLink->query("SELECT * FROM users WHERE id='".$_SESSION['id']."'") or die(mysql_error()); 
            while($row = mysqli_fetch_assoc($search)) {
                $email = $row['email'];
            }   // Get their email to display it on the page
            $searchP = $curLink->query("SELECT * FROM profiles WHERE id='".$_SESSION['id']."'") or die(mysql_error());
            // Get their other information from a query
            while($row = mysqli_fetch_assoc($searchP)) {
                $subjects = $row['subjects'];
                $name = $row['name'];
                $grade = $row['grade'];
            }
        }
        else
        {
            header("Location: login.php"); // Redirect to the login page
        }
        // If they decided to change their display name
        if(isset($_POST['cName']) && !empty($_POST['cName']))
        {
            // Prevent SQL injection
            $name = $curLink->real_escape_string($_POST['cName']);
            // Update the user's row in the database with the new name
            $curLink->query("UPDATE profiles SET name = '$name' WHERE id = '".$_SESSION['id']."'") or die(mysqli_error($curLink));
            $_SESSION['name'] = $name;
        }
        // If they decided to change their grade
        if(isset($_POST['grade']) && !empty($_POST['grade']))
        {
            $grade = $_POST['grade'];
            // Update their grade in the database
            $curLink->query("UPDATE profiles SET grade = '$grade' WHERE id = '".$_SESSION['id']."'") or die(mysqli_error($curLink));
        }
        // If they decided to update the subjects they can teach
        if(isset($_POST['subSelect']) && !empty($_POST['subSelect']))
        {
            // Start with an empty string
            $subjects = '';
            // For each selected option, concatenate the digit of the option to $subjects
            foreach ($_POST['subSelect'] as $selectedOption)
                $subjects .= $selectedOption;
            $_SESSION['subjects'] = $subjects;
            // Update the database with this string
            $curLink->query("UPDATE profiles SET subjects = '".$subjects."' WHERE id = '".$_SESSION['id']."'") or die(mysqli_error($curLink));
        }
    ?>
    <body>
        <br><br>
        <div class="container">
            <div class="row">
                <!-- left column TODO: functional profile picture selection -->
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="//placehold.it/100" class="avatar img-circle" alt="avatar" />
                        <h6>Upload a different photo...</h6>

                        <input type="file" class="form-control" />
                    </div>
                </div>

                <!-- edit form column -->
                <div class="col-md-9 personal-info">
                    <h3>Your Profile</h3>

                    <form class="form-horizontal" role="form" autocomplete="off" method="post" action="">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Name:</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="text" name="cName" value="<?= $name ?>" placeholder="Your name"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="text" value="<?= $email ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Grade:</label>
                            <div class="col-lg-8">
                                <div class="ui-select">
                                    <select name="grade" id="user_time_zone" class="form-control">
                                        <option value="8" <?php if (strpos($grade, '8') !== false) { echo ' selected'; }?>>8</option>
                                        <option value="9" <?php if (strpos($grade, '9') !== false) { echo ' selected'; }?>>9</option>
                                        <option value="10" <?php if (strpos($grade, '10') !== false) { echo ' selected'; }?>>10</option>
                                        <option value="11" <?php if (strpos($grade, '11') !== false) { echo ' selected'; }?>>11</option>
                                        <option value="12" <?php if (strpos($grade, '12') !== false) { echo ' selected'; }?>>12</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Not sure if this is useful, but maybe for the future when you can add friends and see if their time is reasonable -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Time Zone:</label>
                            <div class="col-lg-8">
                                <div class="ui-select">
                                    <select id="user_time_zone" class="form-control">
                                        <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                        <option value="Alaska">(GMT-09:00) Alaska</option>
                                        <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                        <option value="Arizona">(GMT-07:00) Arizona</option>
                                        <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                        <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                        <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                        <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Multi select searchable subject selection -->
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Subjects you know:</label>
                            <div class="col-lg-8">
                                <select class="selectpicker w-auto" multiple="multiple" name="subSelect[]" multiple data-live-search="true">
                                <optgroup label="Math">
                                        <option value="1" <?php if (strpos($subjects, '1') !== false) { echo ' selected'; }?>>Trigonometry</option>
                                        <option value="2" <?php if (strpos($subjects, '2') !== false) { echo ' selected'; }?>>Calculus</option>
                                        <option value="3" <?php if (strpos($subjects, '3') !== false) { echo ' selected'; }?>>Algebra</option>
                                    </optgroup>

                                    <optgroup label="Languages">
                                        <option value="4" <?php if (strpos($subjects, '4') !== false) { echo ' selected'; }?>>English</option>
                                        <option value="5" <?php if (strpos($subjects, '5') !== false) { echo ' selected'; }?>>French</option>
                                    </optgroup>

                                    <optgroup label="Sciences">
                                        <option value="6" <?php if (strpos($subjects, '6') !== false) { echo ' selected'; }?>>Physics</option>
                                        <option value="7" <?php if (strpos($subjects, '7') !== false) { echo ' selected'; }?>>Chemistry</option>
                                        <option value="8" <?php if (strpos($subjects, '8') !== false) { echo ' selected'; }?>>Biology</option>
                                    </optgroup>
                                    <optgroup label="Other">
                                        <option value="9" <?php if (strpos($subjects, '9') !== false) { echo ' selected'; }?>>Computer Science</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Username:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="<?= $_SESSION['username'] ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-primary" value="Save Changes" />
                                <span></span>
                                <input type="button" class="btn btn-default" value="Cancel" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr />
    </body>
</html>
