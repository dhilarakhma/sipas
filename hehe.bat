@echo "Silakan tunggu, ini akan cukup lama tergantung dari spesifikasi komputer atau laptop anda"
call composer dump-autoload
call php artisan vendor:publish --tag=stisla.all --force
call php artisan migrate:refresh --seed --force