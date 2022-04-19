# Petitions API

REST API which lets client get all and add petitions

## Steps to build
- clone the repository
- create an .env file from .env.example `cp .env.example .env`
- install docker [here](https://docs.docker.com/get-docker/) and docker-compose [here](https://docs.docker.com/compose/install/)
- run `docker-compose up -d --build`
- install all bundles `docker exec -ti petitions_app_1 composer install`
- to populate the database, log in to the container `docker exec -ti petitions_app_1 php bin/console doctrine:migrations:migrate`
- the API will be served at http://localhost:7777
