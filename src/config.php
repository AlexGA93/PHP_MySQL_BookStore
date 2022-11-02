<?php
    $db_host = 'mysql_db_container';
    $db_username = 'root'; // or root
    $db_password = 'test';
    $db_database = 'shop_db';

    // echo "'$db_host','$db_username','$db_password','$db_database'"; 

    // Mysql connection
    $conn = mysqli_connect($db_host,$db_username,$db_password,$db_database) or die('connection failed');

?>