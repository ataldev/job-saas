# Job SaaS

This is just a simple repository for an assignment.

# Setting it up

These are the steps to get the app up and running.

1. Pull the repository
2. `composer install` (or `composer update` if you see errors related to your PHP version)
3. `cd` in to the directory and run `./vendor/bin/sail up -d`. This will run a docker container, and your app will be accesible the APP_URL
4. ssh into the laravel container using `docker exec -it job-saas-laravel-1 bash`.
5. Copy `.env.example` to `.env` and run `php artisan key:generate`
6. Run migrations: `php artisan migrate`
7. For emails to work, add your mailtrap credentials to the .env file
