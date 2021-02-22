#!/bin/bash
sudo rm -rf mysql-data
gnome-terminal -e "docker-compose up -d"
read -p "press enter to quit"
