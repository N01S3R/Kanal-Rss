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
		<style>

		</style>
	</head>
	<body>
		<div class="container">

			<a href="index.php" class="btn btn-info" role="button">
				Pokaż kanały Rss
			</a>&nbsp;
			<a href="viewx.php" class="btn btn-info active" role="button">
				Pokaż Xmoon
			</a>
			<div class="col text-center">
				<h5>
					Dodaj kanały Xmoon
				</h5>
			</div>
			<form action="xmoon.php" method="get">
				<div class="d-flex justify-content-center h-100">
					<div class="searchbar d-flex justify-content-center">
						<input class="search_input" type="text" name="link" placeholder="Rss...">
						<button id="button">
							<i class="fas fa-search white">
							</i>
						</button>
					</div>
				</div>
			</form>
			<?php
			include('functions.php');
			if(isset($_GET['link']) && !empty($_GET['link']) && !is_null($_GET['link']))
			{
				$link = htmlspecialchars($_GET['link']);
				?>
				<table class="table table-responsive table-dark">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							Tytuł
						</th>
						<th>
							Data Dodania
						</th>
						<th>
							Opis
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$n    = new NewsFeed();
					$n->checkUrl($link);
					$n->loadXmoon();
					?>
				</tbody>
				<?php
			}
			?>
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
