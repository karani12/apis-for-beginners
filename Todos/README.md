## TODO API

This is a simple API to manage a TODO list. It is built using Laravel 10. This API is built to be used with a front-end application.

## Features
- User authentication
- Create, read, update and delete tasks


## Installation
- Clone the repository to your local machine
- You need to have PHP installed on your machine(version 8.1 or higher)
- You need to have composer installed on your machine
> If you don't have PHP and composer installed on your machine, you can download them from the following links:
> - [PHP](https://www.php.net/downloads)
- or you can download the lamp stack from [Bitnami](https://bitnami.com/stack/lamp/installer)
> - [Composer](https://getcomposer.org/download/)

> I thought of using docker to make the installation process easier, but I decided not to use it because I wanted to make the installation process as simple as possible.

- After cloning the repository to your local machine, open the terminal and navigate to the root directory of the project

- Create a new file called .env in the root directory of the project. use the following command to create the file

```bash
cp .env.example .env
```

- Next run the following set of commands to install dependencies
```bash
composer install
```
> Note: You may encounter errors here about lack of extensions. You can install the required extensions and run the command again.
usually for ubuntu just do but this should only be done if you get errors that you lack a certain extension or driver
```bash
sudo apt install php8.3-mysql php8.3-opcache php8.3-pdo php8.3-xml php8.3-bcmath php8.3-calendar php8.3-ctype php8.3-curl php8.3-dom php8.3-exif php8.3-ffi php8.3-fileinfo php8.3-ftp php8.3-gettext php8.3-iconv php8.3-mbstring php8.3-mysqli php8.3-pdo-mysql php8.3-phar php8.3-posix php8.3-readline php8.3-shmop php8.3-simplexml php8.3-sockets php8.3-sysvmsg php8.3-sysvsem php8.3-sysvshm php8.3-tokenizer php8.3-xmlreader php8.3-xmlwriter php8.3-xsl php8.3-zip php-sqlite3
```

- Next, run the following command to generate the application key
```bash
php artisan key:generate
```

- Next, run the following command to create the database tables
```bash
php artisan migrate --seed
```

This will create a user in the database and some tasks for testing purposes.
```
email: testuser@example.com
password: password
```

- Next, run the following command to start the server
```bash
php artisan serve
```

- You can now access the API at http://localhost:8000 or whatever port the server is running on

## Usage
To use the API and its endpoints, run the following command to generate the API documentation
```bash
php artisan scribe:generate
```

This will generate the API documentation and you can access it at http://localhost:8000/docs or whatever port the server is running on

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

This is a cool project for beginners to contribute to. You can contribute by adding new features, fixing bugs, or improving the documentation.







