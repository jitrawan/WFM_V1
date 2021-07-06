<?PHP
error_reporting(E_ALL);
session_start();
//set_include_path(get_include_path() . PATH_SEPARATOR . 'class/');
include "include/config.php";
include "include/function.php";
include 'class/PHPExcel/IOFactory.php';
$br_no=$_GET['br_no'];
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
	$row_err = "";
	$err_add = "";
	$add_err = "";
	$row = 0;
	foreach($sheetData as $rec){
		if($rec[0] != "Material No. #" and $rec[1] != "Pro-Order No. #"){
            $row ++;
			$mat = "$rec[0]";
			$prd_order = "$rec[1]";
			if(strlen($mat) != 8 or strlen($prd_order) != 8){
				$row_err .= "แถวที่ : ".$row." Material No : ".$mat." Pro-Order No : ".$prd_order."<br>";
				$err = "<div class='alert alert-danger'><b>ผิดพลาด! ข้อมูล Material No หรือ ข้อมูล Pro-Order No ไม่ถูกต้องกรุณาตรวจสอบใหม่อีกครั้งครับ</b><br>$row_err</div>";
			}else{
				$chk_dtl = select("tb_borrow_dtl","where br_no='$br_no' and mat_no='$mat' and prd_order='$prd_order'"); // ตรวจสอบรายละเอียดกรณีซ้ำกันให้ตัดออก
				$chk_status =select("tb_documents","where prd_order='$prd_order'");
				if($chk_dtl['br_no'] == "" and $chk_status['doc_status'] == "" and $chk_status['prd_order'] != ""){
					$qr = insert("br_no,mat_no,prd_order","'$br_no','$mat','$prd_order'","tb_borrow_dtl");
				}else{
					$err_add .= "ข้อมูลรายการที่ : ".$row." Material No : ".$mat." Po No : ".$prd_order." ได้ถูกหน่วยงานอื่นยืมแล้ว หรือ ไม่พบข้อมูลในรายการเอกสาร หรือไม่มีเอกสารนี้อยู่<br>";
					$add_err = "<div class='alert alert-warning'>$err_add</div>";
				}
			}
		}
	}

	if(!empty($err) or !empty($add_err)){
		echo $err;
		echo $add_err;
	}
	}
	$borrow=select("tb_borrow","where br_no='$br_no'");
	$sql=selects("tb_borrow_dtl","where br_no='$br_no' order by mat_no asc");
?>
	<legend>รายการเอกสารที่ขอยืม</legend>
		<div class='well'>
		<table width='100%' cellpadding='3' cellspacing='3' class='table table-striped table-bordered table-hover'>
		<tr class="alert alert-success">
		<th align='left'><input type='checkbox' id='chk_all'></th>
		<th align='left'>ลำดับที่</th>
		<th align='left'>Material No. #</th>
		<th align='left'>Pro-Order No. #</th>
		<th align='left'>Short Text</th>
		<th align='left'>สถานะเอกสาร</th>
		<th align='left'>จัดการ</th>
		</tr>
	<?PHP
		$i=1;
		foreach($sql as $v){
		$chk_doc=select("tb_documents","where prd_order='$v[prd_order]'");
		if($chk_doc['doc_status'] == ""){
			$status = "<font color='green'>มีเอกสาร</font>";
		}else{
			$status = "<font color='red'>เอกสารถูกยืมแล้ว</font>";
		}
	?>
		<tr>
		<td><input type='checkbox' name='chk[]' value='<?=$v['br_dtlid'];?>' class='checkboxes'></td>
		<td><?=$i++;?></td>
		<td><?=$v['mat_no'];?></td>
		<td><?=$v['prd_order'];?></td>
		<td><?=$chk_doc['short_text'];?></td>
		<td><?=$status;?></td>
		<td>
		<?PHP 
		if($borrow['br_status'] != 'N' and $borrow['br_status'] != 'Y'){
		?>
		<a href='javascript:void(0);' id='del' value='<?=$v['br_dtlid'];?>'><i class='icon-trash'></i> ลบ</a>
		<?PHP 
			}
		?>
		</td>
		</tr>
	<?PHP
		}
	?>
</table>
</div>

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
<div <?php if($borrow['br_status'] == "N" or $borrow['br_status'] == "Y"){echo "style='display:none;'";}?>>
<legend>อัพโหลดรายการเอกสาร</legend>
<div class="well" align="center">
<form name="upload" id="upload" method="post" action="<?=$editFormAction;?>" enctype="multipart/form-data">
<input type="file" name="fileField" id="fileField">
<br><br>
<input type="submit" name="btn_upload" id="btn_upload" value="อัพโหลดไฟล์" class="btn btn-primary">
<input type="hidden" name="MM_insert" value="upload" />
</form>
</div>
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

	$("#chk_all").click(function () {
        if($("#chk_all").is(':checked')) {
            $(".checkboxes").not("[disabled]").prop("checked", true);
        }else {
            $(".checkboxes").prop("checked", false);
        }
    });

	$('a[id=del]').live('click',function(){
		var br_dtlid = new Array();
		var dtlid = $(this).attr('value');
		$("input[name='chk[]']:checked").each(function(){br_dtlid.push($(this).val());}).get().join(",");
		if(br_dtlid != ''){
				if(confirm('คุณต้องการ ลบรายการ ที่เลือกใช่หรือไม่ ?')==true){
					$.post('action.php?op=del_br_dtlid',{'br_dtlid':br_dtlid},function(data){
						$("#res").html(data);
					});
					}else{
						return false;
					}	
		}else{
			if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')==true){
				$.post('action.php?op=del_dtlid',{'dtlid':dtlid},function(data){
					$("#res").html(data);
				});
				}else{
					return false;
				}	
		}
	});

});
</script>
</body>
</html>