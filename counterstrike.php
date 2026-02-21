<?php
$file = file_get_contents(PATH_ONLINECOUNTERSTRIKE);

preg_match_all('/^#\s*\d+\s+"[^"]+"\s+\d+\s+(STEAM_[0-5]:[01]:\d+)/m', $file, $players);
$online_players = count($players[1]);

preg_match('/map\s*:\s*([^\s]+)/i', $file, $map);
$current_map = $map[1] ?? 'unknown';

preg_match('/"amx_nextmap"\s+is\s+"([^"]+)"/i', $file, $map);
$next_map = $map[1];

preg_match('/SCORE:T=(\d+);CT=(\d+)/', $file, $scores);
$score_t = (int)$scores[1];
$score_ct = (int)$scores[2];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Counter-Strike</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a simple Counter-Strike server with PodBot addon.">
		<meta property="og:title" content="MBG Counter-Strike">
		<meta property="og:description" content="This is a simple Counter-Strike server with PodBot addon.">
		<meta property="og:url" content="<?=URL_COUNTERSTRIKE?>">
		<meta property="og:image" content="<?=URL_COUNTERSTRIKEBANNER?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_COUNTERSTRIKE?>">
		<link rel="icon" href="<?=URL_MBGPLAYGROUNDLOGO?>" type="image/png">
		<link rel="stylesheet" href="<?=URL_CSS?>">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h1>MBG Counter-Strike</h1>
				<p>This is a simple Counter-Strike server with PODBot addon.</p>
			</div>
			<div class="section">
				<h1>Server Information</h1>
				<?php include PATH_JOIN?>
				<div class="info-grid">
					<div class="info-box">
						<b>Status</b><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/71/status?style=for-the-badge" alt="Status">
					</div>
					<div class="info-box">
						<b>Uptime</b><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/71/uptime?style=for-the-badge" alt="Uptime">
					</div>
					<div class="info-box">
						<b>Online Players</b><br>
						<span class="highlight"><?=$online_players?> / 32</span>
					</div>
					<div class="info-box">
						<b>Current Map</b><br>
						<span class="highlight"><?=$current_map?></span>
					</div>
					<div class="info-box">
						<b>Next Map</b><br>
						<span class="highlight"><?=$next_map?></span>
					</div>
					<div class="info-box">
						<b>Match Score</b><br>
						<span class="highlight">T: <?=$score_t?></span> |
						<span class="highlight">CT: <?=$score_ct?></span>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<?php include PATH_NAVBAR?>
			<?php include PATH_LICENSING?>
		</footer>
		<?php include PATH_GOOGLETAG?>
	</body>
</html>