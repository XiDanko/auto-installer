@ECHO OFF
cd..
echo Optimizing composer autoloader
call composer update --no-dev --optimize-autoloader --no-interaction

echo Coping production env...
copy .env.prod .env

echo Coping production rr.yaml
copy .rr.prod.yaml .rr.yaml

echo Deleting unwanted files...
powershell -Command "Remove-Item 'storage/framework/sessions/*' -Recurse -Force"
powershell -Command "Remove-Item 'storage/framework/cache/data/*' -Recurse -Force"

pause
