<?php require 'partials/head.php'; ?>

<h1>Submit Your Name</h1>

<form action="/names" method="post">
  <input type="text" name="name">
  <button type="submit">Submit</button>
</form>

<?php require 'partials/footer.php'; ?>
