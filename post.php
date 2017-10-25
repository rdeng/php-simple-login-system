<?php
// Add your posting code here.
// 
// To send a user to a different page (after possibly executing some code,
// you can use the statement:
//
//     header('Location: view.php');
//
// This will send the user tp view.php. To use this mechanism, the
// statement must be executed before any of the document is output.
session_start();
$conn = pg_connect("host=localhost dbname=chattr user=student password=hacktheplanet");
$currTime = date("Y-m-d H:i:s",time());
$currUser = $_SESSION['user'][1];
$currText = $_POST[TEXT];
$result = pg_query($conn, pg_query_params($conn, "INSERT INTO public.msg(username,message,time) values ($1,$2,$3)", 
					Array($currUser, $currText, $currTime)));

header('Location: view.php');
?>
