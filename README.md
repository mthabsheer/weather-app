
# Weather API  🌥

This application provides the REST APIs to provide the 5day weather forecast using the Open Weather API. The application provides the below APIs:

- To create a new city by passing the city name, latitude, and longitude.
- List all the cities with 5day weather forecast.
- See weather forecast for a single city by passing the city name.

# Application Setup
Clone the repo and follow the below steps to setup the application.
## Install Packages
To install the PHP packages run the below command:
```sh
composer install
```
## Configuration
### Environment Variables
Make a copy of the .env.example file and create a .env. Then add the below env variables to the .env file.
```sh
#Sets the pagination for the all city list.
CITY_API_PAGINATION=
#Sets the caching period for the weather forecast API call.
CITY_API_CACHE_EXPIRY_SEC=
#Open weather API details
OPEN_WEATHER_ENABLE_LOG=false
OPEN_WEATHER_API=
OPEN_WEATHER_KEY=
```
Then run the below command to setup the hash key for the application.
```sh
php artisan key:generate
```
### Database

The appication uses [MySql](https://www.mysql.com/) as the database. After MySql setup and creating the database, run the below command to create the table structure and populate the db with dummy data:

```sh
php artisan migrate --seed
```
## Running Tests

The test has only feature test cases. Test case uses separate environment file for configuration. Configure the env variables in the .env.testing file before running tests. For running feature test cases only, use the below command:

```sh
php artisan test --testsuite=Feature
```
