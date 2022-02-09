@ECHO OFF
cd..
php artisan app:install-echo-server
php artisan app:create-echo-service
pause
