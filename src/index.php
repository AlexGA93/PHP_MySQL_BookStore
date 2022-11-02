<?php 
    session_start();
    // session start to access to user's indormation as local state

    // connection to mysql database
    include 'config.php';

    // redirect to login if there isn't user's id in session
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    }

?>
