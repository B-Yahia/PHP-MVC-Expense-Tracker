# PHP Expense tracker (MVC Approach)
PHP application designed using the MVC (Model-View-Controller) architecture. 

## Features
- Implements MVC architecture for a clean and modular design.
- CRUD operations for expenses.
- User authentication system (login/logout).

## Installation

1. Clone the repository and install dependencies:
```
git clone https://github.com/B-Yahia/PHP-MVC-Expense-Tracker.git  
cd PHP-MVC-Expense-Tracker  
composer install  
```
2. The VH need to point to `/public` directory that contain a `.htaccess` file that configure the single entry point.
3. Create a MySQL database and run the SQL script in the file `Database.sql` to create the required tables.
4. Set up the `.env` file using `.env.example` as a template.
5. Once all of that is done you are supposed to have the app running;

## Deployment

The app is now deployed on my VPS, and you can try it at:
 - [https://tracker.apitestdomain.site/](https://tracker.apitestdomain.site/)

You can sign up yourself and create a username and password to try the app or you can use these credentials:

  Username: `admin@email.com`
  Password: `password`

## Configuring a Virtual Host

If you need to configure a virtual host to deploy this application, you can follow the instructions provided in the README file of the [linux-apache-virtual-host-setup](https://github.com/B-Yahia/linux-apache-virtual-host-setup) repository.

## Requirements

  - PHP 8.1+
  - MySQL
  - Composer
