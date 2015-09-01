<div id="slider" class="nivoSlider">
<?	
if ($page['image2']!='') { 
$image = explode(",",$page['image1']);
} else {
$image[1] ="images/image7.png";	
}
unset($image[0]);
foreach($image as $value) {
?>
<img src="<?=$root.$value?>" alt="">
<?
}
?>
</div>
<div class="IIMT"><?=$t_slogen?></div>
<div class="ISO"></div>  