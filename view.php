<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.2//EN">
<HEAD>
    <TITLE>Chattr</TITLE>
</HEAD>
<BODY BGCOLOR=WHITE>
<TABLE ALIGN="CENTER">
<TR><TD>
<H1>Chattr</H1>
</TD></TR>

<?php
    session_start();

	// The following <TR> element should only appear if the user is
	// logged in and viewing his own entry.
    if(!empty($_SESSION['user']))
    {
        $URLUSER = $_GET['user'];
        if(!($URLUSER) || (($URLUSER) && ($URLUSER == $_SESSION['user'][1])))
        {
            echo '<TR><TD>';
            echo '<FORM ACTION="post.php" METHOD="POST">';
            echo '<TABLE CELLPADDING=5>';
            echo '<TR><TD>Message:</TD><TD><INPUT TYPE="TEXT" NAME="TEXT">';
            echo '<INPUT TYPE="SUBMIT" VALUE="Submit"></TD></TR>';
            echo '</TABLE>';
            echo '</FORM>';
            echo '</TD></TR>';  
        }
    }
?>
    
<?php
	// The following <TR> element should always appear if the user
	// exists.
?>
    <TR><TD>
    <TABLE CELLPADDING=5>
	<?php
		// Display user's posts here. The structure is:
		//
            $conn = pg_connect("host=localhost dbname=chattr user=student password=hacktheplanet");
            $URLUSER = $_GET['user'];
            $result = pg_query($conn, "SELECT * FROM public.user WHERE username='$URLUSER'");

            if($row = pg_fetch_row($result))
            {
                echo '<TR><TH>When</TH><TH>Who</TH><TH>What</TH></TR>';
                $result = pg_query($conn, "SELECT * FROM public.msg WHERE username='$URLUSER'");
                while($row = pg_fetch_row($result))
                {
                    echo '<TR>';
                    echo '<TD>'.$row[2].'</TD>';
                    echo '<TD>'.$row[0].'</TD>';
                    echo '<TD>'.$row[1].'</TD>';
                    echo '</TR>';
                }
            }
            else if(!empty($_SESSION['user']) && !($URLUSER))
            {
                echo '<TR><TH>When</TH><TH>Who</TH><TH>What</TH></TR>';
                $currUser = $_SESSION['user'][1];
                $result = pg_query($conn, "SELECT * FROM public.msg WHERE username='$currUser'");
                while($row = pg_fetch_row($result))
                {
                    echo '<TR>';
                    echo '<TD>'.$row[2].'</TD>';
                    echo '<TD>'.$row[0].'</TD>';
                    echo '<TD>'.$row[1].'</TD>';
                    echo '</TR>';
                }
            }
    ?>
    </TABLE>
    </TD></TR>
<?php
	// The following <TR> element should be displayed if the user
	// name does not exist. Add code to display user name.
    $conn = pg_connect("host=localhost dbname=chattr user=student password=hacktheplanet");
    $URLUSER = $_GET['user'];
    $result = pg_query($conn, "SELECT * FROM public.user WHERE username='$URLUSER'");
    if(!($row = pg_fetch_row($result)) && $URLUSER)
    {
        echo '<TR><TD>';
        echo '<H2>User '.$_GET['user'].' does not exist!</H2>';
        echo '</TD></TR>';
    }
?>

<?php
	// The following <TR> element should only be shown if the user
	// is logged in.
    if(!empty($_SESSION['user']))
    {
        echo '<TR><TD><A HREF="logout.php">Logout</A></TR></TD>';
    }
?>

<?php
	// Done!
?>
</TABLE>
</BODY>

