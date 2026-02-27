<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Playground</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="MBG Playground is a collection of media and game servers to enjoy with friends.">
		<meta property="og:title" content="MBG Playground">
		<meta property="og:description" content="MBG Playground is a collection of media and game servers to enjoy with friends.">
		<meta property="og:url" content="<?=URL_MBGPLAYGROUND?>">
		<meta property="og:image" content="<?=URL_MBGPLAYGROUNDLOGO?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_MBGPLAYGROUND?>">
		<link rel="icon" href="<?=URL_MBGPLAYGROUNDLOGO?>" type="image/png">
		<link rel="stylesheet" href="<?=URL_CSSHOME?>">
	</head>
	<body>
		<canvas id="dust"></canvas>
		<div class="section">
			<h1>MBG Playground</h1>
		</div>
		<div class="container">
			<a class="card" href="/counterstrike">
				<div class="game-card">
					<div id="status-counterstrike"></div>
					<div id="latency-counterstrike"></div>
					<img src="<?=URL_COUNTERSTRIKEBANNER?>" alt="Counter-Strike">
				</div>
				<div class="card-title">Counter-Strike</div>
			</a>
			<a class="card" href="/hytale">
				<div class="game-card">
					<div id="status-hytale"></div>
					<div id="latency-hytale"></div>
					<img src="<?=URL_HYTALEBANNER?>" alt="Hytale">
				</div>
				<div class="card-title">Hytale</div>
			</a>
			<a class="card" href="/projectzomboid">
				<div class="game-card">
					<div id="status-projectzomboid"></div>
					<div id="latency-projectzomboid"></div>
					<img src="<?=URL_PROJECTZOMBOIDBANNER?>" alt="Project Zomboid">
				</div>
				<div class="card-title">Project Zomboid</div>
			</a>
			<a class="card" href="/vrising">
				<div class="game-card">
					<div id="status-vrising"></div>
					<div id="latency-vrising"></div>
					<img src="<?=URL_VRISINGBANNER?>" alt="V Rising">
				</div>
				<div class="card-title">V Rising</div>
			</a>
		</div>
		<a href="<?=URL_DISCORD?>" class="discord-button">
			<img src="<?=URL_DISCORDLOGO?>" alt="Discord Logo" class="discord-icon">
			Join Discord
		</a>
		<footer>
			<?php include PATH_LICENSING?>
		</footer>
		<?php include PATH_GOOGLETAG?>
		<script>
			async function loadServerMetrics() {
				const requestCounterStrike = await fetch('<?=URL_SERVERMETRICS?>?server=counterstrike', {cache: 'no-store'});
				const dataCounterStrike = await requestCounterStrike.json();
				document.getElementById('status-counterstrike').innerHTML = dataCounterStrike.status_indicator;
				document.getElementById('latency-counterstrike').innerHTML = dataCounterStrike.latency_indicator;
				// console.log(dataCounterStrike);

				const requestHytale = await fetch('/.common/servermetrics.php?server=hytale', {cache: 'no-store'});
				const dataHytale = await requestHytale.json();
				document.getElementById('status-hytale').innerHTML = dataHytale.status_indicator;
				document.getElementById('latency-hytale').innerHTML = dataHytale.latency_indicator;
				// console.log(dataHytale);

				const requestProjectZomboid = await fetch('/.common/servermetrics.php?server=projectzomboid', {cache: 'no-store'});
				const dataProjectZomboid = await requestProjectZomboid.json();
				document.getElementById('status-projectzomboid').innerHTML = dataProjectZomboid.status_indicator;
				document.getElementById('latency-projectzomboid').innerHTML = dataProjectZomboid.latency_indicator;
				// console.log(dataProjectZomboid);

				const requestVRising = await fetch('/.common/servermetrics.php?server=vrising', {cache: 'no-store'});
				const dataVRising = await requestVRising.json();
				document.getElementById('status-vrising').innerHTML = dataVRising.status_indicator;
				document.getElementById('latency-vrising').innerHTML = dataVRising.latency_indicator;
				// console.log(dataVRising);
			}
			setInterval(loadServerMetrics, 5000);
			loadServerMetrics();
		</script>
		<script async src="<?=URL_JSDUST?>"></script>
	</body>
</html>