<?php

$greeting = "Hello, " . htmlspecialchars($_GET['name']);

require 'index.view.php';
