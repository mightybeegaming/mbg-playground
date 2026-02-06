<?php
function formatSize($bytes){
    if($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
    if($bytes >= 1048576) return number_format($bytes / 1048576, 2) . ' MB';
    if($bytes >= 1024) return number_format($bytes / 1024, 2) . ' KB';
    return $bytes . ' B';
}

$files = scandir(__DIR__);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Downloads</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is the official consolidated downloads page for MBG Playground." />
		<meta property="og:title" content="MBG Downloads" />
		<meta property="og:description" content="This is the official consolidated downloads page for MBG Playground." />
		<meta property="og:url" content="https://mbgplayground.xyz/downloads" />
		<meta property="og:image" content="https://i.postimg.cc/dtt48zrp/game-controller-orange.png" />
		<meta property="og:type" content="website" />
		<link rel="canonical" href="https://mbgplayground.xyz/downloads" />
		<link rel="icon" href="../_common/icon.png" type="image/png">
		<link rel="stylesheet" href="../_common/style.css">
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
			.sort-label {
				cursor: pointer;
				user-select: none;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="section">
				<h3>MBG Downloads</h3>
				<table class="file-table" id="fileTable">
					<thead>
						<tr>
							<th class="align-left"><span class="sort-label" onclick="sortTable(0)">Name</span> <span id="sort-indicator-0"></span></th>
							<th class="align-right"><span id="sort-indicator-1"></span> <span class="sort-label" onclick="sortTable(1)">Size</span></th>
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
	<?php include '../_common/footer.php'?>
	<?php include '../_common/gtag.php'?>
	<script>
		let sortDir = {};

		function parseSize(size){
			const unit = size.slice(-2).toUpperCase();
			const value = parseFloat(size);
			if (unit === 'KB') return value * 1024;
			if (unit === 'MB') return value * 1024 * 1024;
			if (unit === 'GB') return value * 1024 * 1024 * 1024;
			return value;
		}

		function sortTable(col){
			const table = document.getElementById("fileTable");
			const tbody = table.tBodies[0];
			const rows = Array.from(tbody.rows);

			sortDir[col] = !sortDir[col];

			rows.sort((a, b) => {
				let x = a.cells[col].innerText.trim();
				let y = b.cells[col].innerText.trim();

				if(col === 1){
					x = parseSize(x);
					y = parseSize(y);
					return sortDir[col] ? x - y : y - x;
				}

				return sortDir[col]
					? x.localeCompare(y, undefined, { numeric: true, sensitivity: 'base' })
					: y.localeCompare(x, undefined, { numeric: true, sensitivity: 'base' });
			});

			tbody.append(...rows);

			for(let i = 0; i < 2; i++) {
				const ind = document.getElementById(`sort-indicator-${i}`);
				if(!ind) continue;
				if(i === col) ind.innerText = sortDir[col] ? '▲' : '▼';
				else ind.innerText = '';
			}
		}
	</script>
</html>