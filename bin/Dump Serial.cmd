@ECHO OFF
wmic diskdrive get serialnumber > Serial.txt
echo Done!
pause