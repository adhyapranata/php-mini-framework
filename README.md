# php-learning
My personal notes of **PHP Practitioner** course from Laracast

Project requirements:
* PHP 7
* mySQL
* composer
* mySQL GUI. Ex: Sequel Pro (Optional)

How to run:
1. Setup the database in `config.php`. Make sure to create `users` table with `name` column
2. run `composer install`
3. run `php -S localhost:8888`


## 01-Get PHP Installed
**Use Homebrew to install the PHP**

To search all PHP related formulas
`brew search php`

To install the php (mine is php 7.1) formula
`brew install homebrew/php/php71`

## 02-Install a Proper Code Editor
I'm using Atom. If you need curated atom packages for your development environment, check out [mehcode/awesome-atom](https://github.com/mehcode/awesome-atom)

## 03-Variables
You can echo your variable along with strings using these 3 ways:
* `echo "Hello, $name"`
* `echo "Hello, {$name}"`
* `echo 'Hello, ' . $name`

## 04-PHP and HTML
Shorthand for PHP echo:
```php
<?php
  <?= 'Hello, World' ?>
```

Sanitize HTML special characters:
```php
  <?= "Hello, " . htmlspecialchars($_GET['name']); ?>
```

## 05-Separating PHP Logic From The Presentation
So far we only have single file called index.php. For separation of concerns, Follow this steps:
1. Create new file specifically to display HTML. Use proper name convention for the file like **index.view.php**
2. Move all the HTML code to **index.view.php**
3. Call **index.view.php** in **index.php** using `require index.view.php`

## 06-Understanding Arrays
Nice way to iterate array in HTML
```php
  <?php foreach ($names as $name) : ?>
    <li><?= $name; ?></li>
  <?php endforeach; ?>
```

## 07-Associative Arrays
**Create associative array**
```php
<?php

$person = [
  'age' => 23,
  'hair' => 'black',
  'career' => 'web developer'
];
```

**Add an associative array item**
```php
<?php

$person['name'] = 'Adhya';
```

**Delete an associative array item**
```php
<?php

unset($person['age']);
```

**Print an associative array**
```php
<ul>
  <?php foreach ($person as $key => $feature) : ?>
    <li><strong><?= $key; ?></strong> <?= $feature; ?></li>
  <?php endforeach; ?>
</ul>
```

**Echo an array**
```php
<?php

echo '<pre>';
die(var_dump($person));
echo '</pre>';
```

**Add a regular array item**
```php
<?php

$animals = ['dog', 'cat'];
$animals[] = 'fish'
```

## 08-Booleans
Convert a string to uppercase
```php
<?php

ucwords($heading)
```

Ternary operator
```php
<li>
  <strong>Status: </strong> <?= $task['completed'] ? 'Complete' : 'Incomplete' ; ?>
</li>
```

## 09-Conditionals
`null`

## 10-Functions
Die Dump Function
```php
<?php

function dd($data){
  echo "<pre>";
  die(var_dump($data));
  echo "</pre>";
}
```

## 11-MySQL 101
If you don't have mysql installed yet
```
brew search mysql
brew install mysql
```

