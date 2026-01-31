@echo off

echo Checking players...
call "C:\Other Programs\_tools\rcon\_config-projectzomboid.bat"
rem rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "players"
rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "players" > online_players.txt

rem pause
exit