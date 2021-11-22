# SRS - Shipment Registration System

The application is used to register the mail flow between the sender and the recipient. Particularly useful in a large territorial dispersion of the company.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.
See deployment for notes on how to deploy the project on a live system.

## Prerequisites

What things you need to install the application:
```sh
- docker version 19.03.8
- docker-compose version 1.25.0
```

### Run in docker manualy
```sh
git clone https://github.com/kubrit/srs.git
```
#### 1. Option A) mysql One-to-One
Use this if you want to setup standalone mysql container for one app. For example:
- srs app is pointing to database hostname `mysql` 172.16.0.2 and using database `srs`
- second app is pointing to database hostname `mysql2` 172.16.0.3 and using database `second`
- third app is pointing to database hostname `mysql3` 172.16.0.4 and using database `third`
```sh
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
#### 1. (recommended) Option B) mysql docker-compose [mysql-multi-db]
Use this if you already have some apps and want to use one `mysql` container for multiple databases. For example:
- srs app is pointing to database hostname `mysql` 172.16.0.2 and using database `srs`
- second app is pointing to database hostname `mysql` 172.16.0.2 and using database `second`
- third app is pointing to database hostname `mysql` 172.16.0.2 and using database `third`
> Note: One container with multiple databases clone: `git clone https://github.com/kubrit/mysql-multi-db.git`
```sh
cd mysql
docker-compose -up -d
```
> WARNING: Remember to modify user password. Both has to be the same.
> in `docker-compose.yml` > `MYSQL_DATABASE_USER_PASSWORD: user_password`
> &
> in `srs/database/db_init.sql` > `GRANT ALL PRIVILEGES ON srs.* TO 'srs'@'%' IDENTIFIED BY 'user_password';`


#### 2. Option A) Run application in docker
```sh
docker run \
	--name srs \
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

### 2. (recommended) Option B) Run application in docker-compose
```sh
git clone https://github.com/kubrit/srs.git
cd srs
docker-compose up -d
```

### Screenshoots
Login screen (First login: sadmin/sadmin or admin/admin)
![image](https://user-images.githubusercontent.com/27975623/142935009-e4effd00-882d-4364-98e9-be2c62afac02.png)

Add received items
![image](https://user-images.githubusercontent.com/27975623/142935319-4a2e7358-94b2-475e-9aea-86169305678b.png)

How many to add
![image](https://user-images.githubusercontent.com/27975623/142935395-86260b03-c522-4a1c-b46a-b68d029e5dad.png)

Add some details to each item
![image](https://user-images.githubusercontent.com/27975623/142935592-7cc1db15-347d-4ed1-8f20-890db73a599a.png)

Export as CSV or PDF
![image](https://user-images.githubusercontent.com/27975623/142935809-e1c1bc36-b020-41e3-8115-7f4502a9d093.png)

Chat feature
![image](https://user-images.githubusercontent.com/27975623/142935862-edc19b80-4042-4dfd-b2c3-218ab3d3e009.png)



   [mysql-multi-db]: <https://github.com/kubrit/mysql-multi-db.git>
