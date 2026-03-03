
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
		<canvas id="dust"></canvas>
		<div class="container">
			<div class="section">
				<h1>MBG Counter-Strike</h1>
				<p>This is a <span class="highlight">Counter-Strike</span> server with performance and stability enhancements.</p>
			</div>
			<div class="section">
				<?php include PATH_SERVERINFOHEADER?>
				<?php include PATH_JOIN?>
				<div class="info-grid">
					<div class="info-box">
						<b>Status</b><br>
						<span class="highlight right-side" id="status_text"></span>
					</div>
					<div class="info-box">
						<!-- <b>Latency</b><br>
						<span class="highlight" id="latency_text"></span> -->
						<b>Uptime (24H)</b><br>
						<span class="highlight right-side" id="uptime_24"></span>
					</div>
					<div class="info-box">
						<b>Online Players</b><br>
						<span class="highlight right-side" id="online_players"></span>
					</div>
					<div class="info-box">
						<b>Match Score</b><br>
						<div class="right-side" id="match_score"></div>
					</div>
					<div class="info-box">
						<b>Current Map</b><br>
						<span class="highlight right-side" id="current_map"></span>
					</div>
					<div class="info-box">
						<b>Next Map</b><br>
						<span class="highlight right-side" id="next_map"></span>
					</div>
				</div>
				<div class="discord-container">
					<a href="<?=URL_DISCORD?>" class="discord-button">
						<img src="<?=URL_DISCORDLOGO?>" alt="Discord Logo" class="discord-icon">
						Join Discord
					</a>
				</div>
			</div>
		</div>
		<footer>
			<?php include PATH_NAVBAR?>
			<?php include PATH_LICENSING?>
		</footer>
		<?php include PATH_GOOGLETAG?>
		<?php include PATH_ONLOADCOUNTERSTRIKE?>
		<script async src="<?=URL_JSDUST?>"></script>
		<?php include PATH_1UP?>
	</body>
</html>