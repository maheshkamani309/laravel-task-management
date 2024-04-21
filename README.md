Web application with CRUD functionality of task management system. The application was built with Laravel, Tailwind, and Livewire  

## Requirements 
- PHP 8.2 or latest
- MySQL
- Composer
- NPM

To install this web application on your local server. Follow the below steps.
## Steps
- **Step 1:** Open Terminal/CMD. Locate to the folder where you extracted Zip.
- **Step 2:** Copy .env.example file to .env *``` cp .env.example .env```*
- **Step 3:** Enter your database name and credentials to the .env file.
- **Step 4:** Run *```composer install```* to get the files for the required packages
- **Step 5:** Run *```npm install```* to install the required node packages
- **Step 6:** Run *```npm run build```* to generate the build files
- **Step 7:** Run *```php artisan key:generate```* to generate application encryption key
- **Step 8:** Run *```php artisan migrate```* to migrate the database tables(schema)
- **Step 9:** Run *```php artisan db:seed```* to add dummy data to the database
- **Step 10:** Run *```php artisan serve```* to create server for the application





