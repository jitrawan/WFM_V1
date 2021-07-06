<?PHP
error_reporting(E_ALL);
set_time_limit(0);
include "include/config.php";
include "include/function.php";
include "class/phpqrcode/qrlib.php";  

$docs = selects("tb_documents","where 1=1");
$count=0;
foreach($docs as $d){
$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'docs'.DIRECTORY_SEPARATOR;
$PNG_WEB_DIR = 'docs/';
$filename = "";
$errorCorrectionLevel = 'L';
$matrixPointSize = 4;
$filename = $PNG_TEMP_DIR.$d['prd_order'].'.png';
QRcode::png($d['prd_order'],$filename, $errorCorrectionLevel, $matrixPointSize, 2);
$count += 1;
}
echo "ตรวจสอบและสร้าง QR Code เอกสารทั้งหมด จำนวน : ".$count." ฉบับ";
?>