Adding user accounts. [click here for more information](http://dev.mysql.com/doc/refman/5.7/en/adding-users.html)
1. Connect as root
```shell
mysql -u root -p
```
2. Create users and grant access
```sql
mysql> CREATE USER 'finley'@'localhost' IDENTIFIED BY 'some_pass';
mysql> GRANT ALL PRIVILEGES ON *.* TO 'finley'@'localhost'
    ->     WITH GRANT OPTION;
mysql> CREATE USER 'finley'@'%' IDENTIFIED BY 'some_pass';
mysql> GRANT ALL PRIVILEGES ON *.* TO 'finley'@'%'
    ->     WITH GRANT OPTION;
mysql> CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin_pass';
mysql> GRANT RELOAD,PROCESS ON *.* TO 'admin'@'localhost';
mysql> CREATE USER 'dummy'@'localhost';
```

Some useful sql commands:
1. To show all databases
```sql
mysql> show databases;
```
2. To create a database
```sql
mysql> create database database_name;
```
3. To use database
```sql
mysql> use database_name;
```
4. To show all tables
```sql
mysql> show tables;
```
5. To show table structure
```sql
mysql> describe table_name;
```
6. To create a table
```sql
mysql> create table todos (id integer PRIMARY KEY AUTO_INCREMENT, description text NOT NULL, completed boolean NOT NULL);
```
7. To delete a table
```sql
mysql> drop table_name;
```
8. To insert a data row
```sql
mysql> insert into todos (description, completed) values('Go to the store', false);
```
9. To select all data rows in a table
```sql
mysql> select * from table_name;
```

## 12-Classes 101
Simple example of PHP class:
```php
<?php

class Task
{
  public $description;
  public $completed = false;

  public function __construct($description)
  {
    # Automatically triggered on instantiation
    $this->description = $description;
  }

  public function complete()
  {
    $this->completed = true;
  }

  public function isComplete()
  {
    return $this->completed;
  }
}
```

## 13-PDO
Connect to database
```php
<?php

// Always wrap PDO connection in try catch
try {
  return new PDO('mysql:host=127.0.0.1;dbname=mytodo', 'root', '');
} catch (PDOException $e) {
  die($e->getMessage());
}
```
Prepare and execute query
```php
<?php

$statement = $pdo->prepare('select * from todos');
$statement->execute();
```
Fetch data from database
```php
<?php

// return value in both associative and index array
var_dump($statement->fetchAll());

// return value in associative array
var_dump($statement->fetchAll(PDO::FETCH_OBJ));

// return value and assign it to a class
var_dump($statement->fetchAll(PDO::FETCH_CLASS, 'Task'))
```

## 14-PDO Refactoring
Use static modifier so we can use this class as a facade without need of instantiation
```php
<?php

public static function make()
{
  try {
    return new PDO('mysql:host=127.0.0.1;dbname=mytodo', 'root', '');
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
```

Create a bootstrap file to accommodate the pre-setup. For example:
```php
<?php

require 'database/Connection.php';
require 'database/QueryBuilder.php';

return new QueryBuilder(
  Connection::make()
);
```

## 15-Hide Your Secret Password
Create a config file to handle the general setting of your application (Database, Email, etc.)
```php
<?php

return [
  'database' => [
      'name' => 'mytodo',
      'username' => 'root',
      'password' => '',
      'connection' => 'mysql:host=127.0.0.1',
      'options' => [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]
  ]
];
```
## 16-Make a Router
user `trim` to cut white spaces or specific characters off from the outer sides of a string
```php
<?php

trim($_SERVER['REQUEST_URI'], '/');
```

*Can't use $this in a static function. use 'new static' or 'new self' instead to instantiate self class.*

Simple Router class example:
```php
<?php

<?php

class Router
{
  protected $routes = [];

  public static function load($file)
  {
    // Use 'new static' or 'new self' which equal to 'new Router'
    $router = new static;

    require $file;

    return $router;
  }

  public function define($routes)
  {
    $this->routes = $routes;
  }

  public function direct($uri)
  {
    if (array_key_exists($uri, $this->routes)) {
      return $this->routes[$uri];
    }

    throw new Exception("No route defined for this uri");

  }
}
```

Put routes list somewhere else in the root directory
```php
<?php

$router->define([
  '' => 'controllers/index.php',
  'about' => 'controllers/about.php',
  'about/culture' => 'controllers/about-culture.php',
  'contact' => 'controllers/contact.php',
]);
```

## 17-Dry Up Your Views
`null`

## 18-Filtering Arrays
```php
<?php

class Post
{
  public $title;
  public $author;
  public $published;

  public function __construct($title, $author, $published)
  {
    $this->title = $title;
    $this->author = $author;
    $this->published = $published;
  }

  $posts = [
    new Post('My First Post', 'JW', true),
    new Post('My First Post', 'JW', true),
    new Post('My First Post', 'AW', true),
    new Post('My First Post', 'TT', false)
  ]

  //Array filter
  $publishedPosts = array_filter($posts, function($post) {
    return $post->published;
  });

  //Array map
  $posts = array_map(function($post) {
    return (array) $post;
  }, $posts);

  //Array column
  $authors = array_column($posts, 'author', 'title');
}

```

## 19-Forms Request Types and Routing
Use `parse_url` to filter out the query string
```php
<?php

public static function uri()
{
  return $uri = trim($_SERVER['REQUEST_URI'], '/');
  return $uri = trim(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
  );
}
```

Group the requests into based on their action
```php
<?php

$router->get('', 'controllers/index.php');
$router->get('about', 'controllers/about.php');
$router->get('about/culture', 'controllers/about-culture.php');
$router->get('contact', 'controllers/contact.php');
$router->post('names', 'controllers/add-name.php');
```

## 20-Dynamic Inserts With PDO
Put the input array as a parameter of execute method to bind the values
```php
<?php
public function insert($table, $parameters)
{
  $sql = sprintf(
    'insert into %s (%s) values (%s)',
    $table,
    implode(', ', array_keys($parameters)),
    ':' . implode(', :', array_keys($parameters))
  );

  try {
    $statement = $this->pdo->prepare($sql);
    $statement->execute($parameters);
  } catch (Exception $e) {
    return $e->getMessage();
  }
}
```

For more readable sql query template, use sprintf
```php
<?php

$sql = sprintf(
  'insert into %s (%s) values (%s)',
  $table,
  implode(', ', array_keys($parameters)),
  ':' . implode(', :', array_keys($parameters))
);
```

Use `header` to redirect
```php
<?php

header('Location: /');
```

## 21-Composer Autoloading
Autoload classes with composer (in `composer.json` file). Write `./` to load all the classes in the project
```json
{
  "autoload": {
    "classmap": [
      "./"
    ]
  }
}
```

## 22-Your First DI Container
Class for Dependency Injection Container
```php
<?php

class App
{
  protected static $registry = [];

  public static function bind($key, $value)
  {
    static::$registry[$key] = $value;
  }

  public static function get($key)
  {
    if (! array_key_exists($key, static::$registry)) {
      throw new Exception("No {$key} is bound in the container");
    }
    return static::$registry[$key];Â
  }
}
```

*Note: Always run `composer-autoload` when adding new class to update the autoload file*

## 23-Refactoring to Controller Classes
Create a `helper` file only if you already have a handful of global functions.
Try to keep global function as little as possible.

use `extract($data)` to extract data from `compact('users')` function.

Use "Splat" function to break array into arguments
```php
<?php
  return $this->callAction(
    ...explode('@', $this->routes[$requestType][$uri])
  );
```

## 24-Switch to Namespaces
To add `namespace`
```php
<?php
namespace App\Core\Database;
```

To use class with namespace
```php
<?php
use App\Core\Database\Connection
```

*Note: When using `use`, it should be written after `namespace`*

## 25-Meet Your Batteries Included Framework Laravel
null
