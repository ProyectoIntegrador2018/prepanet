# Prepanet

[![Maintainability](https://api.codeclimate.com/v1/badges/37df0dcfc6c14c97fc21/maintainability)](https://codeclimate.com/github/ProyectoIntegrador2018/prepanet/maintainability)

Application to be awesome

## Table of contents

* [Client Details](#client-details)
* [Environment URLS](#environment-urls)
* [Da Team](#team)
* [Management resources](#management-resources)
* [Setup the project](#setup-the-project)
* [Running the stack for development](#running-the-stack-for-development)
* [Stop the project](#stop-the-project)
* [Restoring the database](#restoring-the-database)
* [Debugging](#debugging)
* [Running specs](#running-specs)
* [Checking code for potential issues](#checking-code-for-potential-issues)


### Client Details

| Name                              | Email               | Role |
| --------------------------------- | ------------------- | ---- |
| Ana Maria Loreto Zúñiga Lombardo  | ana.zuniga@itesm.mx | CEO  |


### Environment URLS

* **Production** - [TBD](TBD)
* **Development** - [TBD](TBD)

### Da team

| Name           | Email             | Role        |
| -------------- | ----------------- | ----------- |
| Eduardo Andrade Martínez | eduardo.mtz9@gmail.com| Development |
| Juan Pestana | juancho.pestana@gmail.com | Development |
| Pedro Iván Martínez | Ivan_0423@hotmail.com | Development |
| André Jiménez | andre.jimenez@outlook.com | Documentation - Development |

### Management tools

You should ask for access to this tools if you don't have it already:

* [Github repo](https://github.com/ProyectoIntegrador2018/prepanet)
* [Backlog](https://github.com/ProyectoIntegrador2018/prepanet/projects/1)
* [Heroku](https://crowdfront-staging.herokuapp.com/)
* [Documentation](https://drive.google.com/open?id=1wCrqXb4MnM93rEnGpT0BnV-e1RoRj2gs)

## Development

### Setup the project

Install [`composer`](https://getcomposer.org/) as a PATH in your computer,
this will help you get the Laravel installer in your computer:

```bash
$ composer global require "laravel/installer"
```

You also need MySQL installed in your computer.

After installing please you can follow this simple steps:

1. Clone this repository into your local machine

```bash
https://github.com/ProyectoIntegrador2018/prepanet.git
```

2. Create an .env file inside the main folder of the project and fill it up with your credentials.

3. Fire up a terminal and run:

```bash
$ composer update
```

4. Run the migration and the seeding of the database.

```bash
$ php artisan migrate -seed
```

### Running the stack for Development

1. Fire up a terminal and run: 

```
php artisan serve
```

If you have PHP installed locally and you would like to use PHP's built-in development server to serve your application, you may use the serve Artisan command. This command will start a development server at http://localhost:8000:

### Stop the project

In order to stop crowdfront as a whole you can run:

```
% php artisan down
```

### Restoring the database

You probably won't be working with a blank database, so once you are able to run crowdfront you can restore the database, to do it, first stop all services:

```
% php artisan down
```

Then just lift up the `db` service:

```
% php artisan migrate:fresh --seed
```
