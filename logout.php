<?php
session_start();
$uid = $_SESSION["id_code"];
include('include/config.php');
include('include/function.php');
update("user_name","status=0,time=null,day=null,sid=null","where user_id = '$uid'");
setcookie("username_log",$username,time()-3600*24*356);
session_destroy();	
echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
echo ("<meta Http-equiv='refresh' Content='0; Url=./'>");
exit();
?> 
