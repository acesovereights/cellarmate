<?php
session_start();
if(isset($_SESSION['USER']))
{
	session_destroy();
	header('location: ../index.php');
}


?>