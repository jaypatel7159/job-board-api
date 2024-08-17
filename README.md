Install Dependencies

Ensure you have Composer installed. Then run:

composer install

Set Up Environment

Copy the .env.example file to .env:

cp .env.example .env

Generate Application Key

php artisan key:generate
Set Up Database

Configure your database settings in the .env file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_board
DB_USERNAME=root
DB_PASSWORD=

Run Migrations

php artisan migrate

Seed the Database (Optional)

If you have seed data, run:

php artisan db:seed

Start the Server

php artisan serve

API list

Register Admin & User
Post http://localhost:8000/api/register
name, email, password, password_confirmation

Login Admin & User
Post http://localhost:8000/api/login
email, password

Create a Job (only admin access)
Post http://localhost:8000/api/jobs
title, description, company, location, salary


All Job Listings
Get http://localhost:8000/api/jobs

Job Update (only admin access)
Post http://localhost:8000/api/jobs/id
title, description, company, location, salary

Job delete (only admin access)
Get http://localhost:8000/api/jobs/id

Search Job Listings
Post http://localhost:8000/api/jobs/search
title, location (optinal)

Apply for a Job
Post http://localhost:8000/api/jobs/1/apply
name, email,, phone, cover_letter, user_id

View Applications for a Job
Get http://localhost:8000/api/jobs/1/applications

logout
Post http://localhost:8000/api/logout
