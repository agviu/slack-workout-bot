<?php
/*
Plugin Name: Slack Workout Logger
Description: Backend implementation of the Slack /workout command
Author: Exove
Version: 1.0.0
*/
require_once('config.php');
require_once('functions.php');

$GLOBALS['config'] = $config;
$GLOBALS['connection'] = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass']);
if (!$connection) {
  die("Connection error");
}

mysqli_select_db($connection, $config['db_name']);

// run the script only if the $_POST array is set and the Slack secret is correct
if ($_POST && $_POST['token'] == $config['slack_secret']) {
  $username = filter_var(trim(strtolower($_POST['user_name'])), FILTER_SANITIZE_STRING);
  $command = filter_var(trim(strtolower($_POST['text'])), FILTER_SANITIZE_STRING);

//if ($_GET && $_GET['token'] == $config['slack_secret'] &&
//    !empty($_GET['username']) && !empty($_GET['command'])) {
//  $username = filter_var(trim(strtolower($_GET['username'])), FILTER_SANITIZE_STRING);
//  $command = filter_var(trim(strtolower($_GET['command'])), FILTER_SANITIZE_STRING);

  foreach ($config['commands'] as $command_name => $command_info) {
    if (substr_count($command, $command_name)) {
      execute_command($command, $username);
      exit;
    }
  }

  print_error('Command not found.');
  die();
}

print_error();
