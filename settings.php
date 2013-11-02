<?php   
session_start();
if ($_SESSION["login"] != "true"){   
 header("Location:login.php");   
 $_SESSION["error"] = "<font color=red>You don't have privileges to see the admin page.</font>";  
 exit;   
}
 require_once("config.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title>Areva CMS Admin Index</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="http://localhost/wwwroot/cmsadmin/ckeditor/ckeditor.js"></script>
	<meta name="description" content=" add page description... "  />
	<meta name="keywords" content=" add keywords... " />
	
	<!-- links to stylesheets and scripts -->
	<link href="resources/style.css" rel="stylesheet" type="text/css" />
	
<style type="text/css">
<!--
body {
	background-color: #999999;
}
body,td,th {
	color: #666666;
}
.style1 {color: #000000}
.style2 {
	color: #CC0000
}
-->
</style></head>
<body>

	<div id="header" class="fixed">
	
		<div class="logo"><img src="resources/logo-td-in_home.png" alt="logo" width="180" height="100" /></div>
  <!-- end .logo -->
		
		<div class="nav">
			<ul>
			  <li><a href="adminindex.php" >Home</a></li>
			  <li><a href="create.php">Create Page</a></li>
			   <li><a href="upload.php">Upload File</a></li>
			  <li><a href="settings.php"class="active">Settings</a></li>
              <li><a href="logout.php">Log Out</a></li>
			</ul>
		</div><!-- end .nav -->
	 
	</div><!-- end #header -->
	
	<div id="content" class="fixed">
	  <div id="maincontent">
	<!-- ************** V MAIN CONTENT HERE  V ********************************************************************************** -->  
	
		<h3>You have the following settings </h3>
        <br />
		<p>
		<?php
		
		   echo "<h3>Admin Username:".$user."</h3>";
		   echo "<h3>Admin Passsword:".$passwd."</h3>";
           echo "<h3>Root Directory:".$rootDir."</h3>";
           echo "<h3>Files allowed for upload:</h2>";
		   foreach($uploadAllowExt as $val){
		   echo "<h3>".$val."</h3>";
		   }
		?>
		
		
		&nbsp;</p>
		
		 
		<!-- ************** V END MAIN CONTENT HERE  V ********************************************************************************** -->
      </div>
	  <!-- end #maincontent -->
	  <!-- end #sidebar -->
    </div>
	<!-- end #content -->
	
	
	
	<div id="footer" class="fixed">
	
		<p class="copyright">Copyright &copy; 2009 - 2010 Sitename.com. All Rights Reserved.</p>
		
		<!-- in order to use this template legally the following links must remain intact. --> 
		<p class="credits">
			<strong>Credits:</strong> Initial 
		   <a href="http://www.oricemedia.ro/servicii/design-siteuri-web.html" onClick="javascript:return confirm('Do you want to delete this file ?');" 
		   title="web design, realizare site-uri, pagini web">web design</a> by  
		   <a href="http://www.oricemedia.ro/" title="agentie web design mures">Orice Media</a>.
		 </p>
						   
	</div><!-- end #footer -->
</body>
</html>