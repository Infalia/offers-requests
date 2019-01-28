# Offers & Requests

A [WeGovNow](https://wegovnow.eu) component for supporting people in the community to manage local goods and service requests and offers and for listing valid charitable organisations

This component is the former WeGovNow Trusted Marketplace (without the social networks data collection mechanism)

## Requirements
- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension


## Install
Clone this repo and install dependencies via composer

```
$ composer update
```

## Configuration

#### Configuration variables
Rename the *.env.example* file to *.env* and edit the application’s configuration variables. You should also check if the APP_KEY variable has been generated. If not, you should run the command below, or your user sessions and other encrypted data will not be secure.

```
$ php artisan key:generate
```

#### Public directory
After installing Laravel, you should configure your web server's document/web root to be the *public* directory. The index.php in this directory serves as the front controller for all HTTP requests entering your application.

```
$ php artisan storage:link
```

#### Permissions
Also, you may need to configure some permissions. Directories within the *storage* and the *bootstrap/cache* directories should be writable by your web server or Laravel will not run.

#### Database
After creating the project's database, you should run the commands below to create the database tables and generate some dummy data.

```
$ php artisan migrate
$ php artisan db:seed
```

## Administration
In order to log into administration panel it's necessary to create an administrator. Run the command below and then go to {YOUR_DOMAIN}/cms.

```
php artisan administrator:create
```
