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
		<canvas id="dust"></canvas>
		<div class="container">
			<div class="section">
				<h1>MBG Hytale</h1>
				<p>This is a simple Hytale server to test and explore the early access build.</p>
			</div>
			<div class="section">
				<?php include PATH_SERVERINFOHEADER?>
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
						<span class="highlight" id="online_players"></span>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<?php include PATH_NAVBAR?>
			<?php include PATH_LICENSING?>
		</footer>
		<?php include PATH_GOOGLETAG?>
		<script>
			async function loadServerMetrics() {
				const request = await fetch('<?=URL_SERVERMETRICS?>?server=hytale', {cache: 'no-store'});
				const data = await request.json();
				// console.log(data);

				document.getElementById('online_players').textContent = `${data.online_players} / 100`;
			}
			setInterval(loadServerMetrics, 1000);
			loadServerMetrics();
		</script>
		<script async src="<?=URL_JSDUST?>"></script>
	</body>
</html>