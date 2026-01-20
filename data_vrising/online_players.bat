@echo off

call "C:\Other Programs\_tools\rcon\_config-vrising.bat"

echo Checking players...
rem rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "listplayers"
rcon -a %IPAddress%:%RCONPort% -p %RCONPassword% "listplayers" > online_players.txt

exit