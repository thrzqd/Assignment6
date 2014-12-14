<?php
ini_set('memory_limit', '512M');

$DB_HOST = "localhost";
$DB_USER = "";

$DB_PASS = "";
$DB_NAME = "";

mysql_connect($DB_HOST, $DB_USER, $DB_PASS);
mysql_select_db($DB_NAME);
mysql_set_charset('utf8');
setlocale(LC_CTYPE, "en_US.UTF-8");

session_start();
session_write_close();

preg_match('/(.*?)\/public_html/i', __FILE__, $DOCUMENT_ROOT);
$DOCUMENT_ROOT = $DOCUMENT_ROOT[0].'/';



?>