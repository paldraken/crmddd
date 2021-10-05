.PHONY: start
start:
	docker-compose up

.PHONY: check
check:
	docker exec crmddd_php ./vendor/bin/psalm

.PHONY: checkm
checkm:
	docker exec crmddd_php ./vendor/bin/psalm --show-info=true

.PHONY: tests
tests:
	docker exec crmddd_php ./bin/phpunit
