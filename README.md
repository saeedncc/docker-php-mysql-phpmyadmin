# Dockerize a PHP Application

## Installation

Require this project with docker desktop

## Use with Docker Development Environments

### php application using a Mysql database with phpmyadmin


Project structure:

```
.
├── Dockerfile
├── README.md
├── app/index.php
└── docker-compose.yml
```

[_docker-compose.yaml_](docker-compose.yaml)
```yaml

version: '3.8'
services:
    php-apache-environment:
        container_name: php-apache
        build:
            context: .
            dockerfile: Dockerfile
        depends_on:
            - db
        volumes:
            - ./app:/var/www/html/
        ports:
            - 8000:80
    db:
        container_name: db
        image: mysql
        restart: always
        environment:
            MYSQL_ROOT_PASSWORD: MYSQL_ROOT_PASSWORD
            MYSQL_DATABASE: MYSQL_DATABASE
            MYSQL_USER: MYSQL_USER
            MYSQL_PASSWORD: MYSQL_PASSWORD
        ports:
            - "9906:3306"
            
        volumes:
            - mysql:/var/lib/mysql
            - mysql_config:/etc/mysql    
            
            
    phpmyadmin:
        image: phpmyadmin/phpmyadmin
        ports:
            - '8080:80'
        restart: always
        environment:
            PMA_HOST: db
        depends_on:
            - db


volumes:
    mysql:
    mysql_config:            

            
```

Deploy with docker compose

```cmd
docker compose up -d
[+] Running 4/4
 - Network php-docker_default         Created                                                                      0.1s
 - Container db                       Started                                                                      2.7s
 - Container php-docker_phpmyadmin_1  Started                                                                      2.4s
 - Container php-apache               Started

```


## Expected result

```
docker compose ps
NAME                      SERVICE                  STATUS              PORTS
db                        db                       running             0.0.0.0:9906->3306/tcp, :::9906->3306/tcp, 33060/tcp
php-apache                php-apache-environment   running             0.0.0.0:8000->80/tcp, :::8000->80/tcp
php-docker_phpmyadmin_1   phpmyadmin               running             0.0.0.0:8080->80/tcp, :::8080->80/tcp
```

After the application starts, navigate to `http://localhost:8000` in your web browser or run:

```
$ curl localhost:8000
Connected to MySQL server successfully!
```

Stop and remove the containers
```
$ docker compose down
[+] Running 4/4
 - Container php-apache               Removed                                                                      2.4s
 - Container php-docker_phpmyadmin_1  Removed                                                                      2.3s
 - Container db                       Removed                                                                      1.3s
 - Network php-docker_default         Removed
```
