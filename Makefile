up:
	cd .docker && docker-compose up --build -d

down:
	cd .docker && docker-compose down

restart:
	cd .docker && docker-compose restart

reboot:
	make down
	make up

install:
	make up
	docker exec recipes-generator_application_1 sh -c "composer create-project"
	docker exec recipes-generator_application_1 sh -c "php artisan migrate --seed"

php:
	docker exec -it recipes-generator_application_1 sh
