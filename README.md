# axon-phone-book
This repository to demonstrate a simple task as a hiring step in Axon EG

## How to run the project:
- clone the repo
- run composer install, ```make sure you have php version >= 8.2```
- copy .env.example to .env
- run: php artisan key:generate
- copy your sqlite db file to this path: /project-root/database/database.sqlite
- make sure your db has at least 1 table named ```customer``` and this table has at least those columns: id, name, phone and the phone field must consist of this pattern for working smoothly: (212|237|251|256|258) digits here, ```as mentioned in task file```
- run: php artisan migrate
- run: php artisan serve
- brwose this link: http://localhost:8000
