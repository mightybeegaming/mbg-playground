@echo off

echo Checking players...
rem python rcon.py amx_who 
python rcon.py amx_who > online_players.txt

exit