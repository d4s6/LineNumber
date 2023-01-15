FROM php:8.2.1-cli
COPY . /usr/src/LineNumber
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
RUN apt update
RUN apt install git -y
WORKDIR /usr/src/LineNumber