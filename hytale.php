<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Hytale</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a modded Hytale server to test and explore the early access build.">
		<meta property="og:title" content="MBG Hytale">
		<meta property="og:description" content="This is a modded Hytale server to test and explore the early access build.">
		<meta property="og:url" content="<?=URL_HYTALE?>">
		<meta property="og:image" content="<?=URL_HYTALEBANNER?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_HYTALE?>">
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
				<h1>MBG Hytale</h1>
				<p>This is a modded <span class="highlight">Hytale</span> server to test and explore the early access build.</p>
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
						<span class="highlight right-side" id="latencyText"></span> -->
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
		<script async src="<?=URL_JSDUST?>"></script>
		<?php include PATH_1UP?>
		<script>
			async function loadServerMetrics() {
				const request = await fetch('<?=URL_SERVERMETRICS?>?server=Hytale', {cache: 'no-store'});
				const data = await request.json();
				// console.log(data);

				document.getElementById('statusText').textContent = data.server.statusText;
				// document.getElementById('latencyText').textContent = data.server.latencyText;
				document.getElementById('uptime24').textContent = data.server.uptime24;
				document.getElementById('onlinePlayers').textContent = `${data.onlinePlayers} / 100`;
			}
			setInterval(loadServerMetrics, 5000);
			loadServerMetrics();
		</script>
	</body>
</html>