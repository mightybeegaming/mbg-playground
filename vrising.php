<?php include '_domainredirect.php'?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG V Rising</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a PvE server running on Brutal difficulty with some quality-of-life adjustments." />
		<meta property="og:title" content="MBG V Rising Server" />
		<meta property="og:description" content="This is a PvE server running on Brutal difficulty with some quality-of-life adjustments." />
		<meta property="og:url" content="https://mbgplayground.xyz/vrising" />
		<meta property="og:image" content="https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1604030/header.jpg" />
		<meta property="og:type" content="website" />
		<link rel="canonical" href="https://mbgplayground.xyz/vrising" />
		<link rel="icon" href="icon.png" type="image/png">
		<link rel="stylesheet" href="common.css">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h3>MBG V Rising</h3>
				<?php include '_join.php'?>
			</div>
			<div class="section">
				<h3>Server Information</h3>
				<ul>
					<li>This is a PvE server running on Brutal difficulty with some quality-of-life adjustments.</li>
				</ul>
				<div class="info-grid">
					<div class="info-box">
						<strong>Status</strong><br />
						<img src="https://uptime.mbgplayground.xyz/api/badge/58/status?style=for-the-badge" />
					</div>
					<div class="info-box">
						<strong>Uptime</strong><br />
						<img src="https://uptime.mbgplayground.xyz/api/badge/58/uptime?style=for-the-badge" />
					</div>
					<div class="info-box">
						<strong>Online Players</strong><br />
						<span class="highlight"><?php include 'data_vrising/online_players.php'?> / 60</span>
					</div>
				</div>
			</div>
		</div>
		<?php include '_footer.php'?>
		<?php include '_gtag.php'?>
	</body>
</html>