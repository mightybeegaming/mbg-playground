<?php
$lines = count(file('data_vrising/online_players.txt'));
echo max(0, $lines - 1);
?>