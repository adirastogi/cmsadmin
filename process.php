<?php   
session_start();
if ($_SESSION["login"] != "true"){   
 header("Location:login.php");   
 $_SESSION["error"] = "<font color=red>You don't have privileges to see the admin page.</font>";  
 exit;   
}
$operation = htmlentities($_GET['op']);
$id = htmlentities($_GET['id']);
$files_array = $_SESSION['files_array'];
$filename = $files_array[$id];

if($operation==1){

  //get the directory of the webpage
   $pos = strrpos($filename,'\\')+1;
   $dir = substr($filename,0,$pos);
   
  //open temporary file
   $tmp = tempnam($dir,"_t");
   $tmp1 = $tmp;
   $tempfname = substr_replace($tmp,".htm",strrpos($tmp,'.')); 
   rename($tmp1,$tempfname);
   $temp_file = fopen($tempfname,"w");
   

  //write the htmlcode for editor into it
   $part1 = "<html>
<head>
	<title>Editor</title>
	<script type=\"text/javascript\" src=\"http://localhost/wwwroot/cmsadmin/ckeditor/ckeditor.js\"></script>
</head>
<body>
	<form method=\"post\" action=\"http://localhost/wwwroot/cmsadmin/process.php?op=2&id=0\">
		<p>
			<br />
			<textarea name=\"editor\">" ;
			
	$part3 = "</textarea>
			<script type=\"text/javascript\">
				CKEDITOR.replace( 'editor',
					{
						fullPage : true
					});
			</script>
		</p>
		<p>
			<input type=\"submit\" value=\"Save\" name=\"save\" />
            <input type=\"submit\" value=\"Discard\" name=\"disc\"/>
		</p>
	</form>
</body>
</html>";

 $part2 = file_get_contents($filename);
 $write_text = $part1.$part2.$part3;
  
 //write it into temporary file and close, save the filename
 fwrite($temp_file,$write_text);  
 fclose($temp_file);
 $_SESSION['tempfname'] = $tempfname;
 $_SESSION['temphandle'] = $temp_file;
 $_SESSION['filename'] = $filename;
 
 //redirect to the file
 $DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
 $url = str_replace($DOC_ROOT,"http://localhost",str_replace("\\","/",$tempfname));
 header("Location:".$url);
 
 exit;

}
//coming back to script from temporary file
else if($operation==2){
if(isset($_POST['save'])){
 
 if ( get_magic_quotes_gpc() )
		$postedValue = htmlspecialchars( stripslashes( $_POST['editor'] ) ) ;
 else
		$postedValue = htmlspecialchars( $_POST['editor'] ) ;
 //overwrite existing file 
 file_put_contents($_SESSION['filename'],$postedValue);
 
 //delete the temp file
 unlink($_SESSION['tempfname']);
 $_SESSION['status']= "The file was updated succesfully.";
 }
 
 else if(isset($_POST['disc'])){
 
 //if discard then delete the temporary file
 unlink($_SESSION['tempfname']);
 $_SESSION['status']= "The file was not updated.";
 }
 
 //free the session variables
 unset($_SESSION['tempfname']);
 unset($_SESSION['temphandle']);
 unset($_SESSION['filename']);
 header("Location:adminindex.php");
 exit;
}
else if($operation==0){

   if(unlink($filename)){
       $_SESSION['status']= "The file was deleted succesfully." ;
    }
   else
   {      
       $_SESSION['status']= "The file could not be deleted."  ;
    }

header("Location:adminindex.php");
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title>Areva CMS Admin Index</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
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
			  <li><a href="" class="active">Home</a></li>
			  <li><a href="">Create Page</a></li>
			   <li><a href="">Upload File</a></li>
			  <li><a href="#">Settings</a></li>
              <li><a href="#">Log Out</a></li>
			</ul>
		</div><!-- end .nav -->
	 
	</div><!-- end #header -->
	
	<div id="content" class="fixed">
	  <div id="maincontent">
	<!-- ************** V MAIN CONTENT HERE  V ********************************************************************************** -->  
	
		<h3>Opened File <?php echo $tempfname;?></h3>
		<p><textarea name="editor"></textarea></p>
        <script type="text/javascript">
				CKEDITOR.replace( 'editor',
					{
						fullPage : true
					});
			</script>
		
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