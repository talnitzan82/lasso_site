<?
$table = "biz";
include "../../../includes/config.php";
include "../../../includes/sessions.php";
include "../../../includes/db.php";
include "../../../includes/database.php";
include "../../../includes/clients.php";

$id     = $_POST['id'];
$action = $_POST['action'];
$num    = $_POST['image'];
$page->DeletePost($action,$id,$num);
?>