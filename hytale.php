<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Hytale</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a simple Hytale server to test and explore the early access build." />
		<meta property="og:title" content="MBG Hytale Server" />
		<meta property="og:description" content="This is a simple Hytale server to test and explore the early access build." />
		<meta property="og:url" content="https://mbgplayground.xyz/hytale" />
		<meta property="og:image" content="data_hytale/hytalebanner.jpg" />
		<meta property="og:type" content="website" />
		<link rel="canonical" href="https://mbgplayground.xyz/hytale" />
		<link rel="icon" href="icon.png" type="image/png">
		<link rel="stylesheet" href="common.css">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h3>MBG Hytale</h3>
				<?php include 'join.php'?>
			</div>
			<div class="section">
				<h3>Server Information</h3>
				<ul>
					<li>This is a simple Hytale server to test and explore the early access build.</li>
					<li>Online Players: <span class="highlight">N/A</span></li>
				</ul>
				<div class="info-grid">
					<div class="info-box">
						<strong>Status</strong><br>
						<span class="highlight">N/A</span>
					</div>
					<div class="info-box">
						<strong>Uptime</strong><br>
						<span class="highlight">N/A</span>
					</div>
					<div class="info-box">
						<strong>Latency</strong><br>
						<span class="highlight">N/A</span>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php include 'footer.php'?>
	<?php include 'gtag.php'?>
</html>