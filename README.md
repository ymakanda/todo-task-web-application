# Web-based application

This is a web-based application, built with the latest version of Laravel(10.*) + Breeze + blade templating with some view components, PhpUnit test, and tailwind for CSS.

## Prerequisites 
-   PHP 8.*
- Must have a working DB like Mysql or any preferable
- Make sure you have a working LAMP/WAMP/MAMP stack. You can use Homestead, Valet, or  Docker to create URL to test the app
- Visit https://laravel.com/docs/10.x for references 

## Installation

Clone the repository locally 
``` git clone https://github.com/ymakanda/todo-task-web-application ```

- cd to your working directory ``` cd todo-task-web-application ```
- Install composer and npm 
- copy from .example to new  `.env` file:

## To run it 

```bash
npm run dev
```
Assuming you've set up the site to be available on localhost or using Laravel Valet on Mac, for instance:

```bash
npm run dev or vite  not watch  
```

Then open http://todotaskwebapplication.test/  in a browser.
For docker something like
Then open http://localhost:8080/ in a browser.

Next you'll need to run migrations and seeder for creating dummy data and testing users:

```bash
    php artisan migrate:fresh --seed
```
**Login details:**
User name :test@example.com
Password:password

**Runing Test**

```bash
    php artisan test
```
