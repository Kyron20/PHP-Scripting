<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //removes special characters
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

  // Store username in session.
  $_SESSION['username'] = $username;

  // send user to postlogin page
  header('Location: postlogin.php');
  exit;
}

if (isset($_SESSION['username'])) {
  // If already logged in, send them to postlogin page
  header('Location: postlogin.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<body>
<!-- username box and the submit button -->

  <form method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <button type="submit">Submit</button>
  </form>
</body>
</html>
