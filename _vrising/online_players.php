<?php
$lines = count(file('_vrising/online_players.txt'));
echo max(0, $lines - 1);