<?php

/*
$animals = ['dog', 'cat'];
$animals[] = 'fish'
*/

$person = [
  'age' => 23,
  'hair' => 'black',
  'career' => 'web developer'
];

$person['name'] = 'Adhya';

unset($person['age']);

echo '<pre>';
die(var_dump($person));
echo '</pre>';

require 'index.view.php';
