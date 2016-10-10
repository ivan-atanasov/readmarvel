# Read Marvel
ReadMarvel is a fan made website. It can be used to keep track of you favourite Marvel Comic books.

## Requirements
Below you can find all the required steps to run the project.

- Nginx
- MySQL
- Redis server
- PhantomJS (for running tests)

## Project setup
I've kept the setting up as short as possible.

- Register in `http://developer.marvel.com` to get your API keys (you'll use it later)
- Setup Vagrant with Homestead (https://laravel.com/docs/5.3/homestead)
- Setup redis server on your environment
- Create a new MySQL database (ex. "marvel")
- Navigate to the project root and run `composer install`
- Copy the `.env.example` to `.env`
- Open your `.env` file and substitute the placeholder values with your custom values
- Run `php artisan migrate --seed`
- A message with your admin user should appear in the console
- Setup a vhost (ex. `marvel.dev`)
- Open your newly setup vhost in your browser

## Contributing

Thank you for considering contributing to this project! 

## License

The "My Marvel List" web app is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
