clone 
prepare .env
composer install
php artisan storage
php artisan migrate --seed
