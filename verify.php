<?php

session_start();  

 function authAdmin($user,$passwd){
 $doc = new DOMDocument();
 $doc->load("auth.xml");
 $admins = $doc->getElementsByTagName("admin");
 foreach($admins as $admin){
	$usernames = $admin->getElementsByTagName("username");
    $username =  $usernames->item(0)->nodeValue; 	
    $passwords = $admin->getElementsByTagName("password");
    $password =  $passwords->item(0)->nodeValue;     
	
	if(($username==$user)and($password==$passwd)){
       return 1;	
    }
	
 }
    return 0;
 }
 
 $user = $_POST["username"];
 $passwd = $_POST["password"];
 
 
 
if (authAdmin($user,$passwd)){  
 $_SESSION["login"] = "true";  
 $_SESSION["error"] = "";
 header("Location:adminindex.php");  
 exit;  
} else {  
 $_SESSION["error"] = "<font color=red>Wrong username or password. Try again.</font>";  
 header("Location:login.php");  
}  
 
?>