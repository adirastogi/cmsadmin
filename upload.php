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
//check that we have a file
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
  
  if (in_array($ext,$uploadAllowExt) && in_array($_FILES["uploaded_file"]["type"],$uploadAllowMime) && 
    ($_FILES["uploaded_file"]["size"] < 2000000)) {
    //Determine the path to which we want to save this file
      $newname = $rootDir."\\".$filename;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
           $_SESSION['status'] =  "The file has been saved as: ".$newname;
        } else {
           $_SESSION['status'] =  "A problem occurred during file upload!";
        }
      } else {
         $_SESSION['status'] =  "File ".$_FILES["uploaded_file"]["name"]." already exists";
      }
  } else {
     $_SESSION['status'] =  "Error: Only html files under 2MB are accepted for upload";
  }
} else {
 $_SESSION['status'] =  "No file uploaded.";
}
?>                     

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title>Areva CMS Admin Index</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
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
			   <li><a href="upload.php"class="active">Upload File</a></li>
			  <li><a href="settings.php">Settings</a></li>
              <li><a href="logout.php">Log Out</a></li>
			</ul>
		</div><!-- end .nav -->
	 
	</div><!-- end #header -->
	
	<div id="content" class="fixed">
	  <div id="maincontent">
	<!-- ************** V MAIN CONTENT HERE  V ********************************************************************************** -->  
	
		<h3>Please select a file to upload. Maximum size: 2 MB. Your file will be uploaded into the root directoy.</h3>
        <h3 class="style2"><?php echo $_SESSION['status']; $_SESSION['status']="" ?></h3>
		<p>&nbsp;</p>
		 
        <form enctype="multipart/form-data" action="upload.php" method="post">
       <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        Choose a file to upload: <input name="uploaded_file" type="file" />
        <input type="submit" value="Upload" />
        </form> 
		
		<h3>&nbsp;</h3>
	
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