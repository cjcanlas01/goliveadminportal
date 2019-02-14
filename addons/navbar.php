<nav class="navbar sticky-top">
	<div class="row">
		<div class="col-md-2">
			<a href="index-dashboard.php"><img src="resources/logoopt4.png" style="height: 45px; width: auto;" alt="Platform Logo"></a>
		</div>
		<div class="col-md-6">
			<a class="navbar-brand" href="index-dashboard.php" style="color: white;">GoLive: Admin Portal</a>
		</div>
	</div>
	<?php 
		echo "<div><label style='color: white;'>Welcome, ". str_ireplace('@gmail.com', '', $_SESSION['account_record']) ."!</label><span style='color:white; padding: 10px 10px 10px 10px;'>|</span><a style='color: white;' href='php/sessionend.php'>Log Out</a></div>";
	?>
</nav>