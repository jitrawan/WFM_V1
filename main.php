<?PHP
error_reporting(E_ALL);
session_start();
include "include/config.php";
include "include/function.php";
chk_login();
$url=$_GET['page'];
$user = select("tb_user","where user_id='$_SESSION[user_id]'");
$sett = select("tb_setting","where 1=1");
if($user['avartar'] != ""){
	$avartar = "<img src='avartar/$user[avartar]' class='profile_image'>";
}else{
	$avartar = "<img src='avartar/person.png' class='profile_image'>";
}
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
    <link rel="stylesheet" href="css/formToWizard.css" />
    <link rel="stylesheet" href="css/validationEngine.jquery.css" />
    <link rel="stylesheet" href="plugins/data-tables/DT_bootstrap.css" />
    <link href="plugins/jquery-autocomplete/jquery.autocomplete.css" rel="stylesheet"/>
    <link type="text/css" href="plugins/jquery-ui/css/custom-theme/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="plugins/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<link rel="stylesheet" href="css/A_green.css" />
	<link rel="stylesheet" href="css/pagination.css" />
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="plugins/jquery-ui/assets/js/jquery-ui-1.10.0.custom.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/jquery.transit.js"></script>
	<script type="text/javascript" src="js/ytLoad.jquery.js"></script>
    <script src="js/jquery.formToWizard.js"></script>
    <script src="js/jquery.validationEngine.js"></script>
    <script src="js/jquery.validationEngine-en.js"></script>
    <script src="js/jquery.autotab-1.1b.js"></script>
    <script type="text/javascript" src="plugins/data-tables/jquery.dataTables_NEW.js"></script>
	<script type="text/javascript" src="plugins/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="plugins/data-tables/FixedColumns.min.js"></script>
    <script src="plugins/jquery-autocomplete/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="plugins/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="plugins/js/jquery.webcamqrcode.js"></script>
	<script src="plugins/js/corgi.js" type="text/javascript"></script>
