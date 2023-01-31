docker-build:
	docker-compose build && docker-compose up -d

env-dev:
	docker-compose exec app bash -c "cp .env.dev .env"

composer-install:
	docker-compose exec app bash -c "composer install"

optimize:
	docker-compose exec app bash -c "php artisan config:clear && php artisan cache:clear && php artisan view:clear"

key-generate:
	docker-compose exec app bash -c "php artisan key:generate"

seed:
	docker-compose exec app bash -c "php artisan db:seed DatabaseSeeder"

admin-install:
	docker-compose exec app bash -c "php artisan admin:install"

admin-user:
	docker-compose exec app bash -c "php artisan admin:user"

npm-build:
	docker-compose exec app bash -c "npm i && npm run build"

down:
	docker-compose down

restart:
	docker-compose restart

dev:
	docker-compose up -d

npm-dev:
	docker-compose exec app bash -c "npm run dev"

migrate:
	docker-compose exec app bash -c "php artisan migrate"

migrate-fresh:
	docker-compose exec app bash -c "php artisan migrate:fresh"

generate-admin-menu:
	docker-compose exec app bash -c "php artisan admin:generate-menu"

build-dev: docker-build npm-build env-dev composer-install key-generate optimize migrate-fresh admin-install generate-admin-menu seed
