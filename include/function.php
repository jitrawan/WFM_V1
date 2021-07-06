<?php
//แทรกข้อมูลลง db

function insert($field,$value,$table){
$sql = "insert into $table ($field) values ($value)";
$result= mysqli_query($connect,$sql);
return $result;
}
//ลบข้อมูล
function del($table,$condition){
$sql ="delete from $table $condition";
$result = mysqli_query($connect,$sql);
return $result;
}
//แก้ไขข้อมูล
function update($table,$command,$condition){
$sql = "UPDATE $table SET $command $condition";
$result = mysqli_query($connect,$sql);
return $result;
}
//เลือกข้อมูล
function select($table,$condition){
global $connect;
$sql = "select * from $table $condition";
$dbquery = mysqli_query($connect,$sql) or die ("Error in query: $sql " . mysqli_error($connect));
$result= mysqli_fetch_array($dbquery);
return $result;
}
//เลือกข้อมูล
function selectss($table,$condition){
	global $connect;
	$sql = "select * from $table $condition";
	$dbquery = mysqli_query($connect,$sql) or die ("Error in query: $sql " . mysqli_error($connect));
	if(mysqli_num_rows($br_dtl) < 1){
		$bquery = 0;
	}
	return $dbquery;
	}
//เลือกหลายแถว
function selects($table,$condition){
	global $connect;
	
$sql = "select * from $table $condition";
$dbquery = mysqli_query($connect,$sql) or die ("Error in query: $sql " . mysqli_error($connect));
$rows = array();
while (($result = mysqli_fetch_array($dbquery)) !== FALSE)
	$rows[] = $result;
	return $rows;
}
//สุ่มเลือกข้อมูล
function selectrand($table,$condition){
	$sql = "select * from $table $condition";
	$dbquery = mysqli_query($connect,$sql);
	$result= mysqli_fetch_array($dbquery);
	return $result;
}
# select Auto_increment last id
function auto_inc($table){
	global $connect;
	$r = mysqli_query($connect,"SHOW TABLE STATUS LIKE '$table'");
	$row = mysqli_fetch_array($r);
	$auto_increment = $row['Auto_increment'];
	mysqli_free_result($r);
	return $auto_increment;
}
#หากจะใช้ function selects ให้ใช้ foreach เอาข้อมูลออกมา
function num_rows($table,$condition){
$sql = "select * from $table $condition";
$dbquery = mysqli_query($connect,$sql);
$num_rows = mysqli_num_rows($dbquery);
return $num_rows;
}
#Close DB Connetion
function closedb() {
	global $connect;
		return mysqli_close($connect);
		return false;
}
#select sum data
function selectsum($feild,$table, $condition = ''){
    $result = mysqli_query ($connect,"SELECT sum($feild) as total_price FROM $table $condition");
    if ($result && mysqli_num_rows($result) > 0) {
      $query_data=mysqli_fetch_array($result);
      return  (float) $query_data["total_price"];
    }
    return  '';
}
#Select Max value
function selectMax($feild,$table, $condition = ''){
	$result = mysqli_query ($connect,"SELECT Max($feild) as val_max FROM $table $condition");
    if ($result && mysqli_num_rows($result) > 0) {
      $query_data=mysqli_fetch_array($result);
      return  (int) $query_data["val_max"];
    }
    return  '';
}

function thainumDigit($num){
    return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),$num);
}

function DThais($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		//$strMonth= date("n",strtotime($strDate));
		$strMonth= date("m",strtotime($strDate));
		$strDay= date("d",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		//$strMonthCut =Array('','มกราคม','กุมภาพันธุ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
		$strMonthThai=$strMonthCut[$strMonth];
		//return "$strDay $strMonthThai $strYear";
		return $strDay."/".$strMonth."/".$strYear;
	}

function DThai_long($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		//$strHour= date("H",strtotime($strDate));
		//$strMinute= date("i",strtotime($strDate));
		//$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array('','มกราคม','กุมภาพันธุ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

function FullThdate(){
	$thaiweek=array("วัน อาทิตย์","วัน จันทร์","วัน อังคาร","วัน พุธ","วัน พฤหัสบดี","วัน ศุกร์","วัน เสาร์");
	$thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","      มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	echo $thaiweek[date("w")] ," ที่",date(" j "), $thaimonth[date(" m ")-1] , " พ.ศ. ",date(" Y ")+543;
}

function avg($arr) {
	$array_size = count($arr);
	$total = 0;
	for ($i = 0; $i < $array_size; $i++) {
		$total += $arr[$i];
	}
	$average = (float)($total / $array_size);
	return $average;
}

function chk_login(){
	if($_SESSION['logon'] != 1){
		echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
		echo("<script>alert('ผิดพลาด! คุณไม่ได้รับอนุญาติให้เข้าใช้งานระบบ'); window.location='./';</script>");
		exit();
		}
}

function random_password($len){
	srand((double)microtime()*10000000);
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$ret_str = "";
	$num = strlen($chars);
	for($i = 0; $i < $len; $i++)
	{
		$ret_str.= $chars[rand()%$num];
		$ret_str.=""; 
	}
	return $ret_str; 
}

function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}

function random_user($len){
	srand((double)microtime()*10000000);
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_@|$&";
	$ret_str = "";
	$num = strlen($chars);
	for($i = 0; $i < $len; $i++)
	{
		$ret_str.= $chars[rand()%$num];
		$ret_str.=""; 
	}
	return $ret_str; 
}

function encode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return $hash;
}

function decode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}

