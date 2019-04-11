#  - Shipment Registration System

The application is used to register the mail flow between the sender and the recipient. Particularly useful in a large territorial dispersion of the company.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.
See deployment for notes on how to deploy the project on a live system.

## Prerequisites

What things you need to install the application:
```
- Apache2
- MySQL Server or Percona
```

### Clone  branch into your `html` directory.
```
cd /var/www/html
git clone https://github.com/-HQ/.git
```

## Installing on Ubuntu 16.04

### 1. Install apache2
```
apt-get install apache2
a2enmod rewrite
service apache2 restart
```
### 2. Install mysql
```
apt-get install mysql-server
```
### 3. Install phpmyadmin (optional)
```
apt-get install phpmyadmin
```

## Configuration

### 1. Create new user with password in MySQL server for example ``, example SQL query:
```
CREATE USER ''@'%' IDENTIFIED WITH mysql_native_password AS 'my_secret_password';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, RELOAD, PROCESS, FILE, INDEX, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON *.* TO ''@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON ``.* TO ''@'%';
```

### 2. Create new database in MySQL `` with collation `utf8_unicode_ci`, example SQL query:
```
CREATE DATABASE IF NOT EXISTS `` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
```

### 3. Modify variables in `/core/database/connect.php`
```
$DB_SERVER = "localhost";
$DB_USERNAME = "";
$DB_PASSWORD = "my_secret_password";
$DB_DATABASE = "";
```

### 4. Import file from `database/.sql` into database `` that you have created eariler

### 5. If you want to use different application directory e.g. `/var/www/html//...` directory you need to modify `.htaccess` in main directory with line:
```
RewriteRule ^(.*)$ /profile.php?login=$1
```

## Additional info HOWTO add new vhost:

### step 1. Add new host in your `hosts` file
`echo "127.0.0.1  .com" >> /etc/hosts`

### step 2. Create new vhost config
`nano /etc/apache2/sites-available/.com.conf`
Copy and paste this to your `.com.conf` file:
```
<VirtualHost *:80>
	ServerName .com

	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/html/

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined

    <Directory /var/www/html/ >
        Options FollowSymLinks
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
	Allow from all
        Require all granted
    </Directory>
</VirtualHost>
```

### step 3 (enable vhost)
`a2ensite`
and enter your vhost name from list and press enter.

### step 4 (Reload apache)
`service apache2 reload`

You should be able to see now in your browser  application. Just enter in address `.com` :)

## Default login/password to  web application:
login: `unknown`
password: `unknown`

login: `admin`
password: `admin`

login: `sadmin`
password: `sadmin`
