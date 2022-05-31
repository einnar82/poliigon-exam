# einnar82/poliigon-exam


## Local Development

This project uses
[Laravel Sail](https://laravel.com/docs/sail) to manage
its local development stack. For more detailed usage instructions take a look at
the [official documentation](https://laravel.com/docs/sail).

### Links

- **Your Application** http://localhost
- **Preview Emails via Mailhog** http://localhost:8025
- **Laravel Telescope** http://localhost/telescope
- 
### Import the Postman Collection

Import the `Bank API.postman_collection.json` into your Postman App.

### Start the development server

```shell
./vendor/bin/sail up
```

You can also use the `-d` option, to start the server in
the background if you do not care about the logs or still want to use your
terminal for other things.

### Run Tests

```shell
./vendor/bin/sail test
```
