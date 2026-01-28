<?php
$lines = count(file('data_projectzomboid/online_players_b42.txt'));
echo max(0, $lines - 1);