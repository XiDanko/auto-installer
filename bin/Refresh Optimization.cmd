@ECHO OFF
cd..
php artisan optimize:clear
php artisan opcache:clear

php artisan optimize
php artisan opcache:compile
pause
