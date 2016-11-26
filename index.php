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
    <header>
      <!-- Sanitizing Input -->
      <h1><?= "Hello, " . htmlspecialchars($_GET['name']); ?></h1>
    </header>
  </body>
</html>
