#!/bin/sh
cd ./proxy && docker-compose up -d && cd .. && docker-compose up -d && echo 'environment ready to work'

