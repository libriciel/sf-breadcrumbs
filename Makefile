DOCKER_COMPOSE=docker compose --file compose.yaml
APP_NAME=app

.DEFAULT_GOAL := help
.PHONY: help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

build: ## Build the container
	$(DOCKER_COMPOSE) build app

build-vendor:  ## Build vendor directory from composer
	$(DOCKER_COMPOSE) run --entrypoint "composer install" $(APP_NAME)

bash: ## Obtain a shell console on the app container.
	$(DOCKER_COMPOSE) run  $(APP_NAME) bash

fix-cs: ## Fix the project style
	$(DOCKER_COMPOSE) run --entrypoint 'vendor/bin/php-cs-fixer fix' $(APP_NAME)

phpstan:
	$(DOCKER_COMPOSE) run --entrypoint 'vendor/bin/phpstan' $(APP_NAME)


clean-vendor: ## Delete vendor directory
	rm -rf vendor/

clean-cache: ## Delete cache from cs fixe and phpunit
	rm -f .php-cs-fixer.cache
	rm -f .phpunit.result.cache
	rm -rf coverage

mr-proper: clean-vendor clean-cache ## Clean all generated files

