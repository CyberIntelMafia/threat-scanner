<?php
session_start();
$logged_in = $_SESSION["logged_in"];

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
	if (!is_dir("../scans") && ($logged_in === "true")){
		$header  = "<h1>Threat Scanner ";
		$header .= "<a class='btn btn-primary btn-sm' href='../index.php' role='button'>Show Directories</a></h1>";
	} else if ($logged_in != "true"){
		$header  = "<h1>Threat Scanner</h1>";
	} else {
		$header  = "<h1>Threat Scanner ";
		$header .= "<a class='btn btn-primary btn-sm' href='logout.php' role='button'>Log Out</a></h1>";
	}
	echo "<div class='main-header'>" . $header . "</div>";
?>

<hr/>

<?php

if ($logged_in === "true"){
	if (is_dir("../scans")){
		echo "<div>Analyzed Directories</div>";
		exec("ls | grep -v .php",$_retval);
		(int)$item = 0;
		echo "<ul class='list-group'>";
		foreach ($_retval as $result):
			exec("ls $result/*.xml | wc -l",$_result);
			echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
			echo "<a href='$result' target='_new'>";
			echo "$result";
			echo "</a>";
			echo "<span class='badge badge-primary badge-pill'>";
			echo $_result[$item++];
			echo "</span>";
		endforeach;
		echo "</li>";
	} else {
		(int)$item = 0;
		echo "<div>Analyzed Results</div>";
		exec("find * -type f | grep -v index.php",$_retval);
		echo "<ul class='list-group'>";
		foreach ($_retval as $result):
			exec("grep 'addr=' $result | awk '{print $2}' | tr -d 'addr=' | tr -d '\"' ",$_result);
			echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
			echo "<a href='$result' target='_blank'>";
			echo "$result";
			echo "</a>";
			echo "<span class='badge badge-primary badge-pill'>";
	                echo $_result[$item++];
       		        echo "</span>";
			echo "</li>";
		endforeach;
		echo "</ul>";

	}
} else {
	echo "Please Login to Continue<br/>";
	$log_in .= "<a class='btn btn-primary btn-sm' href='login.php' role='button'>Login Here</a></h1>";
	echo "$log_in";
}

?>


</body>
</html>
