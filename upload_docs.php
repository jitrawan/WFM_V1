<?PHP
error_reporting(E_ALL);
session_start();
include "include/config.php";
include "include/function.php";
include 'class/PHPExcel/IOFactory.php';
$modal=Modal("ext-error","error","ผิดพลาด","กรุณาเลือกไฟล์ที่เป็นเอกสารประเภท Excel (.xls , .xlsx) เท่านั้น!");
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "upload")) {
$inputFileName = $_FILES['fileField']['tmp_name'];
try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('เกิดข้อผิดพลาดขณะโหลดไฟล์ "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
$sheetData = $objPHPExcel->getActiveSheet()->toArray();
	$err = "";
	$row=1;
	foreach($sheetData as $rec){
		$row++;
		if($rec[0] != "doc_no" and $rec[1] != "prd_order"){
			$doc_no = trim("$rec[0]");
			$po = trim("$rec[1]");
			$date_accept = convFormatDateSAP("$rec[2]");
			$mat = trim("$rec[3]");
			$plant=trim("$rec[4]");
			$start_date = convFormatDateSAP("$rec[5]");
			$short_text = trim("$rec[6]");
			$doc_period = trim("$rec[7]");
	
			if(strlen($mat) != 8){
				$row_err .= "แถวที่ : ".$row." Material No : ".$mat." Pro-Order No : ".$po."<br>";
				$err = "<div class='alert alert-danger'><b>ผิดพลาด! ข้อมูล Material No หรือ ข้อมูล Pro-Order No ไม่ถูกต้องกรุณาตรวจสอบใหม่อีกครั้งครับ</b><br>$row_err</div>";
			}
			if(empty($err)){
				$chk = select("tb_documents","where mat_no='$mat' and prd_order='$po'");
				if($chk['mat_no'] == ""){
				$qr = insert("doc_no,prd_order,mat_no,plant,start_date,date_accept,short_text,doc_period","'$doc_no','$po','$mat','$plant','$start_date','$date_accept','$short_text','$doc_period'","tb_documents");
				}
			}
	
		}
	}

	if(!empty($err)){
		echo $err;
	}
	}
?>
<!doctype html>
<html>
<head>
	<title><?=$title;?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="author" content="Manussawin Sankam">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
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
    <script type="text/javascript" src="plugins/data-tables/FixedHeader.js"></script>
    <script src="plugins/jquery-autocomplete/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="plugins/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
</head>
<body>
<div id="res"></div>
<legend>อัพโหลดรายการเอกสาร</legend>
<div class="well">
<form name="upload" id="upload" method="post" action="<?=$editFormAction;?>" enctype="multipart/form-data">
<center>
<input type="file" name="fileField" id="fileField">
<br><br>
<input type="submit" name="btn_upload" id="btn_upload" value="อัพโหลดไฟล์" class="btn btn-primary">
</center>
<input type="hidden" name="MM_insert" value="upload" />
</form>
</div>
<script type="text/javascript">
$(function(){
	$.ytLoad();
	$('input[type="file"]').change(function () {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch(ext){
        case 'xls':
        case 'xlsx':
        return true;
        break;
        default:
            $('#ext-error').modal();
            setTimeout(function() {
            $('#ext-error').modal('hide');
            }, 3000);
            this.value = '';
			return false;
    }
	});

});
</script>
</body>
</html>