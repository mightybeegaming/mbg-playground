<?php
$lines = count(file('_projectzomboid/online_players.txt'));
echo max(0, $lines - 1);