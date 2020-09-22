<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>
			Czytnik kanałów RSS
		</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="container">
			<a href="view.php" class="btn btn-info" role="button">
				Pokaż kanały Rss
			</a>&nbsp;
			<a href="xmoon.php" class="btn btn-info" role="button">
				Pokaż dodanie Xmoon
			</a>
			<div class="col text-center">
				<h5>
					Rekordy Xmoon z bazy
				</h5>
			</div>
			<table class="table table-responsive table-dark" style="margin-top: 5%;">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							Tytuł
						</th>
						<th>
							Opis
						</th>
						<th>
							Data Dodania
						</th>
						<th>
							Data w bazie
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include('functions.php');
					$n = new NewsFeed();
					$n->viewXmoon();
					?>
				</tbody>
			</table>
		</div>
		</div>
		</div>
	</body>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js">
	</script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	</script>
</html>
