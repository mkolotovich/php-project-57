dev:
	php artisan serve
	npm run build
install:
	composer install
	cp -n .env.example .env
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	npm ci
	npm run build
lint:
	composer phpcs
	vendor/bin/phpstan --memory-limit=2G --ansi analyse
start:
	php artisan serve --host=0.0.0.0 --port=$PORT
db-prepare:
	php artisan migrate
build: install db-prepare
test:
	php artisan test