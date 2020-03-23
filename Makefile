install:
	composer install

run:
	php artisan games:rsp:play 100

test:
	vendor/bin/phpunit
