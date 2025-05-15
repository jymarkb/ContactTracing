FROM composer:lts AS composer-build

WORKDIR /www

COPY composer.json composer.lock /www/

RUN composer install --prefer-dist --no-scripts --ignore-platform-reqs --no-dev --optimize-autoloader

ADD ./ /www

FROM node:20 as assets-build

WORKDIR /www

COPY package.json yarn.lock /www/

RUN yarn install 

RUN yarn run build