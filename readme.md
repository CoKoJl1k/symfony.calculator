
composer create-project symfony/skeleton:"6.2.*" my_project_directory
cd my_project_directory
composer require webapp

Attention ports used:
3306 - db 
80 - webserver
9000 - app

/* Run APP */ 
docker-compose build app-calc
docker-compose up -d 

docker-compose exec app-calc composer install
docker-compose exec app-calc php bin/console make:migration
docker-compose exec app-calc php bin/console doctrine:migrations:migrate

docker-compose exec app-calc php bin/phpunit

/rebuild containers/
docker-compose up -d --build --force-recreate

/remove all/
docker-compose down --volumes --rmi all
docker system prune -a --volumes -f

