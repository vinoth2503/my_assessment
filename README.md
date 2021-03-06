# WIPFLI assessment

[![Coverage Status](https://coveralls.io/repos/github/slimphp/Slim-Skeleton/badge.svg?branch=master)](https://coveralls.io/github/slimphp/Slim-Skeleton?branch=master)

Use this skeleton application to quickly setup and start working on a new Slim Framework 4 application. This application uses the latest Slim 4 with Slim PSR-7 implementation and PHP-DI container implementation. It also uses the Monolog logger.

To run the application in development, you can run these commands 

```bash
cd [my-app-name]
composer start
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
cd [my-app-name]
docker-compose up -d
```
After that, open `http://localhost:8080` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```


As of now, you can see the result by accessing the following urls:
```
`http://localhost:8080/pets`
`http://localhost:8080/pets/{id}`
`http://localhost:8080/pets?search_term={string}`
`http://localhost:8080/pets?breed={string}&age={string}&personality={string}&city={string}&state={string}&county={string}&zip={string}`
```

That's it so far!
