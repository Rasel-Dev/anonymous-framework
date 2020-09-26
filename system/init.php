<?php

spl_autoload_register(function ($className) {
  include "classes/$className.php";
});
//Debug Mode Conditions start...
$level = (DEBUG_MODE) ? E_ALL : 0;
error_reporting($level);
// always use TRUE
ini_set('ignore_repeated_errors', TRUE);
// Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment
ini_set('display_errors', DEBUG_MODE);
// Error/Exception file logging engine.
ini_set('log_errors', TRUE);

if (!file_exists('../tmp/logs/errors.log')) {
  // Create error file
  fopen('../tmp/logs/errors.log', 'w');
  // Logging file path
  ini_set('error_log', '../tmp/logs/errors.log');
} else {
  ini_set('error_log', '../tmp/logs/errors.log');
}

$rout = new rout;
