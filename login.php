<?php

// The login.php is invoked when the user is either trying to create a new
// account or to login. If it's the former, the NEW parameter will be set.
// To send a user to a different page (after possibly executing some code,
// you can use the statement:
//
//     header('Location: view.php');
//
// This will send the user tp view.php. To use this mechanism, the
// statement must be executed before any of the document is output.
session_start();
$errorMes = "Login Failed!";
if(isset($_POST['NEW'])) 
{
	// Your new user creation code goes here. If the user name
	// already exists, then display an error. Otherwise, create a new
	// user account and send him to view.php.
	$conn = pg_connect("host=localhost dbname=chattr user=student password=hacktheplanet");
	$result = pg_query($conn, "SELECT * FROM public.user WHERE username='$_POST[USER]'");

	if($row = pg_fetch_row($result))
	{
		$errorMes = "User $_POST[USER] already exists!";
	}
	else
	{
		$result = pg_query_params($conn, "INSERT INTO public.user(username,password) values ($1,$2)", 
								  Array($_POST[USER], $_POST[PASS]));
		$result = pg_query($conn, "SELECT * FROM public.user WHERE username='$_POST[USER]'");
		$row = pg_fetch_row($result);
		$_SESSION['user'] = $row;
		header('Location: view.php');
	}
} 
else 
{
	// Your user login code goes here. If the user name and password
	// are not correct, then display an error. Otherwise, log in the
	// user and send him to view.php.
	$conn = pg_connect("host=localhost dbname=chattr user=student password=hacktheplanet");
	$result = pg_query($conn, "SELECT * FROM public.user WHERE username='$_POST[USER]' AND password='$_POST[PASS]'");

	if($row = pg_fetch_row($result))
	{
		$_SESSION['user'] = $row;
		header('Location: view.php');
	}
}
?>
<DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.2//EN">
<HEAD>
    <TITLE>Chattr</TITLE>
</HEAD>
<BODY BGCOLOR=WHITE>
<TABLE ALIGN="CENTER">
<TR><TD>
<H1>Chattr</H1>
</TD></TR>
<TR><TD>
<H2><?php echo $errorMes ?></H2>
<a href="index.php">Back</a>
</TD></TR>
</TABLE>
</BODY>
