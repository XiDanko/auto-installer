@ECHO OFF
cd..
echo Optimizing composer autoloader
composer update --no-dev --optimize-autoloader

echo Coping production env...
copy .env.prod .env

echo Coping production rr.yaml
copy .rr.prod.yaml .rr.yaml

echo Deleting unwanted files...
powershell -Command "Remove-Item 'storage/framework/sessions/*' -Recurse -Force"
powershell -Command "Remove-Item 'storage/framework/cache/data/*' -Recurse -Force"

pause
