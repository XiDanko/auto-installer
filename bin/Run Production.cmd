@ECHO OFF
cd..
call php artisan optimize:clear
echo Optimizing composer autoloader
call composer update --no-dev --optimize-autoloader --no-interaction

echo Coping production env...
copy .env.production .env

echo Deleting unwanted files...
rm ".env.production"
powershell -Command "Remove-Item 'bootstrap/cache/*' -Recurse -Force"
powershell -Command "Remove-Item 'storage/framework/cache/data/*' -Recurse -Force"
powershell -Command "Remove-Item 'storage/framework/sessions/*' -Recurse -Force"
powershell -Command "Remove-Item 'storage/framework/views/*' -Recurse -Force"

pause
