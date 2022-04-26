# Petitions API

REST API which lets client get all and add petitions

## Steps to build

*Note: petitions_app_1 is the name of the spinned container, it might be different for you if you've cloned the 
repository into a folder with a different name than "petitions"*

- clone the repository to your PC: `git clone git@github.com:thaotruongprivate/petitions.git petitions`, move to the 
  folder `cd petitions`
- create an .env file from .env.example `cp .env.example .env`
- install docker [here](https://docs.docker.com/get-docker/) and docker-compose [here](https://docs.docker.com/compose/install/)
- run `docker-compose up -d --build`
- install all bundles `docker exec -ti petitions_app_1 composer install`
- to populate the database, log in to the container `docker exec -ti petitions_app_1 php bin/console --no-interaction doctrine:migrations:migrate`
- the API will be served at http://localhost:7777

## Tests
- `docker exec -ti petitions_app_1 vendor/bin/phpunit`
