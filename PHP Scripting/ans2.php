
<?php

header("Content-Type: application/json");

$current_time = time();
$current_date = date("Y-m-d", $current_time);
$current_day = date("l", $current_time);
$current_hour = date("h:i A", $current_time);

$table = array(
  "Today's date:" => $current_date,
  "Current Time:" => $current_hour,
  "The day is:" => $current_day
);

echo json_encode($table);

?>
