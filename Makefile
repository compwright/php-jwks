test:
	vendor/bin/phpstan analyse --level 9 src tests
	php -d xdebug.mode=coverage ./vendor/bin/phpunit

style:
	PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer fix
