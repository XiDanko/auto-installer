@ECHO OFF
cd..
php artisan optimize
php artisan opcache:compile
pause
