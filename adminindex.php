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
function scanDirectories($rootDir, $allowext, $allData=array()){
    $dirContent = array_diff(scandir($rootDir), array('.', '..'));
	
    foreach($dirContent as $key => $content) {
	 if($os = "Windows"){
        $path = $rootDir."\\".$content;
	}else if($os = "Linux"){
	    $path = $rootDir."/".$content;
	}
		
            if(is_file($path) && is_readable($path)) {
		        $ext = substr($content, strrpos($content, '.') + 1);	
               	if(in_array($ext,$allowext)){	   
                $allData[] = $path;
				}
            }elseif(is_dir($path) && is_readable($path) && $content!="cmsadmin") {
             //    recursive callback to open new directory
                $allData = scanDirectories($path,$allowext,$allData);
            }
        
    }
    return $allData;
}
$allowext = array("mht","htm","html");
$files_array = scanDirectories($rootDir,$allowext);
$_SESSION['files_array']=$files_array;
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
			  <li><a href="" class="active">Home</a></li>
			  <li><a href="create.php">Create Page</a></li>
			   <li><a href="upload.php">Upload File</a></li>
			  <li><a href="settings.php">Settings</a></li>
              <li><a href="logout.php">Log Out</a></li>
			</ul>
		</div><!-- end .nav -->
	 
	</div><!-- end #header -->
	
	<div id="content" class="fixed">
	  <div id="maincontent">
	<!-- ************** V MAIN CONTENT HERE  V ********************************************************************************** -->  
	
		<h3>You have the following web pages in your directory</h3>
        <h3 class="style2"><?php echo $_SESSION['status']; $_SESSION['status']="" ?></h3>
		<p>&nbsp;</p>
		 
      <table cellspacing="0">
			<tr>
				<th width="61%"><span class="style1">File Name</span></th>
			  <th width="19%"><span class="style1">Edit</span></th>
			  <th width="20%"><span class="style1">Delete</span></th>
		</tr>
  
        <?php  for($i=0; $i < count($files_array); $i++)  {
		       echo "<tr>"  ;
			   echo "<td width = \"61%\" >".$files_array[$i]."</td>";
			   echo	"<td width=\"19%\"><a href=\"process.php?op=1&id=".$i."\">Edit</a></td>";
echo "<td width=\"20%\"><a href=\"process.php?op=0&id=".$i."\" onClick=\"javascript:return confirm('Do you want to delete this file ?');\">Delete</a></td>";
			   echo "</tr>"	 ;
		}                                                     
		 ?>
         
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
	    </tr>
		</table>
		
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