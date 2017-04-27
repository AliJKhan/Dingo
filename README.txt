Set document root to {YOUR DIR NAME}/public/
Run composer update at root

*RUN COMMANDS AT CONSOLE*
copy .env.example .env
php artisan key:generate
php artisan vendor:publish --provider="Dingo\Api\Provider\LaravelServiceProvider"


*COPY THIS IN YOUR .env FILE-- CHANGE AS YOU WISH*
API_STANDARDS_TREE=vnd
API_SUBTYPE=myapp
API_DOMAIN=localhost
API_NAME="Autogenie API"


php artisan serve

*TEST API* 
http://localhost:8000/api/test

*IF You GET 404 try changing API_DOMAIN=localhost to API_DOMAIN= *

Now that the api has been setup let us use the token system. Set up a user with sentinel or however.

POST localhost/api/authenticate
 --Parameters: username and password.
 --Response: Token to be used for future transactions.

GET: localhost/api/users
 -- Set authentication in header to "Bearer *Token from authenticate*".
 --Response: List of all users

GET localhost/api/users
 --Response: User details using the Authentication Header.

GET localhost/api/token
 --Response: New token *Previous token becomes invalid*.


php artisan serve --host 0.0.0.0