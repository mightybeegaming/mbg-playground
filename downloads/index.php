<?php
$files = scandir(__DIR__);

function formatSize($bytes) {
    if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
    if ($bytes >= 1048576)  return number_format($bytes / 1048576, 2) . ' MB';
    if ($bytes >= 1024)     return number_format($bytes / 1024, 2) . ' KB';
    return $bytes . ' B';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MBG Downloads</title>
		<link rel="icon" href="../icon.png" type="image/png">
		<link rel="stylesheet" href="../common.css">
		<style>
			.file-table {
				width: 100%;
				border-collapse: collapse;
			}
			.file-table th {
				color: #ff9a67;
				border-bottom: 1px solid #333;
				padding: 0px;
			}
			.file-table td {
				padding: 10px 0;
				border-bottom: 1px solid #222;
			}
			.file-table tbody tr:hover {
				background-color: #121212;
			}
			.file-size {
				white-space: nowrap;
				color: #ccc;
			}
			.align-right {
				text-align: right;
			}
			.align-left {
				text-align: left;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h3>MBG Downloads</h3>
				<table class="file-table">
					<thead>
						<tr>
							<th class="align-left">Name</th>
							<th class="align-right">Size</th>
							<th class="align-right"></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($files as $file): ?>
						<?php
						if ($file === 'index.php' || !is_file($file)) continue;
						?>
						<tr>
							<td><?= htmlspecialchars($file) ?></td>
							<td class="file-size align-right"><?= formatSize(filesize($file)) ?></td>
							<td class="align-right">
								<span class="highlight"><a href="<?= urlencode($file) ?>" download>Download</a></span>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
	<?php include '../footer.php'?>
	<?php include '../gtag.php'?>
</html>