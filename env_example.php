<?php
/*
---------------------------------------------------------------
MY ENVIRONMENT FILES
---------------------------------------------------------------
Ini adalah file environment aplikasi, silahkan ubah file ini menjadi env.php
File ini dibuat agar masing-masing orang dapat mengatur nama database, user, berbeda di perangkat masing-masing.

Tentukan mode aplikasi development / production
development: memunculkan error PHP dan query MySQL 
production: tidak memunculkan error
*/



define('MY_ENV', "development");

// Tentukan host, user, password, database, dan dbdriver
define('MY_HOST', 		"");
define('MY_USER', 		"");
define('MY_PASS', 		"");
define('MY_DATABASE', 	"");
define('MY_DBDRIVER', 	"");