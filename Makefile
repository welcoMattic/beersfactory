cs:
	php ./vendor/bin/php-cs-fixer fix

db:
	php ./bin/console doctrine:database:create --if-not-exists
	php ./bin/console doctrine:migrations:migrate -n

install:
	composer install
	@echo "🍺  Awesome dude! 🍺"

run:
	php ./bin/console server:run beersfactory.test:8080

start:
	php ./bin/console server:start beersfactory.test:8080

stop:
	php ./bin/console server:stop
