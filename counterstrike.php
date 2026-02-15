<?php define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'])?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Counter-Strike</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a simple Counter-Strike server with PodBot addon.">
		<meta property="og:title" content="MBG Counter-Strike">
		<meta property="og:description" content="This is a simple Counter-Strike server with PodBot addon.">
		<meta property="og:url" content="https://mbgplayground.xyz/counterstrike">
		<meta property="og:image" content="/_counterstrike/counterstrikebanner.jpg">
		<meta property="og:type" content="website">
		<link rel="canonical" href="https://mbgplayground.xyz/counterstrike">
		<link rel="icon" href="/_common/icon.png" type="image/png">
		<link rel="stylesheet" href="/_common/style.css">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h1>MBG Counter-Strike</h1>
				<?php include ROOT_DIR . '/_common/join.php'?>
			</div>
			<div class="section">
				<h1>Server Information</h1>
				<ul>
					<li>This is a simple Counter-Strike server with PodBot addon.</li>
				</ul>
				<div class="info-grid">
					<div class="info-box">
						<strong>Status</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/71/status?style=for-the-badge" alt="Status">
					</div>
					<div class="info-box">
						<strong>Uptime</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/71/uptime?style=for-the-badge" alt="Uptime">
					</div>
					<div class="info-box">
						<strong>Online Players</strong><br>
						<span class="highlight"><?php include ROOT_DIR . '/_counterstrike/online_players.php'?> / 32</span>
					</div>
				</div>
			</div>
		</div>
		<?php include ROOT_DIR . '/_common/footer.php'?>
		<?php include ROOT_DIR . '/_common/gtag.php'?>
	</body>
</html>