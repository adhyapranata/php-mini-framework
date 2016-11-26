<?php

require 'Task.php';
require 'functions.php';

$pdo = connectToDB();
$tasks = fetchAllTask($pdo);

require 'index.view.php';
