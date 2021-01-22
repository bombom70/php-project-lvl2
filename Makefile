install:
	composer install

start:
	./bin/gendiff

validate:
	composer validate

lint:
	composer run-script phpcs -- --standard=PSR12 src bin

test:
	composer run-script test tests/GendiffTest.php