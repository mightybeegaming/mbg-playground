@echo off

call "C:\Other Programs\_tools\rcon\_config-hytale.bat"

echo Checking players...
rem rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "who"
rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "who" > online_players.txt

exit