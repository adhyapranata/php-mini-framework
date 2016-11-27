<?php

class QueryBuilder
{
  protected $pdo;

  // Type hinting PDO $pdo
  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  function selectAll($table)
  {
    $statement = $this->pdo->prepare("select * from {$table}");
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_CLASS);
  }
}
