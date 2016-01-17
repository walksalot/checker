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
		<script src="js/all.js"></script>
		<link rel="stylesheet" href="css/app.css">
		<style>
		body {
			font-size:10px;
		}
		.wrappable { overflow: hidden; max-width: 400px; word-wrap: break-word; }
		</style>
	</head>
  <body>
    <div class="container" style="margin:5px;">

      <div class="page-header">


      <div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">How this works:</h3>
  </div>
  <div class="panel-body">
   <h4> <?=$resultMessage;?></h4><br><p class="lead">Results are sorted from lowest score to highest. Total score is <span id="scoreTotal"></span></p>
  </div>
</div>



        
      </div>
      <h3>All data is presented below.</h3>
      <p>The table below should provide you with all the information necessary to understand why certain links count as they did.  Management established that rel=nofollow links will be worth 0.25 "points" as compared to 1 point for a "clean" link.</p>
		<table class="auto table-bordered col-md-12" style="width:1300px; max-width:1300px;">
			<tr style="text-align:center;">
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
					if($urlItem[5]=='1') {
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
					$urlItem[3] = '<span style="font-size:10px;"><xmp>'.$urlItem[3].'</xmp></span>';
					echo '<td class="wrappable" style="padding:3px; text-align:center;  word-wrap: break-word; width:20px; margin-left:5px; margin-right:5px;"><h4>'.$i.'</h4></td>';
					foreach($urlItem as $item) {
						if(is_numeric($item) || $item=='Found') {
							echo '<td class="wrappable" style="padding:3px;  word-wrap: break-word; width:20px;">'.$item.'</td>';
						} elseif(stristr($item, 'xmp')) {
							echo '<td class="wrappable" style="padding:3px;  word-wrap: break-word; width:150px;">'.$item.'</td>';

						} else {
							$item = str_replace('www.', '', $item);
						echo '<td class="wrappable" style="padding:3px;  max-width:120px; word-wrap: break-word;">'.$item.'</td>';
						}
					}
					$scoreSum+=$score;
					$score = 0;
				echo '</tr>';
			}
			?>
		</table>
		<script>
		$(document).ready(function() {
		$('#scoreTotal').html('<?php echo $scoreSum; ?>');
		});
		</script>
		</div>
		</div>
	</body>
</html>