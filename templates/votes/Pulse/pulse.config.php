<?php
/**
Pulse Lite Voting Script
http://s.technabled.com/PulseVote
**/
ob_start();
error_reporting(E_ALL-E_NOTICE);

define('PULSE_DIR', '/vhosts/finalproject/templates/votes/Pulse'); // absolute path of the dir where Pulse is; WITHOUT trailing slash

/** DATABASE CONNECTION CONFIGURATION **/
define('HOSTNAME', 'finalproject'); // hostname of your database; it is localhost in most cases
define('USERNAME', 'jharvard'); // username of the database
define('PASSWORD', 'crimson'); // password for the database
define('DATABASE', 'pulse_votes'); // name of the database

@mysql_connect(HOSTNAME, USERNAME, PASSWORD);
@mysql_select_db(DATABASE);

?>
