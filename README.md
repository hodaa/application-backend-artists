##Artist Api
Api which list artists with their albums.
## Requirements

- PHP 7.1.3+
- MySQL
- Composer 
- Symfony 4 
- Doctrine

## Installation

- Clone repository so that you can work on it 
- Install the composer packages `Composer install`
- create database `php bin/console doctrine:fixtures:load`


Now you should be able to run `bin/console server:run` to start up your development server.

## Your task

It is up to you on how you want to structure your app. Fulfill the following requirements:

1. Build a database with doctrine based on the following dataset:
    * https://gist.github.com/fightbulc/9b8df4e22c2da963cf8ccf96422437fe
    * Import the dataset by using fixtures
        * Artists and albums should get an additional property `token`
            * ensure that token will be unique
            * length of 6 characters
            * use `App\Utils\TokenGenerator` to generate a token
            * should look something like this `3KF6YK`
        * Songs
            * transform the length to seconds
2. Make the data available via the following REST endpoints:
    * `GET /artists`
        * show all artists with `token` and `name`
        * show related albums with `token`, `title`, `cover`
    * `GET /artists/[token]`
        * same as for `GET /artists` but only for the requested artist
    * `GET /albums/[token]`
        * show album data `token`, `title`, `description`, and `cover`
        * show related artist with `token` and `name`
        * show related songs with `title` and `length` (in minutes)
    * Response should be in JSON
    * Make sure to handle empty results with the correct response