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
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- Optional theme -->		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1>TCG Backlink Analysis Tool</h1>
			</div>
			<form method="POST" action="/results"  onsubmit="return confirm('This may take a while, depending on the number of links.  150 links can take over 25 minutes.');">
				<div class="form-group">
					<label for="comment">Please enter the URLs you will like checked (<small>One per line</small>):</label>
					<textarea class="form-control" rows="25" name="urls" id="urls" style="margin-top:20px;"></textarea>
				</div>
				<button type="submit" class="btn btn-default">Submit Links for Analysis</button>
			</form>
			</div> <!-- /container -->
		</div>
		<footer class="footer">
			<div class="container">
				<p class="text-muted" style="margin-top:50px;">Developed by KK.</p>
			</div>
		</footer>
	</body>
</html>