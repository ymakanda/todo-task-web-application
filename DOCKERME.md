## Docker

IS the containerization platform that is used to package your application and all its dependencies together in the form of containers to make sure that your application works seamlessly in any environment that can be developed or tested or in production. Docker is a tool designed to make it easier to create, deploy, and run applications by using containers.

**Components of Docker**

- Docker clients and servers
- Docker images
- Dockerfile 
- Docker containers
- Docker compose

## These components are explained in detail in the below section :

1. Docker Clients and Servers– Docker has a client-server architecture. The Docker Daemon/Server consists of all containers. The Docker Daemon/Server receives the request from the Docker client through CLI or REST APIs and thus processes the request accordingly. Docker client and Daemon can be present on the same host or a different host.

**For example**

When you have a Docker desktop on your computer you can see all the running containers and interact visually as you would be seeing an interface than viewing on servers.

2. **Docker images** are used to build docker containers by using a read-only template. The foundation of every image is a base image eg. base images such as – ubuntu14.04 LTS, and Fedora 20. Base images can also be created from scratch and then required applications can be added to the base image by modifying it thus this process of creating a new image is called “committing the change”.

3. **Docker File**Dockerfile is a text file that contains a series of instructions on how to build your Docker image. This image contains all the project code and its dependencies. The same Docker image can be used to spin a number of containers each with modification to the underlying image. The final image can be uploaded to Docker Hub and shared among various collaborators for testing and deployment. The set of commands that you need to use in your Docker File is FROM, CMD, ENTRYPOINT, VOLUME, ENV, and many more.

``` For example, you can create  Dockerfiles to create the instructions for which PHP version you want to install ```

```bash 
    # docker/php/Dockerfile
        FROM php:8.1-fpm
        RUN apt-get update
        RUN apt-get install -y openssl zip unzip git curl
        RUN apt-get install -y libzip-dev libonig-dev libicu-dev
        RUN apt-get install -y autoconf pkg-config libssl-dev
        RUN docker-php-ext-install bcmath mbstring intl opcache
        RUN docker-php-ext-install pdo pdo_mysql mysqli
```

4. **Docker Containers** are runtime instances of Docker images. Containers contain the whole kit required for an application, so the application can be run in an isolated way. For eg.- Suppose there is an image of Ubuntu OS with NGINX SERVER when this image is run with the docker run command, then a container will be created and NGINX SERVER will be running on Ubuntu OS.

5 **Docker Compose** is a tool with which we can create a multi-container application. It makes it easier to configure and run applications made up of multiple containers. For example, suppose you had an application that required PHP and MySQL and PhpMyAdmin you could create one file which would start all the containers as a service without the need to start each one separately. We define a multi-container application in a YAML file. 

With the docker-compose-up command, we can start the application in the foreground. Docker-compose will look for the docker-compose. YAML file in the current folder to start the application. By adding the -d option to the docker-compose-up command, we can start the application in the background. Creating a docker-compose. YAML file for WordPress application : 

``` docker-compose build  // for creating these images and 
    docker-compose up -d // for keeping them running in the background
```

``` docker-compose.yml  // could be like this```

```bash 

# docker-compose.yml
version: "3.8"
services:

  nginx:
    container_name: Laravel_nginx
    build: docker/nginx
    command: nginx -g "daemon off;"
    links:
      - php
    ports:
      - "8080:80"
    volumes:
      - ./logs/nginx:/var/log/nginx
      - ../todo-task-web-application:/var/www/html

  php:
    container_name: laravel_php
    build: docker/php
    ports:
      - "${PHP_PORT:-9001}:9001"
    volumes:
      - ../todo-task-web-application:/var/www/html
      # - ./docker/php/xdebug.ini:/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
    working_dir: /var/www/html

  mysql:
    image: mysql:${MYSQL_VERSION:-8.0.27}
    container_name: laravel_mysql
    environment:
      MYSQL_ROOT_PASSWORD: password
      MYSQL_DATABASE: cloud-portal
      SERVICE_TAGS: dev
      SERVICE_NAME: mysql
    ports:
      - "${MYSQL_PORT:-3306}:3306"
    volumes:
      - ./database/mysql:/var/lib/mysql
    
  phpmyadmin:
    image: phpmyadmin/phpmyadmin:${PHPMYADMIN_VERSION:-latest}
    container_name: laravel_pma
    links:
      - mysql
    environment:
      PMA_HOST: mysql
      PMA_PORT: 3306
      PMA_ARBITRARY: 1
    restart: always
    ports:
      - "${PHPMYADMIN_PORT:-8085}:80"

  composer:
    container_name: laravel_composer
    image: composer/composer:${COMPOSER_VERSION:-latest}
    volumes:
      - ../todo-task-web-application:/var/www/html
    working_dir: /var/www/html
    command: install

  node:
    image: node:${NODE_VERSION:-latest}
    container_name: laravel_node
    working_dir: /var/www/html
    entrypoint: [ "npm" ]
    volumes:
      - ../todo-task-web-application:/var/www/html

```