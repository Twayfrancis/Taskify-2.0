<?php 

    session_start();
    session_unset();
    session_destroy();

    header("location: http://localhost/Taskify-2.0/admin-panel/admins/login-admins.php");

?>