<?php
// prints out the list of all standings so far
function print_list($username, $all = FALSE){
  global $connection;

  $sql = "SELECT workout, points, timestamp FROM workout_log "
      . "WHERE username='$username'";
  echo "Hi *{$username}*! ";
  if (!$all) {
    $message = "Here are your workouts from current month:\r\n";
    $sql .= " AND month=" . (int) date('m') . " AND year=" . date('Y');
  }
  else {
    $message = "Here are all your workouts so far:\r\n";
  }

  print $message;
  $result = mysqli_query($connection, $sql);
  $counter = 0;
  $points = 0;
  while($row = mysqli_fetch_array($result)){
    $counter++;
    $points += $row['points'];
    echo "{$row['workout']} _({$row['points']} points)_ at {$row['timestamp']}\r\n";
  }
  if ($counter == 0) {
    echo "Nothing here yet, start moving _*{$username}*_ !";
  }
  else {
    print "*Total: $points points after $counter workouts.*\r\n";
  }
}

// prints a random success message for the current user
function print_success($username){
  $outputs = array();
  $outputs[] = "Good job, _*{$username}*_ ! Do you feel fitter already?\r\n";
  $outputs[] = "There you go, _*{$username}*_ ! How does that feel?\r\n";
  $outputs[] = "Oho! Keep going _*{$username}*_ !\r\n";
  $outputs[] = "Persistance is the KEY to success and you know that _*{$username}*_, right?";
  $outputs[] = "Yeah! We are all proud of you _*{$username}*_ !";
  $outputs[] = "A MA ZING !! :D";
  $outputs[] = "You're rocking!!";
  $outputs[] = "_*{$username}*_ is working out like a boss!";
  $outputs[] = "Oh my gosh that was GREEEEEAT _*{$username}*_ !";
  $outputs[] = "I am sure somebody is proud now! ;-)";
  $outputs[] = "(...I do not have words...)";

  echo $outputs[array_rand($outputs, 1)];
}

// prints the help message
function print_help(){
  echo "List of available commands:\r\n";
  foreach ($GLOBALS['config']['commands'] as $command => $info) {
    $message = "*/workout $command* _" . $info['description'] . "_";
    if (!in_array($command, array('list', 'help'))) {
      $message .= " (". $info['points'] . " points)";
    }
    echo $message . "\r\n";
  }
}

// prints the general error message
function print_error($error_message = ''){
  if (!$error_message) {
    echo "Unfortunately something went wrong. Please check your settings.\r\n";
    return;
  }
  echo $error_message;
}

function execute_command($command, $username) {
  global $config;

  $all = FALSE;
  switch ($command) {
    case 'list --all':
      $all = TRUE;
    case 'list':
      print_list($username, $all);
      break;
    case 'help':
      print_help();
      break;
    default:
      // Try to log it:
      if (!empty($config['commands'][$command]['description']) &&
          !empty($config['commands'][$command]['points']) &&
          is_numeric($config['commands'][$command]['points'])) {
        workout_log($username, $command, $config['commands'][$command]['points']);
      }
      else {
        print_error('Command not properly configured.');
      }
  }
}

function workout_log($username, $command, $points) {
  global $connection;

  $month = (int) date('m');
  $year = (int) date('Y');
  $sql = "INSERT INTO workout_log "
    . "(username, workout, points, month, year) VALUES "
    . "('$username', '$command', $points, " . $month . ", ". $year . ")";

  $result = mysqli_query($connection, $sql);
  
  if ($result) {
    print_success($username);
  }
  else {
    print_error("There was an error while logging your workout. Please try again later.");
  }
  
}