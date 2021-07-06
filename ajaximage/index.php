<?php
session_start();
require_once('../include/config.php');
require_once('../include/function.php');
?>
<html>
<head>
<title>Profile Images</title>
</head>
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript" >
 $(document).ready(function() { 		
	$('#photoimg').change(function(){
		 $('#path').val($(this).val());
	});

	$('#photoimg').live('change', function()			{ 
	$("#preview").html('');
	$("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
	$("#imageform").ajaxForm({
	target: '#preview'
	}).submit();

	});
}); 
</script>
<style>
.preview{
width:250px;
border:solid 2px #dedede;
padding:5px;
}
#preview{
color:#cc0000;
font-size:12px
}
.previews{
width:500px;
border:solid 1px #dedede;
padding:5px;
}
.form input[type="file"]{
  z-index: 999;
  line-height: 0;
  font-size: 50px;
  position: absolute;
  opacity: 0;
  filter: alpha(opacity = 0);-ms-filter: "alpha(opacity=0)";
  cursor: pointer;
  _cursor: hand;
  margin: 0;
  padding:0;
  left:0;
  }
 .add-photo-btn{
   position:relative;
   overflow:hidden;
   cursor:pointer;
   text-align:center;
   background-color:#006699;
   color:#fff;
   display:block;
   width:250px;
   height:30px;
   font-size:18px;
   line-height:30px;
   border-radius:20px;
   padding:5px;
   box-shadow:1px 1px 5px  #0066ff;
 }
 .add-photo-btn:hover{
	position:relative;
   overflow:hidden;
   cursor:pointer;
   text-align:center;
   background-color:#0099cc;
   color:#fff;
   display:block;
   width:250px;
   height:30px;
   font-size:18px;
   line-height:30px;
   border-radius:20px;
   padding:5px;
 }
 input[type="text"]{
   float:left;
   height:30px;
 }
</style>
<body>
<div style="width:100%;">
<center>
<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
<h4 style="background:#ffcc00; padding:5px; border:2px dotted #FFFFFF;"><li>Upload profile picture</li></h4>
<p class="form">
  <label class="add-photo-btn">คลิกเพื่ออัพโหลดไฟล์
    <span>
	   <input type="file" name="photoimg" id="photoimg" />
    </span>
  </label>
</p>
</form>
<div id='preview'>
<?php
$sql="select * from tb_user WHERE user_id='$_SESSION[user_id]'";
$query=mysql_query($sql);
$rs=mysql_fetch_array($query);
$num=mysql_num_rows($query);
if(!empty($num) AND !empty($rs['avatar'])){
	echo "<img src='../avartar/".$rs['avatar']."'class='preview'>";
}else{
	echo "<img src='../avartar/person.png' class='preview'>";
}
?>
</div>
</center>

</div>
</body>
</html>