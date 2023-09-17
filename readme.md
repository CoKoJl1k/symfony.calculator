
composer create-project symfony/skeleton:"6.2.*" my_project_directory
cd my_project_directory
composer require webapp

Attention ports used:
3306 - db 
80 - webserver
9000 - app

/* Run APP */ 
docker-compose build
docker-compose up -d
docker-compose exec app-calc composer install

docker-compose exec app-calc php bin/console make:migration
docker-compose exec app-calc php bin/console doctrine:migrations:migrate
docker-compose exec app-calc php bin/phpunit


docker-compose exec app-calc composer require symfony/amqp-messenger
/rebuild containers/
docker-compose up -d --build --force-recreate

/* FOR QUEUE */
composer require symfony/messenger symfony/workflow

/remove all/
docker-compose down --volumes --rmi all
docker system prune -a --volumes -f

git rm --cached -r .idea/  --  remove files in git 
