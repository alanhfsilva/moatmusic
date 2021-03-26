## SIMPLE Music Collection app

This is a simple music collection app. Here you can get some functionalities as:

- Register new users
- Login to the admin panel
- List artits
- Create, list and update albums

The app use an external API for collecting the artists list, also providing an internal API using REST for the transactions for albums.

# Instalation

Basically, you will need a PHP and MySQL. For MySQL database you can use a local client ou just connect remotelly. You'll need:

- PHP >= 7.1.3
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MySQL database _(local or remote)_

After installing all pre-requisites, make a clone for this project usgin:

```bash
git clone https://github.com/alanhfsilva/moatmusic.git
```

Enter in the directory _moatmusic_, set the database variables on _.env.example_ and change it name to _.env_ file and then run:

```bash
composer install
php artisan make:auth
php artisan migrate
```

Now, you can enter on _public_ folder and star the PHP server for testing purposes running:

```bash
php -S localhost:8000
```

You can also test the project [here](http://157.230.184.71/)

Enjoy :)
