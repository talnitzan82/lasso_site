<? include_once "requires.php"; ?>
<?
$page = $database->fetch("SELECT * FROM pages WHERE template LIKE 'index.php%' AND language = '$lang'");
$global = $database->fetch("SELECT * FROM global WHERE language = '$lang'");
$global_txt = explode("@@@",$global['custom']);

include_once "includes/handle_params.php";
?>
<? include "includes/selection.php"; ?>
<script>
$('#resultLand').imagesLoaded(function() {
	$('#resultLand li').wookmark({
		autoResize: true,
		container: $('#resultLand'),
		offset: 0,
		itemWidth: 255
	});
});
</script>