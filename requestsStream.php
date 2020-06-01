<!DOCTYPE html>
<html lang="en">

<head>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <!-- This is just to make the user cards wrap -->
    <style> 
        .card{
            display: inline-block;
        }
    </style>
</head>
<!-- navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #70acb1;">
	<a class="navbar-brand" href="index.php">
        <img src="images/PIOLogoOnly.png" width="50" height="50" alt="">Pass It On > Requests Stream</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item"> <a class="nav-link" href="profile.php">Profile</a>
			</li>
			<li class="nav-item"> <a class="nav-link" href="requestHelp.php">Request Help</a>
			</li>
			<li class="nav-item active"> <a class="nav-link" href="#">Requests Stream</a>
			</li>
		</ul>
    </div>
    <div class="navbar-nav ml-auto"><img src="images/notificationBell.png" width="30" height="30" alt=""></div>
</nav>
<?php
session_start();
// Check that they're logged in, otherwise redirect
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
}
else { header("Location: login.php"); // Redirect to the login page
}
?>
<body>
	<!-- title and description -->
	<br>
	<br>
	<div class="container justify-content-center align-items-center container">
		<div class="text-center">
			<h3>Requests Stream</h3>
            <p>These are students who are currently requesting help in a subject.</p>
            <!-- A button example of how the cards are sortable (RequestsSort.js) -->
            <input type="button" class="submit_button btn btn-primary" id="btnSort" value="Sort by time posted" />
            <!-- These are the request cards. The first three are static (for demo purposes) and the rest are generated from an SQL table using PHP -->
			<div class="" style="overflow: auto;">
				<div class="card" style="width: 400px">
					<h5 class="card-header">John Doe</h5>
					<div class="card-body">
						<h5 class="card-title">Seeking trigonometry help</h5>
						<p class="card-text">Grade <span class="grade">10<span><br>Time posted: <span class="time">60</span> minutes ago
							<br>Estimated time: 1 hour</p> <a href="chatExample.html" class="btn btn-primary">Help John Doe</a>
					</div>
				</div>
				<div class="card" style="width: 400px">
					<h5 class="card-header">Tim Buktu</h5>
					<div class="card-body">
						<h5 class="card-title">Seeking english help</h5>
						<p class="card-text">Grade <span class="grade">11<span><br>Time posted: <span class="time">30</span> minutes ago
							<br>Estimated time:
							< 1 hour</p> <a href="#" class="btn btn-primary">Help Tim Buktu</a>
					</div>
                </div>
                <div class="card" style="width: 400px">
					<h5 class="card-header">Alice Chester</h5>
					<div class="card-body">
						<h5 class="card-title">Seeking physics help</h5>
						<p class="card-text">Grade <span class="grade">9<span><br>Time posted: <span class="time">40</span> minutes ago
							<br>Estimated time:
							< 1 hour</p> <a href="#" class="btn btn-primary">Help Alice Chester</a>
					</div>
                </div>
                <?php // TODO: Option to only show cards from the subjects the user chose in their profile
                    
                    // Generate user request cards from the requests database
                    $curLink = mysqli_connect("localhost", "root", "SOMEPASSWORD", "passiton_db") or die(printf(mysqli_error())); // Connect to database server(localhost) with username and password.
                    // Get all the requests rows
                    $result = $curLink->query("SELECT * from requests") or die(mysqli_error($curLink));
                    // Go through each of them and generate the cards
                    foreach ($result as $row)
                    {
                        // ID used to get info from other tables
                        $id = $row['user_id'];
                        // This is used to display the estimated time the user chose when they made a requests
                        $esttime = $row['estim_time'];
                        // Searching for the user's name and grade from the profile table because we want to display them on the card
                        $search = $curLink->query("SELECT name, grade from profiles WHERE id='$id'") or die(mysqli_error($curLink));
                        while($rowA = mysqli_fetch_assoc($search)) {
                            // Get their name and grade
                            $name = $rowA['name'];
                            $grade = $rowA['grade'];
                        }
                        // This is the subject that the user wanted help in
                        $subid = $row['subject'];
                        // Querying for the name of the subject in the subjects table
                        $sub_search = $curLink->query("SELECT sub_name from subjects WHERE sub_id='$subid'") or die(mysqli_error($curLink));
                        while($rowB = mysqli_fetch_assoc($sub_search)) {
                            $subname = $rowB['sub_name'];
                        }
                        // PHP Echos to generate the actual SQL after having gotten all the variables
                        echo '<div class="card" style="width: 400px">';
                        echo '<h5 class="card-header">'.$name.'</h5>';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">Seeking '.$subname.' help</h5>';
                        echo '<p class="card-text">Grade <span class="grade">'.$grade.'<span>';
                        echo '<br>Time posted: Just now';
                        // There's probably a better way to do this, but this works for now
                        if ($esttime == 1) { echo '<br>Estimated time: a few minutes</p>'; }
                        else if ($esttime == 2) { echo '<br>Estimated time: < 1 hour</p>'; }
                        else if ($esttime == 3) { echo '<br>Estimated time: ~ 1 hour</p>'; }
                        else if ($esttime == 4) { echo '<br>Estimated time: 2 hours</p>'; }
                        else if ($esttime == 5) { echo '<br>Estimated time: > 2 hours </p>'; }
                        else if ($esttime == 6) { echo '<br>Estimated time: not sure</p>'; }
                        echo '<a href="#" class="btn btn-primary">Help '.$name.'</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
			</div>
		</div>
	</div>
	<script src="javascript/RequestsSort.js"></script>
	<!-- end wrap div -->
	<hr />
</body>

</html>