@echo off

echo Checking players...
call "C:\Other Programs\_tools\rcon\_config-projectzomboid.bat"
rem rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "players"
rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "players" > online_players.txt

echo Checking PvP players...
call "C:\Other Programs\_tools\rcon\_config-projectzomboid-pvp.bat"
rem rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "players"
rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "players" > online_players_pvp.txt

rem pause
exit