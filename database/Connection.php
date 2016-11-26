<?php

class Connection
{
  // Use static modifier so we can use this class as a facade without need of instantiation
  public static function make()
  {
    try {
      return new PDO('mysql:host=127.0.0.1;dbname=mytodo', 'root', '');
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }
}
