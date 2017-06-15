<?php
$config = array();
$config['db_user'] = "database_username";
$config['db_host'] = "database_host";
$config['db_pass'] = "database_password";
$config['db_name'] = "database_name";
$config['slack_secret'] = "token_from_slack";
$config['timezone'] = 'Europe/Helsinki';

$config['commands'] = array(
  'help' => array(
    'description' => 'List available commands',
    'points' => 0,
  ),
  'list' => array(
    'description' => 'Lists your log entries',
    'points' => 0,
  ),
  'ranking' => array(
    'description' => 'Get ranking from previous month',
    'points' => 0,
  ),
  'stairs' => array(
    'description' => 'Use the stairs instead of elevator',
    'points' => 5,
  ),
  'walk' => array(
    'description' => 'Brief walk around the office',
    'points' => 1,
  ),
  'warmup' => array(
    'description' => 'Warm-up aerobics exercise',
    'points' => 10,
  ),
  'outdoors' => array(
    'description' => 'Outdoors exercise, such as street football',
    'points' => 30,
  ),
  'bike' => array(
    'description' => 'Coming to, or from, the office by bike',
    'points' => 15,
  ),
);