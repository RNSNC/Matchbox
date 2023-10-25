up:
	sudo docker compose -f ./docker/docker-compose.yml up -d

bash:
	sudo docker compose -f ./docker/docker-compose.yml exec php bash

build:
	cp .env.dist .env
	yes | bin/console doctrine:migrations:migrate
	yes | bin/console doctrine:fixtures:load

