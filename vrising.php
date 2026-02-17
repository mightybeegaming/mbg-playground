<?php
$file = count(file(PATH_ONLINEVRISING));
$online_players = max(0, $file - 1);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG V Rising</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a V Rising server (PvE) running on Brutal difficulty with some quality-of-life adjustments.">
		<meta property="og:title" content="MBG V Rising">
		<meta property="og:description" content="This is a V Rising server (PvE) running on Brutal difficulty with some quality-of-life adjustments.">
		<meta property="og:url" content="<?=URL_VRISING?>">
		<meta property="og:image" content="<?=URL_VRISINGBANNER?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_VRISING?>">
		<link rel="icon" href="<?=URL_MBGPLAYGROUNDLOGO?>" type="image/png">
		<link rel="stylesheet" href="<?=URL_CSS?>">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h1>MBG V Rising</h1>
				<p>This is a V Rising server (PvE) running on Brutal difficulty with some quality-of-life adjustments.</p>
			</div>
			<div class="section">
				<h1>Server Information</h1>
				<?php include PATH_JOIN?>
				<div class="info-grid">
					<div class="info-box">
						<strong>Status</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/58/status?style=for-the-badge" alt="Status">
					</div>
					<div class="info-box">
						<strong>Uptime</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/58/uptime?style=for-the-badge" alt="Uptime">
					</div>
					<div class="info-box">
						<strong>Online Players</strong><br>
						<span class="highlight"><?=$online_players?> / 60</span>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<?php include PATH_PAGELINKS?>
			<?php include PATH_LICENSING?>
		</footer>
		<?php include PATH_GOOGLETAG?>
	</body>
</html>