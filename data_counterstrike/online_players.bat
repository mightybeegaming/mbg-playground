@echo off

echo Checking players...
rem python rcon_cs.py amx_who 
python rcon_cs.py amx_who > online_players.txt

exit