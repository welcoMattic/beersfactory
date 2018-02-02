#!/usr/bin/env bash

# Fetch data
./bin/console doctrine:database:create --if-not-exists
./bin/console doctrine:schema:update --force
./bin/console app:give-me-beers