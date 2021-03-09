install:
	composer install

start:
	./bin/gendiff

validate:
	composer validate

lint:
	composer run-script phpcs -- --standard=PSR12 src bin

fix:
	composer run-script phpcbf -- --standard=PSR12 src bin

test:
	composer run-script test tests/GendiffTest.php

test-coverage:
	composer phpunit tests -- --coverage-clover build/logs/clover.xml