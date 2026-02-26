<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Project Zomboid</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a Project Zomboid (B42) server with quality-of-life and immersion mods.">
		<meta property="og:title" content="MBG Project Zomboid">
		<meta property="og:description" content="This is a Project Zomboid (B42) server with quality-of-life and immersion mods.">
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
				<p>This is a Project Zomboid (B42) server with quality-of-life and immersion mods.</p>
			</div>
			<div class="section">
				<?php include PATH_SERVERINFOHEADER?>
				<?php include PATH_JOIN?>
				<div class="info-grid">
					<div class="info-box">
						<b>Status</b><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/75/status?style=for-the-badge" alt="Status">
					</div>
					<div class="info-box">
						<b>Uptime</b><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/75/uptime?style=for-the-badge" alt="Uptime">
					</div>
					<div class="info-box">
						<b>Online Players</b><br>
						<span class="highlight"><span id="online_players"></span> / 100</span>
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
			async function loadServerInfo() {
				try {
					const response = await fetch('<?=URL_INITIALIZEPROJECTZOMBOID?>', {cache: 'no-store'});
					const data = await response.json();

					document.getElementById('online_players').textContent = data.online_players;
				} catch (error) {
					console.error('Error loading server info:', error);
				}
			}
			loadServerInfo();
			setInterval(loadServerInfo, 1000);
		</script>
	</body>
</html>