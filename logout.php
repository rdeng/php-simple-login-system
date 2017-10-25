<?php

// Your logout code goes here.
session_start();
//unset($_SESSION['user']);
session_destroy();
header('Location: index.php');

?>
