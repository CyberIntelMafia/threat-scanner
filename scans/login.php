<?php
session_start();
$logged_in = $_SESSION["logged_in"];
$username = $_SESSION["username"];

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Threat Scanner</title>
		<?php
			if (is_dir("../scans")){
				echo "<link rel='stylesheet' type='text/css' href='../bootstrap/css/bootstrap.css'>";
				echo "<link rel='stylesheet' type='text/css' href='../bootstrap/css/bootstrap-grid.css'>";
				echo "<link rel='stylesheet' type='text/css' href='../bootstrap/css/bootstrap-reboot.css'>";
				echo "<script src=''></script>";
			} else {
				echo "<link rel='stylesheet' type='text/css' href='../../bootstrap/css/bootstrap.css'>";
				echo "<link rel='stylesheet' type='text/css' href='../../bootstrap/css/bootstrap-grid.css'>";
				echo "<link rel='stylesheet' type='text/css' href='../../bootstrap/css/bootstrap-reboot.css'>";
			}
		?>
		<style>
			.main-header {
				margin-left: 1%;
			}
		</style>
	</head>
<body>
<?php
	if (!is_dir("../scans")){
		$header  = "<h1>Threat Scanner ";
		$header .= "<a class='btn btn-primary btn-sm' href='../index.php' role='button'>Show Directories</a></h1>";
	} else {
		$header  = "<h1>Threat Scanner</h1>";
	}
	echo "<div class='main-header'>" . $header . "</div>";
?>

<hr/>

<?php if ($logged_in != "true") { ?>
<form action="confirm.php" method="get">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
} else {
	echo "Logged In As $username";
}
?>
</body>
</html>

