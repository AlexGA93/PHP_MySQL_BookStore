# PHP / MySQL - Web App

## Docker integration
In this case We want to mount and start a container to start our app. For this We can use the following command to crate a simple Apache server:

- We'll create a Docker file to define step by step to create our container.
```
# IMAGE
FROM php:7.4-apache

# Copy local content (src/) in a specific container's path(/var/www/html)
COPY src/ /var/www/html

#  port
EXPOSE 80
```
**NOTE**: We can see all the info at the [hub docker official site](https://hub.docker.com/_/php)

- To initiate our Docker container we have to enter the followinfg instruction in the terminal:
    
```
docker build -t php_crash_course .
```
- **docker build** will read our Dockerfile's content in the path (.)
- **-t** will assign a name to our image

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
