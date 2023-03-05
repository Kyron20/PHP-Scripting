<?php
if (!isset($_COOKIE["course"])) {
  echo "Cookie named 'course' is not set.";
  setcookie("course", "COMP6390", time() + (86400 * 30), "/");
} else {
  echo "Cookie 'course' has value '".$_COOKIE["course"]."'.";
}
?>
