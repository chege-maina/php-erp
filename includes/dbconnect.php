<?php

$dbserver = getenv("DB_SERVER") !== false ? getenv("DB_SERVER") : "localhost";
$dbuser = getenv("DB_USER") !== false ? getenv("DB_USER") : "root";
$dbpass = getenv("DB_PASS") !== false ? getenv("DB_PASS") : "";
$dbname = getenv("DB_NAME") !== false ? getenv("DB_NAME") : "msl_db";

$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
