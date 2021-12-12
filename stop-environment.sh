#!/bin/sh
docker-compose stop && cd ./proxy && docker-compose stop && cd .. && echo 'environment stopped'

