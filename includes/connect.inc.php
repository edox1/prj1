<?php
$dbhost  = 'localhost';
$dbuser  = 'root';
$dbpass  = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$conn) {
    die('SERVER CONNECTION FAILED...\n: ' . mysql_error());
}
;
$sql    = 'CREATE DATABASE IF NOT EXISTS klixdb';
$retval = mysql_query($sql, $conn);
if (!$retval) {
    die('DATABASE CREATION FAILED\n: ' . mysql_error());
}
;
mysql_select_db('klixdb');
$sql = "CREATE TABLE IF NOT EXISTS user( " . "id int(11) NOT NULL AUTO_INCREMENT,
        " . "first_name varchar(20) NOT NULL,
        " . "last_name varchar(20) NOT NULL,
        " . "username varchar(20) NOT NULL,
        " . "email varchar(30) NOT NULL, 
        " . "password varchar(50) NOT NULL,
        " . "PRIMARY KEY (`id`)); ";

$retval = mysql_query($sql, $conn);
if (!$retval) {
    die('COULD NOT CREATE TABLE\n: ' . mysql_error());
}
;
?>

