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
    <nav>
        <ul>
          <li><a href="/about">About Us</a></li>
          <li><a href="/about/culture">About Culture</a></li>
          <li><a href="/contact">Contact Us</a></li>
        </ul>
    </nav>

    <ul>
      <?php foreach ($tasks as $task) : ?>
        <li>
          <?php if ($task->completed) : ?>
            <strike><?= $task->description; ?></strike>
          <?php else : ?>
            <?= $task->description; ?>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </body>
</html>
