[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework) ![Codeship](https://codeship.com/projects/a6380730-9339-0134-c16c-6ab3c53113e2/status?branch=master)

# Read Marvel
ReadMarvel.com is a fan made website. It is built entirely on Laravel 5. All data is provided by Marvel through their public Marvel API. You can see the website fully functioning here: http://readmarvel.com/
 You can read more about it on their [official website](http://developer.marvel.com/)

## Requirements
- Nginx
- MySQL
- Redis server 
- Composer
- Marvel Developer account
- Mailgun account (or your favourite e-mail service)
- Google ReCaptcha account
- (optional) Google Analytics account (if you are going to use GA)
- (optional) PhantomJS (for running the Codeception tests)

## Project setup
- Register in `http://developer.marvel.com` to get your API keys (you'll use it later)
- Setup Vagrant with Homestead (https://laravel.com/docs/5.3/homestead)
- Setup redis server on your Homestead environment
- Create a new MySQL database in Homestead (ex. "marvel")
- Navigate to the project root in Homestead and run `composer install`
- Rename the `.env.example` file to `.env`
- Open your `.env` file and replace the placeholder values with your custom values
- Run `php artisan migrate --seed`
- Pay attention to the console messages. A message with your **admin user** should appear in the console
- Setup a vhost (ex. `marvel.dev`. This step will vary depending on your OS)
- Open your newly setup vhost in your browser

## Contributing
- Create a branch of develop;
- Make a PR;

## License
The "ReadMarvel.com" web app is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT);
