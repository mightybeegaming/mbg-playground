
<?php
include PATH_SERVERMETRICS;

$metrics = get_metrics_counterstrike();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Counter-Strike</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a Counter-Strike server with performance and stability enhancements.">
		<meta property="og:title" content="MBG Counter-Strike">
		<meta property="og:description" content="This is a Counter-Strike server with performance and stability enhancements.">
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
				<p>This is a Counter-Strike server with performance and stability enhancements.</p>
			</div>
			<div class="section">
				<?php include PATH_SERVERINFOHEADER?>
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
						<span class="highlight"><?=$metrics['online_players']?> / 32</span>
					</div>
					<div class="info-box">
						<b>Match Score</b><br>
						<span class="highlight">Ts = <?=$metrics['score_t']?></span> <b>|</b>
						<span class="highlight">CTs = <?=$metrics['score_ct']?></span>
					</div>
					<div class="info-box">
						<b>Current Map</b><br>
						<span class="highlight"><?=$metrics['current_map']?></span>
					</div>
					<div class="info-box">
						<b>Next Map</b><br>
						<span class="highlight"><?=$metrics['next_map']?></span>
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