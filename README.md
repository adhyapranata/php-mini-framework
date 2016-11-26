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
$person = [
  'age' => 23,
  'hair' => 'black',
  'career' => 'web developer'
];
```

**Add an associative array item**
```php
$person['name'] = 'Adhya';
```

**Delete an associative array item**
```php
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
echo '<pre>';
die(var_dump($person));
echo '</pre>';
```

**Add a regular array item**
```php
$animals = ['dog', 'cat'];
$animals[] = 'fish'
```

## 08-Booleans
Convert a string to uppercase
```php
ucwords($heading)
```

Ternary operator
```php
<li>
  <strong>Status: </strong> <?= $task['completed'] ? 'Complete' : 'Incomplete' ; ?>
</li>
```

## 09-Conditionals

## 10-Functions

## 11-MySQL 101

## 12-Classes 101

## 13-PDO

## 14-PDO Refactoring

## 15-Hide Your Secret Password
