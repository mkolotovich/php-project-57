dev:
	php artisan serve
	npm run build
install:
	composer install
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app database lang routes tests
start:
	php artisan serve --host=0.0.0.0 --port=$PORT
db-prepare:
	php artisan migrate
build: install db-prepare
test:
	php artisan test