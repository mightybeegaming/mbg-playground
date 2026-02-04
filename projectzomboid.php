<?php include '_domainredirect.php'?>
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
		<link rel="canonical" href="https://mbgplayground.xyz/projectzomboid" />
		<link rel="icon" href="_icon.png" type="image/png">
		<link rel="stylesheet" href="_common.css">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h3>MBG Project Zomboid</h3>
				<?php include '_join.php'?>
			</div>
			<div class="section">
				<h3>Server Information</h3>
				<ul>
					<li>This is an early take for the B42 Unstable version with quality-of-life and immersion mods.</li>
				</ul>
				<div class="info-grid">
					<div class="info-box">
						<strong>Status</strong><br />
						<img src="https://uptime.mbgplayground.xyz/api/badge/75/status?style=for-the-badge" />
					</div>
					<div class="info-box">
						<strong>Uptime</strong><br />
						<img src="https://uptime.mbgplayground.xyz/api/badge/75/uptime?style=for-the-badge" />
					</div>
					<div class="info-box">
						<strong>Online Players</strong><br />
						<span class="highlight"><?php include 'data_projectzomboid/online_players.php'?> / 100</span>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php include '_footer.php'?>
	<?php include '_gtag.php'?>
</html>