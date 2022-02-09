@ECHO OFF
cd..
php artisan optimize:clear
php artisan test
php artisan optimize
pause
