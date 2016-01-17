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
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<style>
		body {

			font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
			font-size:11px;
			padding:20px; margin:25px;

		}

			th {
				text-align:center;
				text-decoration: underline;

			}
		</style>
	</head>
	<body>
<?=$resultMessage;?>
<br><br>
<h2>Score: <span id="scoreTotal"></span></h2>
<br><hr><br>
<table class="auto table-bordered col-md-12">
<tr>
	<th>#</th>
	<th>URL Checked</th>
	<th>Domain</th>
	<th>Link URL</th>
	<th>Link Code</th>
	<th>Anchor Text</th>
	<th>NoFollow Links Present?</th>
	<th>Total Links to TCG Properties on Page</th>
	<th>Score</th>

</tr>
<?php
#var_dump($checkLog);
$scoreSum = 0;
$i = 0;
foreach($checkLog as $urlItem) {
	$i++;
	if($urlItem[5]>0) {
		#Nofollow
		$score = 0.25;
		$nofollow = " style='background-color:#FEB2B3;'";
		if($urlItem[5]==1) {
			$urlItem[5]=='Found';
		}
	} else {
		$nofollow = '';
		$score = 1;
	}
	if(stristr($urlItem[1],'instantcheckmate')) {
		$urlItem[2] = '<font style="color:#4B95CC; font-weight:bold;">'.$urlItem[2].'</font>';
	} elseif(stristr($urlItem[1],'truthfinder')) {
		$urlItem[2] = '<font style="color:#179170; font-weight:bold;">'.$urlItem[2].'</font>';
	}
	echo "<tr$nofollow>";
	$urlItem[3] = '<xmp>'.$urlItem[3].'</xmp>';
	echo '<td style="padding:15px;  word-wrap: break-word; width:20px;"><h1>'.$i.'</h1></td>';

	foreach($urlItem as $item) {
		if(is_numeric($item) || $item=='Found') {
		echo '<td style="padding:15px;  word-wrap: break-word; width:20px;"><p>'.$item.'</p></td>';

		} else {
		echo '<td style="padding:15px;  max-width:400px; word-wrap: break-word;">'.$item.'</td>';
		}
	}
	echo '<td style="padding:15px;  max-width:400px; word-wrap: break-word;">'.$score.'</td>';	
	$scoreSum+=$score;
	$score = 0;

	echo '</tr>';

}
?>
</table>
<script>
$(document).ready(function() {
	$('#scoreTotal').innerHtml('<?php echo $scoreSum; ?>');
});
</script>
	</body>
</html>