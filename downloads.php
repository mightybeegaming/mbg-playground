<?php
function formatSize($bytes){
    if($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
    if($bytes >= 1048576) return number_format($bytes / 1048576, 2) . ' MB';
    if($bytes >= 1024) return number_format($bytes / 1024, 2) . ' KB';
    return $bytes . ' B';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MBG Downloads</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="This is the official consolidated downloads page for MBG Playground.">
		<meta property="og:title" content="MBG Downloads">
		<meta property="og:description" content="This is the official consolidated downloads page for MBG Playground.">
		<meta property="og:url" content="<?=URL_DOWNLOADS?>">
		<meta property="og:image" content="<?=URL_MBGPLAYGROUNDLOGO?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_DOWNLOADS?>">
		<link rel="icon" href="<?=URL_MBGPLAYGROUNDLOGO?>" type="image/png">
		<link rel="stylesheet" href="<?=URL_CSS?>">
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
				<h1>MBG Downloads</h1>
				<table class="file-table" id="fileTable">
					<thead>
						<tr>
							<th class="align-left"><span class="sort-label" onclick="sortTable(0)">Name</span> <span id="sort-indicator-0"></span></th>
							<th class="align-right"><span id="sort-indicator-1"></span> <span class="sort-label" onclick="sortTable(1)">Size</span></th>
							<th class="align-right"></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach(scandir(PATH_DOWNLOADS) as $file):?>
						<?php $file_full_path = PATH_DOWNLOADS . '/' . $file?>
						<?php if(!is_file($file_full_path)) continue?>
						<tr>
							<td><?=htmlspecialchars($file)?></td>
							<td class="file-size align-right"><?=formatSize(filesize($file_full_path))?></td>
							<td class="align-right">
								<span class="highlight"><a href="<?=URL_DOWNLOADS?>/<?=urlencode($file)?>" download>Download</a></span>
							</td>
						</tr>
					<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
	<?php include PATH_FOOTER?>
	<?php include PATH_GOOGLETAG?>
	<script>
		let sortDir = {};

		function parseSize(size){
			const unit = size.slice(-2).toUpperCase();
			const value = parseFloat(size);
			if(unit === 'KB') return value * 1024;
			if(unit === 'MB') return value * 1024 * 1024;
			if(unit === 'GB') return value * 1024 * 1024 * 1024;
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
					? x.localeCompare(y, undefined, {numeric: true, sensitivity: 'base'})
					: y.localeCompare(x, undefined, {numeric: true, sensitivity: 'base'});
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