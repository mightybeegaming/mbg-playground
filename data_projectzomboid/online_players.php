<?php
$lines = count(file('data_projectzomboid/online_players.txt'));
echo max(0, $lines - 1);
?>