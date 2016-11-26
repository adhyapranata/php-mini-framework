<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP Learning</title>
    <style media="screen">
      header {
        background-color: #e3e3e3;
        padding: 2em;
        text-align: center;
      }
    </style>
  </head>
  <body>

    <h1>Task For The Day</h1>

    <!-- Example One -->
    <ul>
      <?php foreach ($task as $heading => $value) : ?>
        <li>
          <strong><?= ucwords($heading); ?></strong>: <?= $value; ?>
        </li>
      <?php endforeach; ?>
    </ul>

    <!-- Example Two -->
    <ul>
      <li>
        <strong>Name: </strong> <?= $task['title']; ?>
      </li>

      <li>
        <strong>Due Date: </strong> <?= $task['due']; ?>
      </li>

      <li>
        <strong>Personal Responsible: </strong> <?= $task['assigned_to']; ?>
      </li>

      <li>
        <strong>Status: </strong> <?= $task['completed'] ? 'Complete' : 'Incomplete' ; ?>
      </li>
    </ul>

  </body>
</html>
