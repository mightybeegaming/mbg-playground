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
		<style>
			@import url("https://fonts.googleapis.com/css?family=Montserrat:600,400");
			body {
				margin: 0;
				font-family: "Montserrat" !important;
				color: white;
				text-align: center;

				background-color: #2a2a2a;
				background-image: radial-gradient(
					rgba(255,255,255,0.08) 1px,
					transparent 1px
				);
				background-size: 30px 30px;
			}
			h1 {
				color: #ff9a67;
				margin: 20px 0;
			}
			.container {
				display: flex;
				justify-content: center;
				padding: 0px;
				gap: 40px;
				flex-wrap: wrap;
			}
			.card {
				width: 368px;
				text-decoration: none;
				color: white;
				background: #1a1a1a;
				border-radius: 14px;
				overflow: hidden;
				transition: transform 0.3s ease, box-shadow 0.3s ease;
				position: relative;
			}
			.card .game-card::after {
				content: 'PLAY';
				position: absolute;
				inset: 0; /* top:0; right:0; bottom:0; left:0 */
				display: flex;
				align-items: center;
				justify-content: center;
				font-size: 5em;
				font-weight: bold;
				letter-spacing: 5px;
				background: rgba(0,0,0,0.75);
				opacity: 0;
				transition: opacity 0.3s ease;
				text-shadow:
					0 0 5px #00aeae,
					0 0 10px #00aeae,
					0 0 20px #00aeae,
					0 0 40px #00aeae,
					0 0 80px #00aeae;
			}
			.card:hover .game-card::after {
				opacity: 1;
			}
			.card:hover .game-card img {
				filter: grayscale(1);
			}
			.card img {
				width: 100%;
				height: 172px;
				object-fit: cover;
			}
			.card-title {
				color: #00aeae;
				padding: 10px;
				font-size: 1em;
				font-weight: bold;
			}
			.card:hover {
				box-shadow: 0 0 15px #00aeae;
				transform: scale(1.05);
			}
			footer {
				margin-top: 20px;
				text-align: center;
				padding: 15px;
				font-size: 0.9em;
				color: #888;
			}
			.section {
				background-color: #1a1a1a;
				border-radius: 8px;
				padding: 1px 0px;
				margin: 20px auto 20px auto;
				width: 368px;
			}
			.section h3, h2, h1 {
				font-size: 1.5em;
				color: #ff9a67;
			}
			a {
				color: #00aeae;
			}
			a:link, a:visited, a:active {
				text-decoration: none;
			}
			footer a:hover {
				text-decoration: underline;
			}
			.game-card {
				position: relative;
				overflow: hidden;
			}
			.status {
				position: absolute;
				padding: 4px 8px;
				font-size: 0.8em;
				font-weight: bold;
				border-radius: 6px;
				z-index: 2;
				bottom: 10px;
				right: 8px;
			}
			.status-online {
				background: #00aeae;
			}
			.status-offline {
				background: #ae0000;
			}
			.discord-button {
				display: inline-flex;
				align-items: center;
				background: linear-gradient(135deg, #5865f2, #7289da);
				color: white;
				font-weight: bold;
				padding: 12px 24px;
				border-radius: 8px;
				text-decoration: none;
				transition: all 0.3s ease;
				box-shadow: 0 6px 12px rgba(0,0,0,0.2);
				font-size: 1em;
				margin-top: 40px;
			}
			.discord-button .discord-icon {
				transition: transform 0.3s ease;
			}
			.discord-icon {
				margin-right: 10px;
				width: 30px;
				height: 30px;
			}
			.discord-button:hover {
				transform: translateY(-2px);
				box-shadow: 0 10px 20px rgba(0,0,0,0.3);
				background: linear-gradient(135deg, #7289da, #5865f2);
			}
			.discord-button:hover .discord-icon {
				transform: rotate(-15deg);
			}
		</style>
	</head>
	<body>
		<div class="section">
			<h1>MBG Playground</h1>
		</div>
		<div class="container">
			<!-- Counter-Strike -->
			<a class="card" href="/counterstrike">
				<div class="game-card">
					<div id="status-counterstrike"></div>
					<img src="<?=URL_COUNTERSTRIKEBANNER?>" alt="Counter-Strike">
				</div>
				<div class="card-title">Counter-Strike</div>
			</a>
			<!-- Hytale -->
			<a class="card" href="/hytale">
				<div class="game-card">
					<div id="status-hytale"></div>
					<img src="<?=URL_HYTALEBANNER?>" alt="Hytale">
				</div>
				<div class="card-title">Hytale</div>
			</a>
			<!-- Project Zomboid -->
			<a class="card" href="/projectzomboid">
				<div class="game-card">
					<div id="status-projectzomboid"></div>
					<img src="<?=URL_PROJECTZOMBOIDBANNER?>" alt="Project Zomboid">
				</div>
				<div class="card-title">Project Zomboid</div>
			</a>
			<!-- V Rising -->
			<a class="card" href="/vrising">
				<div class="game-card">
					<div id="status-vrising"></div>
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
				const requestCounterStrike = await fetch('/.common/servermetrics.php?server=counterstrike', {cache: 'no-store'});
				const dataCounterStrike = await requestCounterStrike.json();
				document.getElementById('status-counterstrike').innerHTML = dataCounterStrike.status_indicator;
				// console.log(dataCounterStrike);

				const requestHytale = await fetch('/.common/servermetrics.php?server=hytale', {cache: 'no-store'});
				const dataHytale = await requestHytale.json();
				document.getElementById('status-hytale').innerHTML = dataHytale.status_indicator;
				// console.log(dataHytale);

				const requestProjectZomboid = await fetch('/.common/servermetrics.php?server=projectzomboid', {cache: 'no-store'});
				const dataProjectZomboid = await requestProjectZomboid.json();
				document.getElementById('status-projectzomboid').innerHTML = dataProjectZomboid.status_indicator;
				// console.log(dataProjectZomboid);

				const requestVRising = await fetch('/.common/servermetrics.php?server=vrising', {cache: 'no-store'});
				const dataVRising = await requestVRising.json();
				document.getElementById('status-vrising').innerHTML = dataVRising.status_indicator;
				// console.log(dataVRising);
			}
			setInterval(loadServerMetrics, 1000);
			loadServerMetrics();
		</script>
	</body>
</html>
