<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?
$title = ($page['meta_title']=='') ? $page['title1'] : $page['meta_title'];
$title.= str_replace("_"," ",' '.implode(" ",$params));
$title.= $title_a;
?> 
<title><?=$title?><?=$global['perm_meta_title']?></title>
<meta name="keywords" content="<?=$page['meta_key']?>">
<meta name="description" content="<?=$page['meta_desc']?>">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<?
/*
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?=$root?>img/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="<?=$root?>img/favicon.ico" type="image/x-icon" />
*/
?>