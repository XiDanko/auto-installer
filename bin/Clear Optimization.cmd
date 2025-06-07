@ECHO OFF
cd..
php artisan optimize:clear
php artisan opcache:clear
pause
