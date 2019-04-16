<?php
    require_once __DIR__ . '/db_config.php';
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE) or die(mysql_error());
?>