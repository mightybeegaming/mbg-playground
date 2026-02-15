<?php define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'])?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG V Rising</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a V Rising server (PvE) running on Brutal difficulty with some quality-of-life adjustments.">
		<meta property="og:title" content="MBG V Rising">
		<meta property="og:description" content="This is a V Rising server (PvE) running on Brutal difficulty with some quality-of-life adjustments.">
		<meta property="og:url" content="https://mbgplayground.xyz/vrising">
		<meta property="og:image" content="/_vrising/vrisingbanner.jpg">
		<meta property="og:type" content="website">
		<link rel="canonical" href="https://mbgplayground.xyz/vrising">
		<link rel="icon" href="/_common/icon.png" type="image/png">
		<link rel="stylesheet" href="/_common/style.css">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h1>MBG V Rising</h1>
				<?php include ROOT_DIR . '/_common/join.php'?>
			</div>
			<div class="section">
				<h1>Server Information</h1>
				<ul>
					<li>This is a V Rising server (PvE) running on Brutal difficulty with some quality-of-life adjustments.</li>
				</ul>
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
						<span class="highlight"><?php include ROOT_DIR . '/_vrising/online_players.php'?> / 60</span>
					</div>
				</div>
			</div>
		</div>
		<?php include ROOT_DIR . '/_common/footer.php'?>
		<?php include ROOT_DIR . '/_common/gtag.php'?>
	</body>
</html>