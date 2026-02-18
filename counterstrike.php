<?php
$online_players = 0;

$file = file(PATH_ONLINECOUNTERSTRIKE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach($file as $line) {
    $line = trim($line);

    if(
        $line === '' ||
        str_starts_with($line, 'Clients') ||
        str_starts_with($line, '#') ||
        str_starts_with($line, 'Total') ||
        str_starts_with($line, 'L ')
    ) {
        continue;
    }

    if(preg_match('/(STEAM_\d:\d:\d+)/', $line, $matches)) $online_players++;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Counter-Strike</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is a simple Counter-Strike server with PodBot addon.">
		<meta property="og:title" content="MBG Counter-Strike">
		<meta property="og:description" content="This is a simple Counter-Strike server with PodBot addon.">
		<meta property="og:url" content="<?=URL_COUNTERSTRIKE?>">
		<meta property="og:image" content="<?=URL_COUNTERSTRIKEBANNER?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_COUNTERSTRIKE?>">
		<link rel="icon" href="<?=URL_MBGPLAYGROUNDLOGO?>" type="image/png">
		<link rel="stylesheet" href="<?=URL_CSS?>">
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h1>MBG Counter-Strike</h1>
				<p>This is a simple Counter-Strike server with PodBot addon.</p>
			</div>
			<div class="section">
				<h1>Server Information</h1>
				<?php include PATH_JOIN?>
				<div class="info-grid">
					<div class="info-box">
						<strong>Status</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/71/status?style=for-the-badge" alt="Status">
					</div>
					<div class="info-box">
						<strong>Uptime</strong><br>
						<img src="https://uptime.mbgplayground.xyz/api/badge/71/uptime?style=for-the-badge" alt="Uptime">
					</div>
					<div class="info-box">
						<strong>Online Players</strong><br>
						<span class="highlight"><?=$online_players?> / 32</span>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<?php include PATH_NAVBAR?>
			<?php include PATH_LICENSING?>
		</footer>
		<?php include PATH_GOOGLETAG?>
	</body>
</html>