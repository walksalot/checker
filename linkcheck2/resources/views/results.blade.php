<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">
		<title>Static Top Navbar Example for Bootstrap</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<style>
		body {

			font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
			font-size:10px;

		}
		</style>
	</head>
	<body>

<table class="table table-bordered">
<?php
#var_dump($checkLog);
foreach($checkLog as $urlItem) {

	if($urlItem[4]==1) {
		#Nofollow
		$nofollow = " background-color:#FEB2B3; ";
	} else {
		$nofollow = '';
	}
	if(stristr($urlItem[1],'instantcheckmate')) {
		$urlItem[2] = '<font style="color:#4B95CC; font-weight:bold;">'.$urlItem[2].'</font>';
	} elseif(stristr($urlItem[1],'truthfinder')) {
		$urlItem[2] = '<font style="color:#179170; font-weight:bold;">'.$urlItem[2].'</font>';
	}
	
	echo '<tr>';
	$urlItem[1] = '<xmp>'.$urlItem[1].'</xmp>';
	foreach($urlItem as $item) {

		echo '  <td style="word-wrap: break-word;'.$nofollow.'min-width: 14%;max-width: 14%;">'.$item.'</td>';
	}
	echo '</tr>';
}
?>
</table>
	</body>
</html>