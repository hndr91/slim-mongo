### Slim Framework + MongoDB

Just simple REST API using Slim and MongoDB. For now only GET data.

### How to Use

Just clone this repo, and import friends.json to MongoDB collection

### Structure

```
slim-mongo
└───include
    │---config.php #static
    │---dbConnect.php #db connection
    |---dbHandler.php #db model
    |
└───lib
    |---Slim # Slim Framework
    |
|---index.php # REST API routing
|----.htaccess # routing access

``

