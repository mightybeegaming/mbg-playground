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
				box-shadow: 0 0 30px #ff9a67;
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
			.game-card img {
				filter: grayscale(0.25);
			}
			.game-card:hover img {
				filter: grayscale(0);
			}
			.status {
				position: absolute;
				padding: 4px 8px;
				font-size: 0.8em;
				font-weight: bold;
				border-radius: 6px;
				z-index: 2;
			}
			.status {
				bottom: 10px;
				right: 8px;
			}
			.status-online {
				background: #00aeae;
			}
			.status-offline {
				background: #ae0000;
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
					<div class="status" status-monitor-id="71"></div>
					<img src="<?=URL_COUNTERSTRIKEBANNER?>" alt="Counter-Strike">
				</div>
				<div class="card-title">Counter-Strike</div>
			</a>
			<!-- Hytale -->
			<a class="card" href="/hytale">
				<div class="game-card">
					<div class="status" status-monitor-id="73"></div>
					<img src="<?=URL_HYTALEBANNER?>" alt="Hytale">
				</div>
				<div class="card-title">Hytale</div>
			</a>
			<!-- Project Zomboid -->
			<a class="card" href="/projectzomboid">
				<div class="game-card">
					<div class="status" status-monitor-id="75"></div>
					<img src="<?=URL_PROJECTZOMBOIDBANNER?>" alt="Project Zomboid">
				</div>
				<div class="card-title">Project Zomboid</div>
			</a>
			<!-- V Rising -->
			<a class="card" href="/vrising">
				<div class="game-card">
					<div class="status" status-monitor-id="58"></div>
					<img src="<?=URL_VRISINGBANNER?>" alt="V Rising">
				</div>
				<div class="card-title">V Rising</div>
			</a>
		</div>
		<br><br>
		<div class="container">
			<!-- Discord -->
			<a class="card" href="/counterstrike">
				<img src="<?=URL_DISCORDBANNER?>" alt="Discord">
				<div class="card-title">Discord</div>
			</a>
		</div>
		<footer>
			<?php include PATH_LICENSING?>
		</footer>
		<?php include PATH_GOOGLETAG?>
		<script>
			function getOnlinePlayers(id) {
				let requestUrl = '';
				switch(id){
					case '71':
						requestUrl = '<?=URL_INITIALIZECOUNTERSTRIKE?>';
						break;
					case '73':
						requestUrl = '<?=URL_INITIALIZEHYTALE?>';
						break;
					case '75':
						requestUrl = '<?=URL_INITIALIZEPROJECTZOMBOID?>';
						break;
					case '58':
						requestUrl = '<?=URL_INITIALIZEVRISING?>';
						break;
				}

				if(!requestUrl) return;
				
				var request = new XMLHttpRequest();
				request.open('GET', requestUrl, false);
				request.send(null);

				if(request.status === 200) {
					const data = JSON.parse(request.responseText);

					return parseInt(data.online_players);
				} else {
					console.error('Error loading server info:', request.statusText);
				}
			}

			async function updateStatus() {
				try {
					const serverStatus = await fetch('<?=URL_SERVERSTATUS?>', {cache: 'no-store'});
					const data = await serverStatus.json();
					const heartbeatList = data.heartbeatList;

					Object.keys(heartbeatList).forEach(id => {
						const heartbeatLength = heartbeatList[id].length - 1;
						const isOnline = heartbeatList[id][heartbeatLength].status;

						const statusElement = document.querySelector(`[status-monitor-id="${id}"]`);
						if(!statusElement) return;

						const players = getOnlinePlayers(id);
						const isOnlineString = players ? `${players} ONLINE` : 'ONLINE';
						
						statusElement.textContent = isOnline ? isOnlineString : 'OFFLINE';
						statusElement.classList.remove('status-online', 'status-offline');
						statusElement.classList.add(isOnline ? 'status-online' : 'status-offline');
					});
				} catch(error) {
					console.error('Error loading server info:', error);
				}
			}
			updateStatus();
			setInterval(updateStatus, 1000);
		</script>
	</body>
</html>
