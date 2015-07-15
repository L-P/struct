all:

.PHONY: tests
tests:
	vendor/bin/phpunit tests/
