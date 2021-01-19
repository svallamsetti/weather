

## About Weather App

Weather app is a web application that retrieves weather information using zip code. The app displays weather in Fahrenheit and also displays other information such as zip code, city name and Day&Time in EST.

## Requirements
To run this app docker and docker-compose should be installed on your local workstation.
* [Docker](https://docs.docker.com/get-docker/)
* [Docker Compose](https://docs.docker.com/compose/install/)

## Project setup
Once docker and docker compose are installed follow the below steps to spin this app.

**Steps:**

1. clone the repo `git clone git@github.com:svallamsetti/weather.git`
2. `cd weather`
3. create `.env` file under project root directory   
4. copy contents from `.env.example` to `.env` file
5. Run `./vendor/bin/sail artisan key:generate`
6. copy the API key sent in email and paste it in `.env` file for the key `API_KEY=`
7. Run `./vendor/bin/sail composer install`
> This step may take some time to install dependencies
8. Run `./vendor/bin/sail up -d`
9. The application can be accessed at [Weather](http://127.0.0.1:8888/weather)
10. This app runs on `8888` port, in case if that port is occupied change the port in `.env` file for key `APP_PORT`

## Running Tests

1. Run `./vendor/bin/sail test`
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
