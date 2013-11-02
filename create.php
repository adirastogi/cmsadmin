<?php   
session_start();
if ($_SESSION["login"] != "true"){   
 header("Location:login.php");   
 $_SESSION["error"] = "<font color=red>You don't have privileges to see the admin page.</font>";  
 exit;   
}
?>
<?php
 require_once("config.php");
 
 if(isset($_POST['save']) && $_POST['filename']!="" && $_GET['op']==1){
    
 if ( get_magic_quotes_gpc() )
		$postedValue = htmlspecialchars( stripslashes( $_POST['editor'] ) ) ;
 else
		$postedValue = htmlspecialchars( $_POST['editor'] ) ;
 
 $filename = $_POST['filename'] ;
 $newname = $rootDir."\\".$filename;
 if (!file_exists($newname)){
  $handle =	fopen($newname,"w");
  file_put_contents($newname,$postedValue);
  fclose($handle);
  $_SESSION['status']= "The file was created succesfully.";
 }
 else{
  $_SESSION['status'] = "A file by this name already exists. Please choose another name";
 }
 
 }
 else if(isset($_POST['disc'])){
   $_SESSION['status']= "The file was not created.";
   header("Location:adminindex.php");
 }

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
			  <li><a href="create.php"class="active">Create Page</a></li>
			   <li><a href="upload.php">Upload File</a></li>
			  <li><a href="settings.php">Settings</a></li>
              <li><a href="logout.php">Log Out</a></li>
			</ul>
		</div><!-- end .nav -->
	 
	</div><!-- end #header -->
	
	<div id="content" class="fixed">
	  <div id="maincontent">
	<!-- ************** V MAIN CONTENT HERE  V ********************************************************************************** -->  
	
		<h3>Create a new HTML web page.</h3>
        <h3 class="style2"><?php echo $_SESSION['status']; $_SESSION['status']="" ?></h3>
		<p>&nbsp;</p>
		 <form method="post" action="http://localhost/wwwroot/cmsadmin/create.php?op=1">
		 <p>
         <textarea name="editor">
		 
		 </textarea> 	
		<script type="text/javascript">
				CKEDITOR.replace( 'editor',
					{
						fullPage : true
					});
			</script>
			</p>
		<input type="text" name="filename" size="15" maxlength="15">	
		<input type="submit" value="Save" name="save"/>
        <input type="submit" value="Discard" name="disc"/>
	</form>
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