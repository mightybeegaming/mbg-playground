<?php
$file = count(file(PATH_ROOT . '/_onlineplayers/projectzomboid.txt'));
$online_players = max(0, $file - 1);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Project Zomboid</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a beginner-friendly Project Zomboid server with quality-of-life and immersion mods.">
		<meta property="og:title" content="MBG Project Zomboid">
		<meta property="og:description" content="This is a beginner-friendly Project Zomboid server with quality-of-life and immersion mods.">
		<meta property="og:url" content="<?=URL_PROJECTZOMBOID?>">
		<meta property="og:image" content="<?=URL_PROJECTZOMBOIDBANNER?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_PROJECTZOMBOID?>">
		<link rel="icon" href="<?=URL_MBGPLAYGROUNDLOGO?>" type="image/png">
		<link rel="stylesheet" href="<?=URL_CSS?>">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h1>MBG Project Zomboid</h1>
				<?php include PATH_JOIN?>
			</div>
			<div class="section">
				<h1>Server Information</h1>
				<ul>
					<li>This is a beginner-friendly Project Zomboid server with quality-of-life and immersion mods.</li>
				</ul>
				<div class="info-grid">
					<div class="info-box">
						<strong>Status</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/75/status?style=for-the-badge" alt="Status">
					</div>
					<div class="info-box">
						<strong>Uptime</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/75/uptime?style=for-the-badge" alt="Uptime">
					</div>
					<div class="info-box">
						<strong>Online Players</strong><br>
						<span class="highlight"><?=$online_players?> / 100</span>
					</div>
				</div>
			</div>
		</div>
		<?php include PATH_FOOTER?>
		<?php include PATH_GOOGLETAG?>
	</body>
</html>