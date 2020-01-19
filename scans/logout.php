<?php
session_start();
$_SESSION = array();
session_destroy();

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
	$header  = "<h1>Threat Scanner</h1>";
	echo "<div class='main-header'>" . $header . "</div>";
?>
<hr/>

</body>
</html>



