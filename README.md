1. clone project.
2. copy .env.example & make .env file.
3. put shopify API Keys
SHOPIFY_API_KEY=**************************************
SHOPIFY_API_SECRET=********************************************

4. run `composer install` command.
5. run `php artisan migrate` command.

Shopify App Settings
In your app’s settings on your Shopify Partner dashboard, you need to set the callback URL to be:

https://yourdomain.test/

And the whitelisted redirect_uri to be:
https://yourdomain.test/authenticate

The callback URL will point to the home route, while the redirect_uri will point to the authentication route.

This Project Run Only Live Serve Or Using Laragoan (For Windows User.)