</head>
<body>
	<div class="navbar navbar-fixed-top m-header">
		<div class="navbar-inner m-inner">
			<div class="container-fluid">
				<a class="brand m-brand" href="main.php?page=home"><img src="img/avatar.png"></a>
				
	            <form class="form-search m-search span5">
					<img src="img/logo.png">
				</form>
				<div class="nav-collapse collapse">

					<div class="btn-group pull-right">
				        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			          		<i class="icon-user"></i> <?=$_SESSION["firstname"]." ".$_SESSION["lastname"];?>
			          		<span class="caret"></span>
				        </a>
				        <ul class="dropdown-menu">
							<li><center><?=$avartar;?></center></li>
							<li class="divider"></li>
			          		<li><a href="main.php?page=profile"><i class="icon-user"></i> ข้อมูลส่วนตัว</a></li>
	 		 				<li class="divider"></li>
			          		<li><a href="logout.php"><i class="icon-off"></i> ออกจากระบบ</a></li>
				        </ul>
			      	</div>
	          	</div>
			</div>
		</div>
	</div>
	<div class="m-top"></div>
	<div class="sidebar">
		<ul class="nav nav-tabs nav-stacked">
			<li class="<?=($url=="home" ? 'active' : '');?>">
				<a href="main.php?page=home">
					<div>
						<div class="ico">
							<img src="img/ico/Above-The-Fold-40.png">
						</div>
						<div class="title">
							หน้าหลัก
						</div>
					</div>

					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="<?=($url=="search" ? 'active' : '');?>">
				<a href="main.php?page=search">
					<div>
						<div class="ico">
							<img src="img/ico/Seo-Report-40.png">
						</div>
						<div class="title">
							สืบค้นเอกสาร
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="<?=($url=="borrow" ? 'active' : '');?>">
				<a href="main.php?page=borrow">
					<div>
						<div class="ico">
							<img src="img/ico/File-Sharing-40.png">
						</div>
						<div class="title">
							ยืม/คืนเอกสาร
						</div>
					</div>

					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="<?=($url=="borrow_list" || $url=="borrow_detail" ? 'active' : '');?>">
				<a href="main.php?page=borrow_list">
					<div>
						<div class="ico">
							<img src="img/ico/Directory-Submission-40.png">
						</div>
						<div class="title">
							รายการยืม/คืน
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="<?=($url=="manual" ? 'active' : '');?>">
				<a href="main.php?page=manual">
					<div>
						<div class="ico">
							<img src="img/ico/Duplicate-Content-40.png">
						</div>
						<div class="title">
							คู่มือระบบ
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="<?=($url=="contact" ? 'active' : '');?>">
				<a href="main.php?page=contact">
					<div>
						<div class="ico">
							<img src="img/ico/Technical-Support-40.png">
						</div>
						<div class="title">
							ติดต่อเรา
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="<?=($url=="user" ? 'active' : '');?>">
				<a href="main.php?page=user">
					<div>
						<div class="ico">
							<img src="img/ico/SEO-Training-40.png">
						</div>
						<div class="title">
							ผู้ใช้งาน
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="<?=($url=="documents" ? 'active' : '');?>">
				<a href="main.php?page=documents">
					<div>
						<div class="ico">
							<img src="img/ico/Long-Term-Contract-40.png">
						</div>
						<div class="title">
							เอกสาร
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="<?=($url=="report" ? 'active' : '');?>">
				<a href="main.php?page=report">
					<div>
						<div class="ico">
							<img src="img/ico/Competitor-Analysis-40.png">
						</div>
						<div class="title">
							รายงาน
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="<?=($url=="setting" ? 'active' : '');?>">
				<a href="main.php?page=setting">
					<div>
						<div class="ico">
							<img src="img/ico/Campaign-Tweaking-40.png">
						</div>
						<div class="title">
							ตั้งค่าระบบ
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="">
				<a href="logout.php">
					<div>
						<div class="ico">
							<img src="img/ico/Private-Network-40.png">
						</div>
						<div class="title">
							ออกจากระบบ
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="">
				<a href="#" id="btn-more">
					<div>
						<div class="ico">
							<img src="img/ico/Related-Content-40.png">
						</div>
						<div class="title">
							อื่นๆ
						</div>
					</div>
				</a>

			</li>
	    </ul>
	</div>
	<div class="m-sidebar-collapsed">
		<ul class="nav nav-pills">
			
		</ul>

		<div class="arrow-border">
			<div class="arrow-inner"></div>
		</div>
	</div>
	<div class="main-container">
		<div class="container-fluid">
		<div class="res">
		<legend>
        <?PHP
		switch ($_GET['page']){
		case "home":
			echo "หน้าหลัก";
		break;
		case "borrow":
			echo "ทำรายการยืม / คืนเอกสาร";
		break;
		case "borrow_list":
			echo "รายการยืม / คืนเอกสาร";
		break;
		case "borrow_detail":
			echo "รายละเอียดการยืมเอกสาร เลขที่อ้างอิง [ $_GET[br_no] ]";
		break;
		case "user":
			echo "จัดการข้อมูลผู้ใช้งาน";
		break;
		case "documents":
			echo "จัดการข้อมูลเอกสาร";
		break;
		case "profile":
			echo "ข้อมูลส่วนตัว";
		break;
		case "search":
			echo "สืบค้นเอกสาร";
		break;
		case "manual":
			echo "คู่มือการใช้งานระบบ";
		break;
		case "contact":
			echo "ติดต่อเรา (ฝ่ายโรงงาน)";
		break;
		case "report":
			echo "รายงาน";
		break;
		case "setting":
			echo "ตั้งค่าระบบ";
		break;
		default:
			echo "หน้าหลัก";
		}
		?>
        </legend>
		</div>
		<?PHP
		/*
		switch ($_GET['page']) {
		case "home":
			include("home.php");
		break;
		default:
		include "404.php";
		}
		*/
		include $_GET['page'].".php";
		?>
		</div>
	</div>
<script type="text/javascript">
$(function(){
	$.ytLoad();
});
</script>
</body>
</html>