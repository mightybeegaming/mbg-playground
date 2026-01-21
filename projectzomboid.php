<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Project Zomboid</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a beginner-friendly server that uses only lightweight quality-of-life and immersion mods." />
		<meta property="og:title" content="MBG Project Zomboid Server" />
		<meta property="og:description" content="This is a beginner-friendly server that uses only lightweight quality-of-life and immersion mods." />
		<meta property="og:url" content="https://mbgplayground.xyz/projectzomboid" />
		<meta property="og:image" content="data_discord/discordbanner.jpg" />
		<meta property="og:type" content="website" />
		<link rel="icon" href="icon.png" type="image/png">
		<link rel="stylesheet" href="common.css">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h3>MBG Project Zomboid</h3>
				<?php include 'join.php'?>
			</div>
			<div class="section">
				<h3>PvE Server Information</h3>
				<ul>
					<li>This is a beginner-friendly server that uses only lightweight quality-of-life and immersion mods.</li>
				</ul>
				<div class="info-grid">
					<div class="info-box">
						<strong>Status</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/61/status?style=for-the-badge" />
					</div>
					<div class="info-box">
						<strong>Uptime</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/61/uptime?style=for-the-badge" />
					</div>
					<div class="info-box">
						<strong>Online Players</strong><br>
						<span class="highlight"><?php include 'data_projectzomboid/online_players.php'?> / 100</span>
					</div>
				</div>
				<br />
				<h3>PvP Server Information</h3>
				<p>This is a PvP-focused server that offers almost the same experience as the PvE server, but with no restrictions.</p>
				<div class="info-grid">
					<div class="info-box">
						<strong>Status</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/64/status?style=for-the-badge" />
					</div>
					<div class="info-box">
						<strong>Uptime</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/64/uptime?style=for-the-badge" />
					</div>
					<div class="info-box">
						<strong>Online Players</strong><br>
						<span class="highlight"><?php include 'data_projectzomboid/online_players_pvp.php'?> / 100</span>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php include 'footer.php'?>
	<?php include 'gtag.php'?>
</html>