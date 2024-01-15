#!/bin/sh

mkdir -p ./config/apache2
mkdir -p ./config/dns

sudo docker cp dwcs-php8:/etc/apache2/. ./config/apache2/
sudo docker cp dwcs-dns:/etc/bind/. ./config/dns/

sudo chown -R peseoane:users ./config/apache2
sudo chown -R peseoane:users ./config/dns