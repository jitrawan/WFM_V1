<?PHP
session_start();
include "include/config.php";
include "include/function.php";
$status = select("tb_setting","where sett_id=1");
if($status['sett_status'] == 'off'){
echo "<center><img src='img/Page_01.png'><br><h3>ขออภัยปิดปรับปรุงระบบ ชั่วคราว<br>หากมีข้อสงสัยกรุณาติดต่อฝ่ายโรงงาน</h3></center>";
}else{
?>
<!doctype html>
<html>
<head>
	<title><?=$title;?></title>
	<meta charset="utf-8">
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="author" content="Manussawin Sankam">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link href="css/ytLoad.jquery.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/jquery.transit.js"></script>
	<script type="text/javascript" src="js/ytLoad.jquery.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span4"></div>
			<div class="span4 ">
				<div class="container-fluid m-login-container">
					<div class="page-header">
					<h2><center><img src="img/ico/Above-The-Fold-40.png"></center></h2>
					<div class="loading"></div>
					<div id="res"></div>
					</div>
					<form method="post" name="flogin" id="flogin">
						<div class="control-group">
						<label class="control-label"><b><i class="icon-user"></i> Username</b></label>
						<div class="controls">
						<input name="user_id" type="text" class="span12" id="user_id" size="20" maxlength="20" placeholder="ชื่อผู้ใช้งาน" autocomplete="off"/>
						</div>
					</div>
                    <div class="control-group">
						<label class="control-label"><b><i class="icon-lock"></i> Password</b></label>
						<div class="controls">
						<input name="password" type="password" class="span12" id="password" size="20" maxlength="20" placeholder="รหัสผ่าน" autocomplete="off"/>
						</div>
					</div>
					<input name="SLogin" type="submit" class="btn btn-primary pull-right" id="SLogin" value="ลงชื่อเข้าสู่ระบบ" />
                    <label><input type="checkbox" name="remember" value="on"> อยู่ในสถานะลงชื่อเข้าใช้</label>
					</form>
				</div>			
			</div>
		</div>
	</div>
	<div class="foot">
	Working Formula Online V.1.0 Powered By [ Gu Emboy ]<br>
    ระบบนี้จะแสดงผลได้ดีที่สุดบน <a href='http://windows.microsoft.com/th-TH/internet-explorer/downloads/ie'><img src='img/icon_ie.png'> Internet Explorer 10</a> , <a href='https://www.google.com/chrome/index.html?hl=th'><img src='img/chrome-icon.png'> Google Chrome</a> หรือ <a href='http://www.mozilla.org/th/firefox/new/'><img src='img/Icon-Browser-Firefox.png'> Mozilla Firefox.</a>
    ความละเอียดหน้าจอ 1280 x 720 Pixel ขึ้นไป
	</div>
	<script type="text/javascript">
	$(function(){
		$.ytLoad();
		$('#flogin').validate({
            errorElement: 'label', // default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                user_id: {
                    required: true
                },
                password: {
                    required: false
                },
                remember: {
                    required: false
                }
            },

				messages: {
                user_id: {
                    required: "กรุณาป้อน Username ด้วยครับ."
                },
                password: {
                   required: "กรุณาป้อน Password ด้วยครับ."
                }
            },

			highlight: function(element) {
				$(element).closest('.control-group').addClass('error');
			},

			success: function(element) {
				 element.closest('.control-group').removeClass('error');
                 element.remove();
		    },
			
           submitHandler: function (form) {
			$(".loading").html("<br><center><img src='img/blue_ani_bar.gif' style='width:100%;'></center>");
			$.post("action.php?op=signin",$("#flogin").serialize(),function(data){
				$("#res").html(data);
				$(".loading").html('');
			});
           }
        });
        
    $('#flogin input:text, input:password, textarea, select').blur(function(){
          var check = $(this).val();
          if(check == ''){
                $(this).css({'background-color':'#FFC0C0'});
          }else{
                $(this).css({'background-color':'#FFFFFF'});  
          }
       });

    $("#SLogin").live('click',function(){
        $('#flogin input:text, input:password, textarea, select').each(function(index, obj){
         if($(obj).val().length === 0) {
            $(obj).css({'background-color':'#FFC0C0'});  
         }else{
            $(obj).css({'background-color':'#FFFFFF'});
         }
         });
     });
	 //$('.foot').css('position', $(document).height() > $(window).height() ? "inherit" : "fixed");
	});
	</script>
</body>
</html>
<?PHP
}		
?>