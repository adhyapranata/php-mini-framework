<?php require 'partials/head.php'; ?>

<h1>Users</h1>

<ul>
  <?php foreach ($users as $user) : ?>
    <li><?= $user->name; ?></li>
  <?php endforeach; ?>
</ul>

<h1>Submit Your Name</h1>

<form action="/users" method="post">
  <input type="text" name="name">
  <button type="submit">Submit</button>
</form>

<?php require 'partials/footer.php'; ?>
