## Streaming Platform with Laravel Livewire

This project is a web application for managing movies, allowing users to create playlists, rate movies, and much more. The application is developed using Laravel Livewire and styled with Tailwind CSS.

## Prerequisites

Before you begin, make sure you have the following tools installed on your system:

- **[PHP](https://www.php.net/downloads.php)**
- **[Composer](https://getcomposer.org/download/)**
- **[Node.js](https://nodejs.org/)**

## Instalación

1. Clone this repository to your local machine.
2. Run `composer install` to install Laravel dependencies.
3. Run `npm install` to install Node.js dependencies.
4. Copy the `.env.example` file and rename it to `.env`. Then, configure the environment variables according to your development setup.
5. Run `php artisan key:generate` to generate a new application key.
6. Run `php artisan storage:link` to create a symbolic link for storing images and other assets
7. Run `php artisan migrate --seed` to migrate the database and seed it with initial data.
8. Run `php artisan serve` to start the development server.

```sh
git clone https://github.com/Alexander-hub37/Livewire-Netflix.git
cd livewire-netflix
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan serve
npm run dev
```
## Usage

1. Open your browser and go to `http://localhost:8000` to view the application.
2. You should see the login page. Enter your credentials to log in.

## Application Features

This platform supports two roles: Admin and User.

- **Admin Features**
    - **Manage movies**: Add, edit, and delete movies in the system.
    - **Manage genres**: Categorize movies by genre.
- **User Features**
    - **View Movies**: Browse through the available movies.
    - **Rate Movies**: Rate movies once, with the ability to update your rating later.
    - **Create Playlists**: Organize favorite movies into custom playlists.
    - **Search for Movies**: Use a search bar to find specific movies by title.
    - **Add Movies to Playlists**: Easily add movies to any of your created playlists.
    - **Account Management**: Sign up, log in, verify email, and reset the password.

## License

Feel free to use and re-use any way you want.
