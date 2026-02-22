<?php
$file = count(file(PATH_ONLINEVRISING));
$online_players = max(0, $file - 1);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG V Rising</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a V Rising server with quality-of-life adjustments and game mechanic overhaul mods.">
		<meta property="og:title" content="MBG V Rising">
		<meta property="og:description" content="This is a V Rising server with quality-of-life adjustments and game mechanic overhaul mods.">
		<meta property="og:url" content="<?=URL_VRISING?>">
		<meta property="og:image" content="<?=URL_VRISINGBANNER?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_VRISING?>">
		<link rel="icon" href="<?=URL_MBGPLAYGROUNDLOGO?>" type="image/png">
		<link rel="stylesheet" href="<?=URL_CSS?>">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h1>MBG V Rising</h1>
				<p>This is a V Rising server with quality-of-life adjustments and game mechanic overhaul mods.</p>
				
			</div>
			<div class="section">
				<h1>Server Information</h1>
				<?php include PATH_JOIN?>
				<div class="info-grid">
					<div class="info-box">
						<b>Status</b><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/58/status?style=for-the-badge" alt="Status">
					</div>
					<div class="info-box">
						<b>Uptime</b><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/58/uptime?style=for-the-badge" alt="Uptime">
					</div>
					<div class="info-box">
						<b>Online Players</b><br>
						<span class="highlight"><?=$online_players?> / 60</span>
					</div>
				</div>
				<p>
					<span class="highlight">Mods</span> -
					<a href="https://thunderstore.io/c/v-rising/p/zfolmt/AutoBrazier" title="AutoBrazier Mod Link">AutoBrazier</a>,
					<a href="https://thunderstore.io/c/v-rising/p/zfolmt/AutoCloseDoors" title="AutoCloseDoors Mod Link">AutoCloseDoors</a>,
					<a href="https://thunderstore.io/c/v-rising/p/zfolmt/Bloodcraft" title="Bloodcraft Mod Link">Bloodcraft</a>,
					<a href="https://thunderstore.io/c/v-rising/p/zfolmt/Eclipse" title="Eclipse Mod Link">Eclipse</a>,
					<a href="https://thunderstore.io/c/v-rising/p/zfolmt/KindredLogistics" title="KindredLogistics Mod Link">KindredLogistics</a>,
					<a href="https://thunderstore.io/c/v-rising/p/zfolmt/ScarletMarket" title="ScarletMarket Mod Link">ScarletMarket</a>
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