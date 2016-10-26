# docker build -t millimage . 
# docker run -h milltest -v /c/Users/Tom/Desktop/repos/milltest/app/:/var/www/milltest/ -v /c/Users/Tom/Desktop/repos/milltest/etc/apache/sites-enabled/:/etc/apache2/sites-enabled/ -p 192.168.99.100:99:80 -d --name milltest millimage
# docker exec  -it milltest  bash

FROM php:7.0-apache

RUN apt-get update && apt-get -y upgrade && DEBIAN_FRONTEND=noninteractive apt-get -y install \
    vim

EXPOSE 80