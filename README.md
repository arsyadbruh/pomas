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

3. Create database in your local and named it "pomas"
4. After that, run the command below. this command will create table and generate data dummy

    ```shell
    php artisan migrate --seed
    ```

5. Then, run `php artisan serve` to run laravel.
