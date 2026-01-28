@echo off

echo Checking players...
call "C:\Other Programs\_tools\rcon\_config-projectzomboid.bat"
rem rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "players"
rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "players" > online_players.txt

echo Checking B42 players...
call "C:\Other Programs\_tools\rcon\_config-projectzomboidb42.bat"
rem rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "players"
rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "players" > online_players_b42.txt

rem pause
exit