<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG V Rising</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a V Rising server with quality of life adjustments and game mechanic overhaul mods.">
		<meta property="og:title" content="MBG V Rising">
		<meta property="og:description" content="This is a V Rising server with quality of life adjustments and game mechanic overhaul mods.">
		<meta property="og:url" content="<?=URL_VRISING?>">
		<meta property="og:image" content="<?=URL_VRISINGBANNER?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_VRISING?>">
		<link rel="icon" href="<?=URL_MBGPLAYGROUNDLOGO?>" type="image/png">
		<link rel="stylesheet" href="<?=URL_CSS?>">
	</head>
	<body>
		<canvas id="dust"></canvas>
		<div class="container">
			<div class="discord-container">
				<a href="<?=URL_DISCORD?>" class="discord-button">
					<img src="<?=URL_DISCORDLOGO?>" alt="Discord Logo" class="discord-icon">
					Join Discord
				</a>
			</div>
			<div class="section">
				<h1>MBG V Rising</h1>
				<p>This is a <span class="highlight">V Rising</span> server with quality of life adjustments and game mechanic overhaul mods.</p>
				<?php include PATH_JOIN?>
			</div>
			<div class="section">
				<h1>Server Information</h1>
				<div class="info-grid">
					<div class="info-box">
						<b>Status</b><br>
						<span class="highlight right-side" id="statusText"></span>
					</div>
					<div class="info-box">
						<!-- <b>Latency</b><br>
						<span class="highlight" id="latencyText"></span> -->
						<b>Uptime (24H)</b><br>
						<span class="highlight right-side" id="uptime24"></span>
					</div>
					<div class="info-box">
						<b>Online Players</b><br>
						<span class="highlight right-side" id="onlinePlayers"></span>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<?php include PATH_NAVBAR?>
			<?php include PATH_LICENSING?>
		</footer>
		<?php include PATH_GOOGLETAG?>
		<?php include PATH_ONLOADHVRISING?>
		<script async src="<?=URL_JSDUST?>"></script>
		<?php include PATH_1UP?>
	</body>
</html>