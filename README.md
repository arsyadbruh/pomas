# POMAS

POMAS is a website-based application combined with laravel framework, bootstrap, and MySQL. Using website applications such as POMAS, can make it easier for users to access project management data quickly and easily and flexibly on any device and anywhere.

## How to Run

1. Download or clone the project.
2. Open terminal and run this command.

    ```shell
    composer install
    ```

    ```shell
    npm install && npm run dev
    ```

3. Create env file from `env.example`. Setup environment
4. Create database in your local and named it "pomas"
5. After that, run the command below. this command will create table and generate data dummy

    ```shell
    php artisan migrate --seed
    ```

6. Then, run `php artisan serve` to run laravel.

### List Default user and password

Password: `pomas1234`

| Email | Username |
| :---:| :---:|
| beta@pomas.com | beta |
| alpha@pomas.com | alpha |
| jafrick@pomas.com | jafrick |

You can see default user in `database\seeders\UserSeeder.php`
