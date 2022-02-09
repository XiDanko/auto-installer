@ECHO OFF
setlocal
:PROMPT
SET /P AREYOUSURE=Are you sure you want to reset all database data? (Y/N):
IF /I "%AREYOUSURE%" NEQ "Y" GOTO END

cd..
php artisan migrate:fresh --seed
pause

:END
endlocal