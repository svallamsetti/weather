

## About Weather App

Weather app is a web application that retrieves weather information using zip code. The app displays weather in Fahrenheit and also displays other information such as zip code, city name and Day&Time in EST.

## Requirements
To run this app, docker and docker-compose should be installed on your local workstation. The following instructions will work on Mac OS with docker installed and should work on Windows (via WSL2).
* [Docker](https://docs.docker.com/get-docker/)
  
To run this app without docker we need PHP 7.3 or more installed on the local computer and need composer installed globally.
Once they are installed locally on the workstation, please skip to the Section #Without Docker

## Project setup
Once docker and docker compose are installed, follow the below steps to spin this app.

**Steps:**

1. clone the repo `git clone git@github.com:svallamsetti/weather.git`
2. `cd weather`
3. copy contents from `.env.example` to `.env` file `cp .env.example .env`
4. Run composer install `docker run --rm -it -v $PWD:/app composer install`
    > Step 4 & 5 will take some time to complete. 

5. Run `./vendor/bin/sail up -d`
6. Run `./vendor/bin/sail artisan key:generate`
7. Run `touch database/SearchHistory.sqlite`
8. Run `./vendor/bin/sail artisan migrate`   
9. copy the API key sent in email and paste it in `.env` file for the key `API_KEY=`
10. The application can be accessed at [Weather](http://127.0.0.1:8888/weather)
11. This app runs on `8888` port, in case if that port is occupied change the port in `.env` file for key `APP_PORT`

## Running Tests

1. Run `./vendor/bin/sail down`
2. Run `touch database/testing.sqlite`
3. Run `./vendor/bin/sail up -d`
4. Run `./vendor/bin/sail test`
```
 Dinesh@Sais-Air > ~/um/weather > ./vendor/bin/sail test

   PASS  Tests\Unit\Weather\WeatherByZipCodeTest
  ✓ can create weather by zip code object

   PASS  Tests\Unit\Weather\WeatherMapperTest
  ✓ can send weather a p i response
  ✓ weather a p i exception can be thrown
  ✓ can create valid history record
  ✓ can create invalid search history record

   PASS  Tests\Unit\Weather\WeatherRESTImplementationTest
  ✓ can retrieve weather by zip code

   PASS  Tests\Unit\searchHistory\SearchHistoryEloquentTest
  ✓ can create search history
  ✓ can retrieve search history records in desc order

   PASS  Tests\Feature\weather\WeatherByZipCodeTest
  ✓ can see weather view
  ✓ can get weather by zip code
  ✓ validation works
  ✓ exception works

  Tests:  12 passed
  Time:   5.95s

```

## Shutting Down

1. Run `./vendor/bin/sail down`

## Without Docker

1. clone the repo `git clone git@github.com:svallamsetti/weather.git`
2. `cd weather`
3. copy contents from `.env.example` to `.env` file `cp .env.example .env`
4. Run `composer install`
5. Run `php artisan key:generate`
6. Create a file under database directory `SearchHistory.sqlite`
7. Run `php artisan migrate`
8. copy the API key sent in email and paste it in `.env` file for the key `API_KEY=`
9. Run `php artisan serve`   
10. The application can be accessed at a url that will be shown when we run the above command 

**Running Tests**
1. Create a file under database directory `testing.sqlite`
2. `cd vendor/bin` && Run `phpunit`