function time_ago($date,$granularity=2) {
    $date = strtotime($date);
    $difference = time() - $date;
    $periods = array('decade' => 315360000,
        'ปี' => 31536000,
        'เดือน' => 2628000,
        'สัปดาห์' => 604800, 
        'วัน' => 86400,
        'ชั่วโมง' => 3600,
        'นาที' => 60,
        'วินาที' => 1);
    if ($difference < 5) { // less than 5 seconds ago, let's say "just now"
        $retval = "ไม่กี่วินาทีที่แล้ว";
        return $retval;
    } else {                            
        foreach ($periods as $key => $value) {
            if ($difference >= $value) {
                $time = floor($difference/$value);
                $difference %= $value;
                $retval .= ($retval ? ' ' : '').$time.' ';
                //$retval .= (($time > 1) ? $key.'s' : $key);
                $retval .= (($time > 1) ? $key : $key);
                $granularity--;
            }
            if ($granularity == '0') { break; }
        }
        return $retval.' ที่ผ่านมา'; 
        //return ' posted '.$retval.' ago';      
    }
}

function Modal($mid,$type,$title,$text){
	if($type=='error'){
		$color="color:#cc0000;font-size:16px;";
	}
	if($type=='success'){
		$color="color:#009900;font-size:16px;";
	}
	echo "<div id='$mid' class='modal hide fade in'>
	<div class='modal-header'>
		<button type='button' class='close' data-dismiss='modal'>×</button>
		<h3 style='$color'>$title</h3>
	</div>
	<div class='modal-body'>
		<p>$text</p>
	</div>
	</div>";
}

function dayColor(){
	$day=date('N');
	if($day=='1'){
		$color="#ffff00";
	}else if($day=='2'){
		$color="#ffccff";
	}else if($day=='3'){
		$color="#009900";
	}else if($day=='4'){
		$color="#ff9900";
	}else if($day=='5'){
		$color="#0066ff";
	}else if($day=='6'){
		$color="#800080";
	}else if($day=='7'){
		$color="#cc0000";
	}
	return $color;
}

function sizeFilter($bytes){
    $label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
    for( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /= 1024, $i++ );
    return( round( $bytes, 2 ) . " " . $label[$i] );
}

function guPagination($query, $per_page = 10,$page = 1, $url = '?'){  
	global $connect;
    	$query = "SELECT COUNT(*) as num FROM {$query}";
    	$row = mysqli_fetch_array(mysqli_query($connect,$query));
    	$total = $row['num'];
        $adjacents = "2"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
			//$pagination .= "<div style='margin-top:2%; width:20%;'>หน้าที่ $page จากทั้งหมด $lastpage หน้า</div>";
    		$pagination .= "<ul class='pagination pull-right'>";
                    $pagination .= "<li class='details_p'>หน้าที่ $page จากทั้งหมด $lastpage หน้า</li>";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li><a class='current'>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}subpage=$counter'>$counter</a></li>";					
    			}
    		}else if($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}subpage=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>...</li>";
    				$pagination.= "<li><a href='{$url}subpage=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}subpage=$lastpage'>$lastpage</a></li>";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='{$url}subpage=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}subpage=2'>2</a></li>";
    				$pagination.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}subpage=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>..</li>";
    				$pagination.= "<li><a href='{$url}subpage=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}subpage=$lastpage'>$lastpage</a></li>";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='{$url}subpage=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}subpage=2'>2</a></li>";
    				$pagination.= "<li class='dot'>..</li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}subpage=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}subpage=$next'>หน้าถัดไป</a></li>";
                $pagination.= "<li><a href='{$url}subpage=$lastpage'>หน้าสุดท้าย</a></li>";
    		}else{
    			$pagination.= "<li><a class='current'>หน้าถัดไป</a></li>";
                $pagination.= "<li><a class='current'>หน้าสุดท้าย</a></li>";
            }
    		$pagination.= "</ul>\n";		
    	}
    
    
        return $pagination;
    } 

	function convFormatDate($startdate){
        list($ddate, $mdate, $ydate ) = explode("-", $startdate);
        if (strlen($mdate)==1){
           $mdate = "0".$mdate;
        }
        if (strlen($ddate)==1){
            $ddate = "0".$ddate;
        }
        //$ydate = $ydate - 543;
        return $fdate = $ydate."-".$mdate."-".$ddate;
    }

	function convFormatDateSAP($startdate){
        list($ddate, $mdate, $ydate ) = explode(".", $startdate);
        if (strlen($mdate)==1){
           $mdate = "0".$mdate;
        }
        if (strlen($ddate)==1){
            $ddate = "0".$ddate;
        }
        if (strlen($ydate)==2){
            $ydate = "20".$ydate;
        }
        return $fdate = $ydate."-".$mdate."-".$ddate;
    }

	function DThai($startdate){
		list($ydate,$mdate,$ddate) = explode("-", $startdate);
        if (strlen($mdate)==1){
           $mdate = "0".$mdate;
        }
        if (strlen($ddate)==1){
            $ddate = "0".$ddate;
        }
        //$ydate = $ydate + 543;
        return $fdate = $ddate."-".$mdate."-".$ydate;
	}

	function DateTimeThai($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}

	function convDateTimeThai($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("m",strtotime($strDate));
		$strDay= date("d",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		//$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		//$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay-$strMonth-$strYear $strHour:$strMinute";
	}

function check_browser(){
$useragent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
}	elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Chrome';
}	elseif (preg_match( '|Opera ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
} 	elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Firefox';
} 	elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Safari';
}
	else {
    $browser_version = 0;
    $browser= 'other';
    }
    return $browser;
}

function setDisabledInput($level,$val){
	if($val != $level){
		return " disabled='disabled'";
	}
}

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
?>