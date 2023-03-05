<?php
session_start();

if (!isset($_SESSION['username'])) {
  // if not logged in, send them to login page
  header('Location: ans4.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<body>
Hello <?php echo $_SESSION['username']; ?>, you are logged in.
<!-- logout button below -->

  <form method="post" action="logout.php">
    <button type="submit">Logout</button>
  </form>
</body>
</html>
