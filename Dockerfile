# IMAGE
FROM php:7.4-apache
# We need to create inside the container's system our workdir path
RUN mkdir -p /var/www/html

WORKDIR /var/www/html

# Copy local content (src/) in a specific container's path(/var/www/html)
COPY src/ /var/www/html

#  port
EXPOSE 80