<?
$table = "pages";
include "../../includes/config.php";
include $includes_dir ."includes/sessions.php";
include $includes_dir ."includes/db.php";
include $includes_dir ."includes/database.php";
include $includes_dir ."includes/create_databases.php";
include $includes_dir ."includes/languages.php";
include $includes_dir ."includes/templates.php";
include $includes_dir ."includes/pages.php";
include $includes_dir . "includes/functions.php";
if ($_POST['login']) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if (($username == 'tal' && $password == 'taltal') || ($username == 'talnitzan' && $password == 'lasso123')) {
			$_SESSION['LOGGED'] = TRUE;
			if ($username=='tal') { $_SESSION['ROLE'] = 1; }
			header('location: pages.php');
		} else {
			$_SESSION['LOGGED'] = FALSE;	
		}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Dreamax Admin Panel</title>
<link href="stylesheets.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery1.6.1.js"></script>
</head>

<body>
<div class="CONTAINER">
  <div class="TOP"><? include "include/top.php"; ?></div>
  <div class="MIDDLE">
    <form action="" method="post">
  	<br><br><br>
    <table class="PTABLE LOGINBG">        
        <tr>
        	<th><strong>Dreamax CMSLogin</strong></th>
        </tr>
        <tr>
        	<td colspan="2" class="PTITLE" valign="top">
            <table>        
                 <tr>
                    <td colspan="2" class="PTITLE"><br>Username: <input type="text" name="username" style="width:300px;"></td>
                </tr>
                <tr>
                    <td colspan="2" class="PTITLE"><br>Password: <input type="password" name="password" style="width:300px;"></td>
                </tr>
                <tr>
                	<td></td>
                    <td style="padding-left:70px;">
                    <br>
                    <input type="submit" name="login" value="Login" class="ABTN">
                    <a href="http://www.google.com/" class="ABTN BLOCK">Go Away</a>
                    </td>
                </tr>
            </table>
            </td>
        </tr>    
        <tr>
        	<td colspan="2" style="padding-right:20px; text-align:center; font-size:12px; font-weight:bold;">You've entered a PRIVATE system. if you're not authorized to be here please exit the page!!</td>
        </tr>   
    </table>
    </form>  
  </div>
  <div class="FOOTER">© All rights reserved to Dreamax Ltd 2011</div>

</div>
</body>
</html>