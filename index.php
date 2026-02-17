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
				background: #2a2a2a;
				color: white;
				text-align: center;
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
				transform: scale(1.06);
				box-shadow: 0 15px 40px rgba(0,0,0,0.6);
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
		</style>
	</head>
	<body>
		<div class="section">
			<h1>MBG Playground</h1>
		</div>
		<div class="container">
			<!-- Counter-Strike -->
			<a class="card" href="/counterstrike">
				<img src="<?=URL_COUNTERSTRIKEBANNER?>" alt="Counter-Strike">
				<div class="card-title">Counter-Strike</div>
			</a>
			<!-- Hytale -->
			<a class="card" href="/hytale">
				<img src="<?=URL_HYTALEBANNER?>" alt="Hytale">
				<div class="card-title">Hytale</div>
			</a>
			<!-- Project Zomboid -->
			<a class="card" href="/projectzomboid">
				<img src="<?=URL_PROJECTZOMBOIDBANNER?>" alt="Project Zomboid">
				<div class="card-title">Project Zomboid</div>
			</a>
			<!-- V Rising -->
			<a class="card" href="/vrising">
				<img src="<?=URL_VRISINGBANNER?>" alt="V Rising">
				<div class="card-title">V Rising</div>
			</a>
		</div>
		<br><br>
		<div class="container">
			<!-- Discord -->
			<a class="card" href="/discord">
				<img src="<?=URL_DISCORDBANNER?>" alt="Discord">
				<div class="card-title">Discord</div>
			</a>
		</div>
		<footer>
			<?php include PATH_LICENSING?>
		</footer>
		<?php include PATH_GOOGLETAG?>
	</body>
</html>
