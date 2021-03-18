# SRS - Shipment Registration System

The application is used to register the mail flow between the sender and the recipient. Particularly useful in a large territorial dispersion of the company.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.
See deployment for notes on how to deploy the project on a live system.

## Prerequisites

What things you need to install the application:
```
- docker version 19.03.8
- docker-compose version 1.25.0
```

### Run in docker manualy
```
git clone https://github.com/gmbroker-hq/srs.git
```
#### 1. mysql
```
docker run \
	--name mysql \
	--network mysql-network \
	--hostname mysql \
	-v /var/www/html/srs/database/db_init.sql:/docker-entrypoint-initdb.d/db_init.sql \
	-e MYSQL_ROOT_PASSWORD=root_password \
	-e MYSQL_DATABASE=srs \
	-e MYSQL_USER=srs \
	-e MYSQL_PASSWORD=my_secret_password \
	-d mysql:5.7
```
#### 2. application
```
docker run \
	--name srs2 \
	--hostname srs \
	--link mysql:mysql \
	--network mysql-network \
	-e MYSQL_DATABASE_HOST=mysql \
	-e MYSQL_DATABASE_NAME=srs \
	-e MYSQL_DATABASE_USER=srs \
	-e MYSQL_DATABASE_USER_PASSWORD=my_secret_password \
	-p 80:80 \
	-d gmbroker/srs

```

### Run in docker-compose
```
git clone https://github.com/gmbroker-hq/srs.git
cd srs
docker-compose up -d
```