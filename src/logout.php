<?php
    include 'config.php';

    // close session
    session_start();

    session_unset(); // reset all session's variables

    session_destroy(); // destroy all the session information

    // redirect to login component
    header('location:login.php');
?>