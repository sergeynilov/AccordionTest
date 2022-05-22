Common laravel installation steps:
composer install
npm install
php artisan migrate

In .env file you need to update next parameters :

DB_DATABASE=Your_database_name
DB_USERNAME=Your_database_user
DB_PASSWORD=Your_database_password


QUEUE_CONNECTION=database


MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=Your_email_username
MAIL_PASSWORD=Your_email_password


Run in the console
php artisan serve

With manager account manager@site.com/11111111
http://127.0.0.1:8000/manager/new_claims/index
page must be opened

Creating new user (it would be created with CLIENT access) you need to login with it and page
http://127.0.0.1:8000/client/claim_create_form
for new claim entering would be opened


