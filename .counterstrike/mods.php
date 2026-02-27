<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Counter-Strike Mods</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Mod collection for the MBG Counter-Strike dedicated server.">
		<link rel="icon" href="/.media/mbgplaygroundlogo.png" type="image/png">
		<link rel="stylesheet" href="/.common/style.css">
	</head>
	<body>
		<canvas id="dust"></canvas>
		<div class="container">
			<div class="section">
				<h1>MBG Counter-Strike Mods</h1>
				<p>Mod collection for MBG Counter-Strike dedicated server.</p>
			</div>
			<div class="section">
				<h1>Mod Collection</h1>
				<?php include 'modlist.htm'?>
			</div>
		</div>
		<footer>
			<?php include '../.common/licensing.php'?>
		</footer>
		<?php include '../.common/gtag.php'?>
		<script async src="../.common/dust.js"></script>
	</body>
</html>