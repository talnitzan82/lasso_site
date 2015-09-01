<?
$table = "pages";
include "../../includes/config.php";
include $includes_dir ."includes/sessions.php";
$_SESSION['LOGGED'] = FALSE;
$_SESSION['ROLE'] = FALSE;
unset($_SESSION);
header('location: pages.php');
?>