<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include_once "../../includes/sessions.php";
include_once "../../includes/db.php";
include_once "../../includes/database.php";
include_once "../../includes/languages.php";
include_once "../../includes/form.php";
include_once "../../includes/config.php";
include_once "../../includes/functions.php";

header('content-type:text/html;charset=utf-8');

$sql = "SELECT * FROM products WHERE sub !=0 ORDER BY sort ASC";
$query = $database->query($sql);
while($row=mysql_fetch_assoc($query)) {
	$array = array();
	$array['id'] = $row['id'];
	$array['details']['name'] = $row['name'];
	$array['details']['city'] = $row['city'];
	$array['details']['address'] = $row['address'];
	$array['details']['googleAddress1'] = $row['test1'];
	$array['details']['googleAddress2'] = $row['test2'];
	$array['details']['text1'] = $row['short_content'];
	$array['details']['text2'] = str_replace(array("\t","\r","\n"),array("","",""),trim(strip_tags($row['content1'])));
	$array['details']['contact'] = $row['contact'];
	$array['details']['phone'] = $row['phone'];
	$array['details']['website'] = $row['website'];
	$array['details']['features'] =$row['name'];
	
	# set pictures
	$array2 = array();
	$sql2   = "SELECT * FROM gallery WHERE sub = '{$row['id']}' ORDER BY logo DESC,sort DESC";
	$query2 = $database->query($sql2);
	while($row2=mysql_fetch_assoc($query2)) {		
		$array2[] = 'http://www.lasso.co.il/'.$row2['image'];			
	}	
	$array['details']['pictures'] = $array2;
	
	#set categories
	if ($row['categories']!='') {
		$array2 = array();
		$sql2   = "SELECT * FROM categories WHERE id in (".$row['categories'].") ORDER BY sort DESC";
		$query2 = $database->query($sql2);
		while($row2=mysql_fetch_assoc($query2)) {		
			$array2[] = $row2['name'];			
		}	
		$array['details']['featuresToShow'] = $array2;	
	}
	
	$data[] = $array;
	
	
}
ob_start();
?>
jsonCallback(
<?
echo json_encode($data);
?>
)