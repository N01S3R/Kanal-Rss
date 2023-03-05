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
	<?php
	require_once 'Channel.php';
	require_once 'Entry.php';
	require_once 'Channels.php';

	// Channels::addURL('https://naekranie.pl/feed/all.xml');
	// Channels::addURL('https://rss.art19.com/apology-line');

	if (isset($_GET['link']) && !empty($_GET['link'])) {
		$link = filter_var($_GET['link'], FILTER_SANITIZE_URL);
		Channels::addURL($link);
		$channels = Channels::get();
	}

	?>
	<div class="container">

		<a href="view.php" class="btn btn-info active" role="button">
			Pokaż kanały Rss
		</a>&nbsp;
		<a href="xmoon.php" class="btn btn-info" role="button">
			Pokaż Xmoon
		</a>
		<div class="col text-center">
			<h5>
				Dodaj kanały RSS
			</h5>
		</div>
		<form action="index.php" method="get">
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
		if (isset($channels)) {
			foreach ($channels as $channel) : ?>
				<div class="channel">
					<h1><a href="<?php echo $channel->getURL(); ?>"><?php echo ucfirst($channel->getTitle()); ?></a></h1>
					<?php
					$entries = $channel->getEntries();
					foreach ($entries as $entry) :
					?>
						<div class="entry">
							<h2><a href="<?php echo $entry->getURL(); ?>"><?php echo $entry->getTitle(); ?></a></h2>
							<h3><?php echo $entry->getDate(); ?></h3>
							<p>
								<?php echo $entry->getDescription(); ?>
							</p>
						</div>
					<?php endforeach; ?>
				</div>
		<?php endforeach;
		} else {
			echo "<h1>No Results</h1>";
		} ?>
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