<?php

$query = require 'bootstrap.php';
require 'Task.php';

$tasks = $query->selectAll('todos');

require 'index.view.php';
