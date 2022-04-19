# Petitions API

REST API which lets client get all and add petitions

## Steps to build
- clone the repository
- create an .env file from .env.example `cp .env.example .env`
- install docker [here](https://docs.docker.com/get-docker/) and docker-compose [here](https://docs.docker.com/compose/install/)
- clone repository
- go to folder location in your computer and run `docker-compose up -d --build`
- the API will be served at http://localhost:7777

## Create entities
- to populate the database, log in to the container `docker exec -ti petitions_app_1 php bin/console doctrine:migrations:migrate`, "petition_app_1" is 
  the name of the container, but it could be different for you