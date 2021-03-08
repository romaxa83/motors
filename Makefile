
.SILENT:

include .env

#=============VARIABLES================
php_container = ${APP_NAME}__php-fpm
node_container = ${APP_NAME}__node
db_container = ${APP_NAME}__db
redis_container = ${APP_NAME}__redis
#======================================

#=====MAIN_COMMAND=====================

.PHONY: init
init: down-clear up_docker app-init ps info

.PHONY: up
up: up_docker info

.PHONY: rebuild
rebuild: down build up_docker info

.PHONY: up_docker
up_docker:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down --remove-orphans

# флаг -v удаляет все volume (очищает все данные)
.PHONY: down-clear
down-clear:
	docker-compose down -v --remove-orphans

.PHONY: build
build:
	docker-compose build

.PHONY: ps
ps:
	docker-compose ps

.PHONY: cp-env
cp-env:
	cp .env.example .env

run_test:
	docker-compose run --rm php-fpm ./vendor/bin/phpunit

#=======COMMAND_FOR_APP================

app-init: composer-install project-init perm

composer-install:
	docker-compose run --rm php-fpm composer install

project-init:
	docker-compose run --rm php-fpm php artisan key:generate
	docker-compose run --rm php-fpm php artisan migrate
	docker-compose run --rm php-fpm php artisan am:init
	docker-compose run --rm php-fpm php artisan db:seed
	docker-compose run --rm php-fpm composer ide

perm:
	sudo chmod 777 -R storage

#=======INTO_CONTAINER=================

php_bash:
	docker exec -it $(php_container) bash

node_bash:
	docker exec -it $(node_container) sh

db_bash:
	docker exec -it $(db_container) sh
#=======FOR_TEST=================

test_app_init:
	docker-compose run --rm php-fpm php artisan key:generate --env=testing -n
	docker-compose run --rm php-fpm php artisan migrate -n --env=testing
#=======INFO===========================

.PHONY: info
info:
	echo '------------------------------------------------------';
	echo ${APP_URL};
	echo ${APP_URL}'/graphql-playground';

.DEFAULT_GOAL := init
