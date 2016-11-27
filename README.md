# php-learning
My personal notes of **PHP Practitioner** course from Laracast

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
