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
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #70acb1;">
	<a class="navbar-brand" href="#">
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

<body>
	<!-- title and description -->
	<br>
	<br>
	<div class="container  d-flex justify-content-center align-items-center container">
		<div class="text-center">
			<h3>Requests Stream</h3>
            <p>These are students who are currently requesting help in a subject.</p>
            <!-- A button example of how the cards are sortable (RequestsSort.js) -->
            <input type="button" class="submit_button btn btn-primary" id="btnSort" value="Sort by time posted" />
            <!-- These are the request cards. TODO: Make them generate from an SQL table -->
			<div class="card-deck">
				<div class="card" style="width: 600px">
					<h5 class="card-header">John Doe</h5>
					<div class="card-body">
						<h5 class="card-title">Seeking trigonometry help</h5>
						<p class="card-text">Grade <span class="grade">10<span><br>Time posted: <span class="time">60</span> minutes ago
							<br>Estimated time: 1 hour</p> <a href="chatExample.html" class="btn btn-primary">Help John Doe</a>
					</div>
				</div>
				<div class="card" style="width: 600px">
					<h5 class="card-header">Tim Buktu</h5>
					<div class="card-body">
						<h5 class="card-title">Seeking english help</h5>
						<p class="card-text">Grade <span class="grade">11<span><br>Time posted: <span class="time">30</span> minutes ago
							<br>Estimated time:
							< 1 hour</p> <a href="#" class="btn btn-primary">Help Tim Buktu</a>
					</div>
                </div>
                <div class="card" style="width: 600px">
					<h5 class="card-header">Alice Chester</h5>
					<div class="card-body">
						<h5 class="card-title">Seeking physics help</h5>
						<p class="card-text">Grade <span class="grade">9<span><br>Time posted: <span class="time">40</span> minutes ago
							<br>Estimated time:
							< 1 hour</p> <a href="#" class="btn btn-primary">Help Alice Chester</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="javascript/RequestsSort.js"></script>
	<!-- end wrap div -->
	<hr />
</body>

</html>