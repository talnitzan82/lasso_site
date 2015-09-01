<?
include_once "../../includes/sessions.php";
include_once "../../includes/db.php";
include_once "../../includes/database.php";
include_once "../../includes/languages.php";
include_once "../../includes/form.php";
include_once "../../includes/config.php";
include_once "../../includes/functions.php";

$root='/';

include_once "functions.php";
include_once "forms.php";

$page = $database->fetch("SELECT * FROM pages WHERE template LIKE 'index.php%' AND language = '$lang'");
$global = $database->fetch("SELECT * FROM global WHERE language = '$lang'");
$global_txt = explode("@@@",$global['custom']);

$_SERVER['REQUEST_URI'] = urldecode($_POST['href']);
include_once "handle_params.php";
ob_start();
?>
	<div class="row-fluid">    
    <?
	include_once "search_checked.php";
	include_once "categories.php";
	include_once "search_results.php";
	?>
	</div>
	
	
<script type="text/javascript" src="js/wookmark.js"></script>	
<script type="text/javascript">

if ( !$.browser.msie ) {
	
		$(".search-inside").on("click",".EFCLOSE",function(){
		 $(".search-more").hide(); 
		 $(".search-submitter2").show();
	});

	$(".dark-gray a").each(function(){
		var href = $(this).attr("href");
		$(this).attr("href","javascript:void(0)");
		$(this).attr("url",href);
	});
	$(".seachslotb").each(function(){
		var href = $(this).attr("href");
		$(this).attr("href","javascript:void(0)");
		$(this).attr("url",href);
	});
	
	$(".dark-gray a,.seachslotb").on("click",function() {
		var href = $(this).attr("url");
		$.post("includes/push_state.php",{ href: href},function(data) {
			var obj = jQuery.parseJSON(data);
			History.replaceState({state:3,rand:Math.random()}, obj.title , href);			
			$("#pjax-container").html(obj.data);
			$('#resultLand li').wookmark({
				autoResize: true,
				container: $('#resultLand'),
				offset: 0,
				itemWidth: 255
			});	
			$('#resultLand').trigger('refreshWookmark');
			
		});
		
	});
}
$('#resultLand').imagesLoaded(function() {
	
	$('#resultLand li').wookmark({
		autoResize: true,
		container: $('#resultLand'),
		offset: 0,
		itemWidth: 255
	});	
});

</script>
<script type="text/javascript" src="js/script.js"></script>
<?
$data = ob_get_clean();
$title = ($page['meta_title']=='') ? $page['title1'] : $page['meta_title'];
$title.= str_replace("_"," ",' '.implode(" ",$params));

//$data  = str_replace("\'","'",$data);
//$title = trim(str_replace(array("\\",'"',"\n","\r","\t"),array("\\\\",'\"','','',""),$title.$global['perm_meta_title']));

//$data = trim(str_replace(array('"',"\n","\r","\t"),array('\"','','',""),$data));
//$data = json_encode($data);
//$json_object['data'] = $data;
//$json_object['title'] = $title.$global['perm_meta_title'];
//echo json_encode($json_object);

//$data = trim(str_replace(array("\\",'"',"\n","\r","\t"),array("\\\\",'\"','','',""),$data));

$data = json_encode($data);
$title = json_encode($title.$global['perm_meta_title']);

echo '{"data": '.$data.' ,"title": '.$title.'}';