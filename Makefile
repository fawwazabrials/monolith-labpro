setup:
	@make build
	@make up
	@make composer-setup
	@make data
	@echo Setup successful
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
copy-env:
	cp .env src/.env
composer-setup:
	docker exec -it --user=root monolith-labpro-app-1 chmod -R 777 /var/www/storage
	docker exec monolith-labpro-app-1 bash -c "composer install"
	docker exec monolith-labpro-app-1 bash -c "php artisan key:generate"
data:
	docker exec monolith-labpro-app-1 bash -c "php artisan migrate:fresh --seed"