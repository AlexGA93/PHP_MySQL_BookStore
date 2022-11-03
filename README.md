# PHP / MySQL - Web App

## Docker integration
We'll define our Dockerfile instructions:
```
# IMAGE
FROM php:7.4-apache

RUN docker-php-ext-install mysqli

# We need to create inside the container's system our workdir path
RUN mkdir -p /var/www/html

WORKDIR /var/www/html

# Copy local content (src/) in a specific container's path(/var/www/html)
COPY src/ /var/www/html

#  port
EXPOSE 80
```
## docker-compose

We've to define our **docker-compose.yml** file:
```
version: "3.1"
services:
    db:
        container_name: mysql_db_container
        image: mysql
        ports: 
            - "3306:3306"
        command: --default-authentication-plugin=mysql_native_password
        env_file:
            - ./.env
        environment:
            MYSQL_DATABASE: ${MYSQL_DATABASE}
            MYSQL_USER: ${MYSQL_USERNAME}
            MYSQL_PASSWORD: ${MYSQL_PASSWORD}
            MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD} 
        volumes:
            # import sql database
            - ./src/sql/shop_db.sql:/docker-entrypoint-initdb.d/shop_db.sql
        networks:
            - default
    www:
        build: .
        ports: 
            - "3000:80"
        volumes:
            - ./src:/var/www/html
        links:
            - db
        networks:
            - default
    phpmyadmin:
        image: phpmyadmin/phpmyadmin
        container_name: php_container
        links: 
            - db:db
        ports:
            - 8000:80
        env_file:
            - ./.env
        environment:
            MYSQL_USER: ${MYSQL_ROOT_USERNAME}
            MYSQL_PASSWORD: ${MYSQL_PASSWORD}
            MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD} 
volumes:
    persistent:
```

## Useful Docker Commands

- Build Image fro mthe Dockerfile i nthe current directory and tag the image
```
sudo docker build -t image_name:version .
```

- List all images locally stored
```
sudo docker image ls
```

- Delete an image from the local image store
```
sudo docker image rm image_name
```
- Delete all stored images
```
sudo docker rmi $(sudo docker images -a -q)
``` 
- Pull an image from a registry
```
sudo docker pull image_name
```

- Retag a local image with a new image name and tag
```
sudo docker tar image_name myrepo_image_name
```

- Push an image to a registry
```
sudo docker push myrepo/image_name
```
- List running containers (--all to include stopped ones)
```
sudo docker container ls
```

- Run a container tagging a name and port
```
sudo docker container run --name container_name -p local_port:container_port image_name
```

- Stop a running container (We can name our contianer as the three firsts id's digits)
```
sudo docker container stop contianer_name
```

- Kill a container
```
sudo docker container kill image_name
```
- Delete all running and stopped containers
```
sudo docker container rm -f $(sudo docker ps -aq)
```

- Print the last 100 lines of container's log
```
sudo docker container logs --tail 100 container_name
```

- List networks
```
sudo docker network ls
```

## Run our PHP Docker Image
To run our docker image We only need to put the following command to create a internal container:
```
docker build -t <image_name> .
```

- We decided to initiate the container in the inner port 80, but there will be running in our local port 3000.


After the last step we must create and run our container:
```
sudo docker run --name php_container -p 3000:80 -v $(pwd)/src:/var/www/html/ -d docker_image
```
**NOTE**: We added a flag to create a volume to specify our code's directory. This will allows us to change our container's code at the same time we are doing it.
```
-v local_path:contianer_path
```

## Connect to a Docker Container

To connect to a container We only need to enter the following command in our terminal:
```
sudo docker ps
sudo docker exec -it <three_firsts_digits> bash
```


## Run our PHP Docker Image
To init our docker environment enter the following command:
```
docker-compose up -d
```
To access to our front client We've to access to the following url:
```
http://localhost:3000
```

To access to our mysql interface We've to access to the following url:
```
http://localhost:8000
```
