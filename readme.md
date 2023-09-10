
composer create-project symfony/skeleton:"6.2.*" my_project_directory
cd my_project_directory
composer require webapp

Attention ports used:
3306 - db 80 - webserver 9000 - app

/* Run APP */ 
docker-compose build app-calc
docker-compose up -d 
docker-compose exec app-calc composer install
docker-compose exec app-calc php bin/console make:migration
docker-compose exec app-calc php bin/console doctrine:migrations:migrate

http://localhost:80

/*for laravel */
docker-compose exec app php artisan key:generate

/rebuild containers/
docker-compose up -d --build --force-recreate

/remove all/
docker-compose down --volumes --rmi all
docker system prune -a --volumes -f


Attention ports used:
3306  - db
80    - webserver 
9000  - app

/*  Run  APP */
docker-compose build app
docker-compose up -d
docker-compose exec app-calc  composer install
docker-compose exec app-calc composer require webapp

/*****************************************/
docker-compose exec app-calc bin/console debug:router
docker-compose exec app-calc php bin/console doctrine:migrations:migrate
docker-compose exec app-calc php bin/console cache:clear 
http://localhost:80

/*for laravel */
docker-compose exec app php artisan key:generate

/*rebuild containers*/
docker-compose up -d --build --force-recreate

/*remove all*/
docker-compose down --volumes --rmi all
docker system prune -a --volumes -f
