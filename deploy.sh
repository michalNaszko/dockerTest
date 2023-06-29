#!/bin/bash

docker swarm init
openssl rand -base64 12 | sudo docker secret create db_root_password -
sudo docker stack deploy --compose-file=docker-compose.yml db_root_password