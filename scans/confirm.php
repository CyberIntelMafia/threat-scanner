<?php
session_start();

$user = "admin@email.com";
$pass = "admin";

$username = $_GET["email"];
$password = $_GET["password"];

if (($user === $username) && ($pass === $password)){
	$_SESSION["logged_in"] = "true";
	$_SESSION["username"] = $username;
	echo "Successfully logged in as admin";
} else {
	echo "Incorrect login credentials was given";
}
?>
<?php
session_start();
$logged_in = $_SESSION["logged_in"];
$username = $_SESSION["username"];

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Threat Scanner</title>
		<meta http-equiv="refresh" content="2;url=login.php"/>
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

</body>
</html>



