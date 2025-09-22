dev:
	php artisan serve
	npm run build
install:
	composer install
	touch database/database.sqlite
	php artisan migrate
	npm ci
	npm run build
lint:
	composer phpcs
start:
	php artisan serve --host=0.0.0.0 --port=$PORT
db-prepare:
	php artisan migrate
build: install db-prepare
test:
	php artisan test