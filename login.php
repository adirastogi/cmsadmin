<?php  
session_start();

?>  
<html>  
<title>Administrator Login</title>  
<body>  
<form name="login" method="post" action="verify.php">  
<table width="290" border="0" align="center" cellpadding="4" cellspacing="1">  
   <tr>
     <td colspan="2"><div align="center"><img src="resources/logo-td-in_home.png" alt="logo" width="180" height="100" /></div>   
     </td>  
   </tr>
   <tr>   
     <td colspan="2"><div align="center"><b>Please log in</b></div>   
     </td>  
   </tr>  
   <tr>   
     <td width="99" bgcolor="#CCCCCC"> <div align="right">login</div></td>  
     <td width="181" bgcolor="#CCCCCC"> <div align="left">   
         <input name="username" type="text" id="username">  
       </div></td>  
   </tr>  
   <tr>   
     <td bgcolor="#CCCCCC"> <div align="right">password</div></td>  
     <td bgcolor="#CCCCCC"> <div align="left">   
         <input name="password" type="password" id="password">  
       </div></td>  
   </tr>  
   <tr>   
     <td colspan="2"><div align="center">   
         <input type="submit" name="Submit" value="Submit">  
         &nbsp;   
         <input name="reset" type="reset" id="reset" value="Reset">  
       </div></td>  
   </tr>  
 
 <tr>  
 <td colspan=2 align=center>  
<?php echo $_SESSION["error"]; ?> 
 </td>  
 </tr>  
 </table>  
</form>  
</body>  
</html>