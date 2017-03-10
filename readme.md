A basic template for API building using Laravel/ Dingo API Framework + JWT for token based auth.
Follow the steps to set up and use.
For any quries let me know at ali.jibran44@gmail.com 

....Happy API Building :) 


Set document root to {YOUR DIR NAME}/public/
Run composer update at root

*RUN COMMANDS AT CONSOLE*
copy .env.example .env
php artisan key:generate
php artisan vendor:publish --provider="Dingo\Api\Provider\LaravelServiceProvider"


*COPY THIS IN YOUR .env FILE --CHANGE AS YOU WISH*
API_STANDARDS_TREE=vnd
API_SUBTYPE=myapp
API_DOMAIN=localhost
API_NAME="Dingo API"

*TEST API* 
http://localhost/api/test


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