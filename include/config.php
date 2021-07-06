<?PHP
############ DATABASE CONNECTION #################
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "wfm";
$connect = mysqli_connect($host,$user,$pass,$dbname) or die("Error: " . mysqli_error($connect));
// $data = mysqli_query($dbname);
// $objDB = mysqli_select_db($dbname);
mysqli_query($connect,"SET NAMES UTF8");
mysqli_query($connect,"SET character_set_results=utf8");
mysqli_query($connect,"SET character_set_client=utf8");
mysqli_query($connect,"SET character_set_connection=utf8");
setlocale(LC_ALL, 'th_TH');

date_default_timezone_set('Asia/Bangkok');

############ GENERAL SETTING ######################
$title = "Working Formula Online";
$version = "?version=1";
?>