<?php
$content = file_get_contents(PATH_ONLINEHYTALE);

preg_match('/^[^(]*\((\d+)\)/', $content, $matches);

$online_players = $matches[1] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Hytale</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a simple Hytale server to test and explore the early access build.">
		<meta property="og:title" content="MBG Hytale">
		<meta property="og:description" content="This is a simple Hytale server to test and explore the early access build.">
		<meta property="og:url" content="<?=URL_HYTALE?>">
		<meta property="og:image" content="<?=URL_HYTALEBANNER?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_HYTALE?>">
		<link rel="icon" href="<?=URL_MBGPLAYGROUNDLOGO?>" type="image/png">
		<link rel="stylesheet" href="<?=URL_CSS?>">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h1>MBG Hytale</h1>
				<p>This is a simple Hytale server to test and explore the early access build.</p>
				<p>
					<span class="highlight">Features</span> -
					<span class="highlight"><a href="http://hytalemap.mbgplayground.playit.plus/" title="Realtime World Map Link" target="_blank">Realtime World Map</a></span>
				</p>
			</div>
			<div class="section">
				<h1>Server Information</h1>
				<?php include PATH_JOIN?>
				<div class="info-grid">
					<div class="info-box">
						<b>Status</b><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/73/status?style=for-the-badge" alt="Status">
					</div>
					<div class="info-box">
						<b>Uptime</b><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/73/uptime?style=for-the-badge" alt="Uptime">
					</div>
					<div class="info-box">
						<b>Online Players</b><br>
						<span class="highlight"><?=$online_players?> / 100</span>
					</div>
				</div>
				<p>
					<span class="highlight">Mods</span> -
					<a href="https://www.curseforge.com/members/mightybee/favorites" title="Mod Collection Link" target="_blank">Collection</a>
				</p>
			</div>
		</div>
		<footer>
			<?php include PATH_NAVBAR?>
			<?php include PATH_LICENSING?>
		</footer>
		<?php include PATH_GOOGLETAG?>
	</body>
</html>