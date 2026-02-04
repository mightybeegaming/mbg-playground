<?php include 'domainredirect.php'?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Counter-Strike</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a simple Counter-Strike server with PodBot addon." />
		<meta property="og:title" content="MBG Counter-Strike Server" />
		<meta property="og:description" content="This is a simple Counter-Strike server with PodBot addon." />
		<meta property="og:url" content="https://mbgplayground.xyz/counterstrike" />
		<meta property="og:image" content="https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/10/header.jpg" />
		<meta property="og:type" content="website" />
		<link rel="canonical" href="https://mbgplayground.xyz/counterstrike" />
		<link rel="icon" href="icon.png" type="image/png">
		<link rel="stylesheet" href="common.css">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h3>MBG Counter-Strike</h3>
				<?php include 'join.php'?>
			</div>
			<div class="section">
				<h3>Server Information</h3>
				<ul>
					<li>This is a simple server with PodBot addon.</li>
				</ul>
				<div class="info-grid">
					<div class="info-box">
						<strong>Status</strong><br />
						<img src="https://uptime.mbgplayground.xyz/api/badge/71/status?style=for-the-badge" />
					</div>
					<div class="info-box">
						<strong>Uptime</strong><br />
						<img src="https://uptime.mbgplayground.xyz/api/badge/71/uptime?style=for-the-badge" />
					</div>
					<div class="info-box">
						<strong>Online Players</strong><br />
						<span class="highlight"><?php include 'data_counterstrike/online_players.php'?> / 32</span>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php include 'footer.php'?>
	<?php include 'gtag.php'?>
</html>