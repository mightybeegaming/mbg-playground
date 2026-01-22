<?php
$lines = count(file('data_projectzomboid/online_players_pvp.txt'));
echo max(0, $lines - 1);