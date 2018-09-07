##ArtistApi
Api which list artists with their albums using Symfony4 framework.
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

## API Endpoints

    * `GET /artists`
        * show all artists with `token` and `name`
        * show related albums with `token`, `title`, `cover`
    * `GET /artists/[token]`
        * same as for `GET /artists` but only for the requested artist
    * `GET /albums/[token]`
        * show album data `token`, `title`, `description`, and `cover`
        * show related artist with `token` and `name`
        * show related songs with `title` and `length` (in minutes)
   
