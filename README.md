# README

## Instructions to build

1. `composer install`
2. `cp .env.example .env` (fill out `.env` values, e.g. `DB_`)
3. `php artisan key:generate`
4. `php artisan migrate`
5. `npm install && npm run build`
6. Use e.g. valet, [Laravel Sail](https://laravel.com/docs/10.x/sail), MAMP etc to host this folder, point to `/public` (`index.php`)
7. Use `php artisan tinker` and create a `User` using `User::factory()->create()`. Note down the email. The password is `password` (see `database/factories/UserFactory.php`). Use this one to test the login. Alternatively, you can use the (Laravel Breeze) register flow to create a user, but you need to be able to send/receive mock emails, e.g. with _mailtrap.io_.

## Technologies used
* PHP 8.3
* Laravel 10.45.1 + Laravel Breeze 1.28.3
* MySQL 8.3.0
* Laravel Valet 4.6.1

I've kept things mainly the Laravel way, which is extensively documented here: [Laravel Docs](https://laravel.com/docs/10.x).

## Tasks
### Task 1
```sh
1. Implement a single login web page:
The form should consist of:
A. user email field
B. user password field
C. login button
D. remember me checkbox
```

This was achieved with a simple installation of Laravel + Laravel Breeze, using the Blade + Alpine preselect.

### Task 2
```sh
2. Apply css to the page and make it look modern and user friendly (bootstrap or own styles are
allowed)
```

The login page already comes styled with Tailwind. I'm aware of older packages like the legacy package `laravel/ui` that style this with bootstrap and I know bootstrap better than tailwind. However, this came preselected and I took "own styles" as it being ok to use tailwind.

### Task 3
```sh
3. Add ajax call to the login button and call an external api endpoint to authenticate the user
```

The pre-installed page makes the call via sending a form. I've hijacked this form in the `script` tag in `resources/views/auth/login.blade.php` and send it via AJAX instead. I'm not sure what you mean by "external API endpoint". The endpoint lives in the same code base. However, I've also implemented SSO (e.g. Laravel Socialite) in the past.

### Task 4

```sh
4. . Implement a simple api endpoint in PHP to receive the payload, handle/validate it and return
a welcome user message (Hello User you are logged as TestUser)
A. Controller receives the payload and request and returns a json response with either
ok-status and welcome message, or not ok-status and error message.
B. Service Class that called inside the controller to handle the logic and check the user is
exist in the database
```

- 4.A. `app/Http/Controllers/Auth/AuthenticatedSessionController.php`. Will return `200 OK` or `419 Unprocessable Content` if `email` or `password` are not passed.
- 4.B The "Service class" is basically the `LoginRequest` (`app/Http/Requests/Auth/LoginRequest.php`)

### Task 5
```sh
5. Add routes to the api so no other routes are available
A. Login
B. Logout
C. RememberMe
D. Register
```

Run `php artisan route:list` to see all routes. Laravel Breeze comes a few other routes, which can be disabled. I wasn't sure how `RememberMe` is it's own route? Routes are usually written in lower case, but I've _named_ the (POST) routes as required above.

### Task 6
```sh
6. Implement a database table which persists the User Data
```

Laravel comes with this preinstalled, see table `users` from the `database/migrations/2014_10_12_000000_create_users_table.php` migration. Depending on the `SESSION_DRIVER` in the `.env` file, the sessions can be persisted in the `sessions` table (or e.g. Redis for production or a file, as that's Laravel default for testing)

### Task 7 & 8
```sh
7 document your code (functions, parameters, return types and single line information about
the functionality) and keep it readable and clean
8. Supply a readme.md, including instructions on how to build and run your implementation
```

The Laravel code is already commented, I've made a few enhancements though. I've signed them with `--RS 2024-02-27`. Run the instructions at the top of this document to set up the app.