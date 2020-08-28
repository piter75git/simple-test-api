# Simple Test API

This is a simple API based on Laravel 7.25. It has been made only for testing.

### Local installation
Required the dev environment for Laravel 7.x (https://laravel.com/docs/7.x#server-requirements).
Also Composer is required (https://getcomposer.org/download/).

### Installation steps
- Create MySQL database for the project
- Download and unzip the repository file
- Open console and go to the project directory
- Run `composer install` (or ```php composer.phar install```)
- Rename `.env.example` file to `.env` and fill with the database variables
- Run `php artisan key:generate`
- Run `php artisan storage:link`
- Run `php artisan migrate`
- Run `php artisan db:seed` to run seeds (it shall take about 30 seconds)
- Run `php artisan serve`

### Seeds
Programmes dates (starting dates) start the next day after the day of run seeds.
There are 5 channels and 100 programmes in seeds. Each contains icons and thumbnails.

### Testing
- Open console and go to the project directory
- Run `php artisan test`

### Available endpoints
- `/` - info
- `/channels` - Get the list of channels
- `/channels/{channel_uuid}/{date}/{timezone}` - Get the channel programmes
- `/channels/{channel_uuid}/date/{date}/tz/{timezone}` - Get the channel programmes (restful pattern)
- `/channels/{channel-uuid}/programmes/{programme-uuid}` - Get the programme details

### Timezones format
Here we use timezones in URLs. Use timezones in the format of PHP DateTimeZone (https://www.php.net/manual/en/datetimezone.listidentifiers.php) but replace all slashes with dashes.
