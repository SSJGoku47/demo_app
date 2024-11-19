# Laravel Project Setup

1. Install **Herd** if you haven't already. You can download it from https://herd.laravel.com/windows.
   
2. Open Herd and select **Add Existing Project**.
   
3. Choose the folder where this Laravel project is located.

4. Open the terminal inside Herd and run the following commands:

   - Run `composer install` to install the project dependencies.
   
   - Copy the `.env.example` file to `.env` by running: `cp .env.example .env`.
   
   - Update the `.env` file with your database and other environment settings.

   - Run `php artisan migrate` to set up the database tables.

   - Generate the application key by running: `php artisan key:generate`.

5. Start the Laravel development server by running: `php artisan serve`.

6. After that open URL `https://demo-app.test/`


NOTE : I have included the postman collection mobile APIs for login and register users



PHP vesion : 8.2
Laravel : 11.9
Database : Mysql


Enjoy coding!
