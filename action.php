<?PHP
error_reporting(E_ALL);
session_start();
include "include/config.php";
include "include/function.php";
include "class/phpqrcode/qrlib.php";  

$op = $_GET['op'];
if($op === 'signin'){
	signIn();
}else if($op === 'add_user'){
    add_user();
}else if($op === 'edit_user'){
    edit_user();
}else if($op === 'del_user'){
    del_user();
}else if($op === 'del_user_all'){
    del_user_all();
}else if($op === 'find_dept'){
	find_dept();
}else if($op === 'add_borrow'){
	add_borrow();
}else if($op === 'find_emp_id'){
	find_emp_id();
}else if($op === 'get_empname'){
	get_empname();
}else if($op === 'get_empname2'){
	get_empname2();
}else if($op === 'get_empname3'){
	get_empname3();
}else if($op === 'edit_borrow'){
	edit_borrow();
}else if($op === 'del_borrow'){
	del_borrow();
}else if($op === 'del_br_dtlid'){
	del_br_dtlid();
}else if($op === 'del_dtlid'){
	del_dtlid();
}else if($op === 'save_profile'){
	save_profile();
}else if($op === 'un_approve'){
	un_approve();
}else if($op === 'approve'){
	approve();
}else if($op === 'search_po'){
	search_po();
}else if($op === 'search_borrow'){
	search_borrow();
}else if($op === 'save_setting'){
	save_setting();
}else if($op === 'return_borrow'){
	return_borrow();
}

function signIn(){
	global $connect;
	$username = mysqli_real_escape_string($connect,$_POST['user_id']);
	$password = mysqli_real_escape_string($connect,$_POST['password']);
	$chk = (isset($_POST['remember']) ? $_POST['remember'] : '');
	//เช็ค user และ password จาก ฟอร์ม
	if ((!empty($username)) and (!empty($password)) or $password == '') {
		$sql = sprintf("select * from tb_user where user_id='%s' and password='%s'",
		$username,
		$password);
		$query = mysqli_query($connect,$sql) or die (mysqli_error());
		$num_rows=mysqli_num_rows($query);
		$login=mysqli_fetch_assoc($query);
   if($num_rows === 0){
		echo "<br><p class='alert alert-danger'>ผิดพลาด! ไม่มี Username นี้ในระบบ หรือคุณถูกระงับการใช้งาน.</p>";
		exit();
   }else if ($num_rows != 0){
				    $uid = $username;
				    $row = select("tb_user","where user_id='$uid'");
					$_SESSION['logon'] = 1;
					$_SESSION["user_id"] = $row['user_id'];
					$_SESSION["firstname"] = $row['firstname'];
					$_SESSION["lastname"] = $row['lastname']; 
					$_SESSION["dept_id"] = $row['dept_id']; 
					$_SESSION["g_id"] = $row['g_id'];
					if($chk == 'on') { // ถ้าติ๊กถูก Login ตลอดไป ให้ทำการสร้าง cookie
						setcookie("username_log",$username,time()+3600*24*356);
					}
		echo "<br><p class='alert alert-success'>กำลังเข้าสู่ระบบ กรุณารอสักครู่ ...</p>";
		echo "<script>
							$(function(){
								setTimeout(function() {
									window.location.href='main.php?page=home';
								}, 2000);
							});
				  </script>";
		exit();
	}else{
		echo "<br><p class='alert alert-danger'>ผิดพลาด! ไม่สามารถเข้าใช้งานระบบได้.</p>";
		exit();
		}
	}
 }

 function add_user(){
	 $chk = num_rows("tb_user","where user_id='$_POST[user_id]'");
	 if($chk == 0){
    $add = insert("user_id,firstname,lastname,dept_id,g_id","'$_POST[user_id]','$_POST[firstn]',
			    '$_POST[lastn]','$_POST[dept_id]','$_POST[g_id]'","tb_user");
    if($add){
    $modal=Modal("portlet-success","success","ยินดีด้วย","บันทึกข้อมูลเรียบร้อยแล้วครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-success').modal();
                        });
                        setTimeout('parent.location.reload(true);',2000);
                      </script>";
		}
	 }else{
	 $modal=Modal("portlet-error","error","แจ้งเตือน","มีข้อมูลรหัสพนักงานนี้แล้วในระบบครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-error').modal();
                        });
                        setTimeout('parent.location.reload(true);',2000);
                      </script>";
	 }
}

function edit_user(){
    $up = update("tb_user","firstname = '$_POST[firstn]',
			   lastname = '$_POST[lastn]',
			   dept_id ='$_POST[dept_id]',
			   g_id = '$_POST[g_id]'","where user_id = '$_POST[h_val_id]'");
    if($up){
            $modal=Modal("portlet-success","success","ยินดีด้วย","แก้ไขข้อมูลเรียบร้อยแล้วครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-success').modal();
                        });
                        setTimeout('parent.location.reload(true);',2000);
                      </script>";
        }
}

function del_user(){
    $del = del("tb_user","where user_id = '$_POST[user_id]'");
    if($del){
            $modal=Modal("portlet-success","success","ยินดีด้วย","ลบข้อมูลเรียบร้อยแล้วครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-success').modal();
                        });
                        setTimeout('parent.location.reload(true);',2000);
                      </script>";
        }
}

function del_user_all(){
    foreach($_POST['user_id'] as $val){
        $del = del("tb_user","where user_id='$val'");
    }
    
    if($del){
        $modal=Modal("portlet-success","success","ยินดีด้วย","ลบข้อมูลที่เลือกเรียบร้อยแล้วครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-success').modal();
                        });
                        setTimeout('parent.location.reload(true);',2000);
                      </script>";
    }
}

function find_dept(){
	$q = trim($_GET["q"]);
	if (!$q) return;
	$sql = "SELECT dept_name FROM department WHERE dept_name LIKE '%$q%'";
	$rsd = mysqli_query($sql);
	while($rs = mysqli_fetch_array($rsd)) {
		$cname = trim($rs['dept_name']);
		echo "$cname\r\n";
	}
}

function find_emp_id(){
	$q = trim($_GET["q"]);
	if (!$q) return;
	$sql = "SELECT user_id FROM tb_user WHERE user_id LIKE '%$q%'";
	$rsd = mysqli_query($sql);
	while($rs = mysqli_fetch_array($rsd)) {
		$cname = trim($rs['user_id']);
		echo "$cname\r\n";
	}
}

function add_borrow(){
	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
	$PNG_WEB_DIR = 'temp/';
	$filename = "";
	$errorCorrectionLevel = 'L';
	$matrixPointSize = 4;
	$filename = $PNG_TEMP_DIR.$_POST['br_no'].'.png';
    QRcode::png($_POST['br_no'],$filename, $errorCorrectionLevel, $matrixPointSize, 2);
	$i=0;
	$br_no = $_POST['br_no'];
	$emp_id = $_POST['emp_id'];
	$dept_id = $_POST['dept_id'];
	$emp_tel = $_POST['emp_tel'];
	$br_date = convFormatDate($_POST['br_date']);
	$remark = trim($_POST['remark']);
	foreach($_POST['mat_no'] as $val){
		$prd_order = $_POST['prd_order'][$i];
		if(!empty($val) and !empty($po_no)){
			$chk = select("tb_borrow_dtl","where br_no='$br_no' and mat_no='$val' or prd_order='$prd_order'");
			if($chk['br_no'] == ""){
				insert("br_no,mat_no,prd_order","'$br_no','$val','$prd_order'","tb_borrow_dtl");
			}
		}
		$i++;
	}
	insert("br_no,emp_id,dept_id,emp_tel,br_date,remark","'$br_no','$emp_id','$dept_id','$emp_tel','$br_date','$remark'","tb_borrow");
	$modal=Modal("portlet-success","success","ยินดีด้วย","บันทึกข้อมูลเรียบร้อยแล้วครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-success').modal();
                        });
                        setTimeout('parent.location.reload(true);',2000);
                      </script>";
}

function edit_borrow(){
	$i=0;
	$br_no = $_POST['br_no'];
	$emp_id = $_POST['emp_id'];
	$dept_id = $_POST['dept_id'];
	$emp_tel = $_POST['emp_tel'];
	$br_date = convFormatDate($_POST['br_date']);
	$remark = trim($_POST['remark']);
	$emp_resp = $_POST['emp_resp'];
	$resp_date = convFormatDate($_POST['resp_date']);
	$resp_assign = $_POST['resp_assign'];
	foreach($_POST['mat_no'] as $val){
		$prd_order = $_POST['prd_order'][$i];
		if(!empty($val) and !empty($po_no)){
		$chk = select("tb_borrow_dtl","where br_no='$br_no' and mat_no='$val' or prd_order='$prd_order'");
			if($chk['br_no'] == ""){
				insert("br_no,mat_no,prd_order","'$br_no','$val','$prd_order'","tb_borrow_dtl");
			}
		}
		$i++;
	}
		update("tb_borrow","emp_id='$emp_id',dept_id='$dept_id',emp_tel='$emp_tel',br_date='$br_date',remark='$remark',emp_resp='$emp_resp',resp_date='$resp_date',resp_assign='$resp_assign'","where br_no='$br_no'");
	$modal=Modal("portlet-success","success","ยินดีด้วย","บันทึกข้อมูลเรียบร้อยแล้วครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-success').modal();
                        });
                        setTimeout('parent.location.reload(true);',2000);
                      </script>";
}

function get_empname(){
	$user_id = $_POST['user_id'];
	$sql=select("tb_user un inner join department dm on un.dept_id	= dm.dept_id","where user_id = '$user_id'");
	echo $sql['firstname']."@".$sql['lastname']."@".$sql['dept_id']."@".$sql['dept_name']."@".$sql['u_tel'];
}

function get_empname2(){
	$user_id = $_POST['user_id'];
	$sql=select("tb_user un inner join department dm on un.dept_id	= dm.dept_id","where user_id = '$user_id'");
	echo $sql['firstname']."@".$sql['lastname'];
}

function get_empname3(){
	$user_id = $_POST['user_id'];
	$sql=select("tb_user un inner join department dm on un.dept_id	= dm.dept_id","where user_id = '$user_id'");
	echo $sql['firstname']."@".$sql['lastname'];
}

function del_borrow(){
	$br_no = $_POST['br_no'];
	$chk = selects("tb_borrow_dtl","where br_no='$br_no'");
	foreach($chk as $d){
		update("tb_documents","doc_status=''","where prd_order='$d[prd_order]'");
	}
	del("tb_borrow_dtl","where br_no='$br_no'");
	del("tb_borrow","where br_no='$br_no'");
	$modal=Modal("portlet-success","success","ยินดีด้วย","ลบข้อมูลเรียบร้อยแล้วครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-success').modal();
                        });
                       setTimeout(function() {
							window.location.href='main.php?page=borrow_list';
						}, 2000);
                      </script>";
}

function del_br_dtlid(){
foreach($_POST['br_dtlid'] as $v){
	$chk = select("tb_borrow_dtl","where br_dtlid='$v'");
	update("tb_documents","doc_status=''","where prd_order='$chk[prd_order]'");
	del("tb_borrow_dtl","where br_dtlid='$v'");
}
$modal=Modal("portlet-success","success","ยินดีด้วย","ลบข้อมูลที่เลือกเรียบร้อยแล้วครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-success').modal();
                        });
                        setTimeout('location.reload();',2000);
                      </script>";
}

function del_dtlid(){
	$chk = select("tb_borrow_dtl","where br_dtlid='$_POST[dtlid]'");
	update("tb_documents","doc_status=''","where prd_order='$chk[prd_order]'");
	del("tb_borrow_dtl","where br_dtlid='$_POST[dtlid]'");
	$modal=Modal("portlet-success","success","ยินดีด้วย","ลบข้อมูลที่เลือกเรียบร้อยแล้วครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-success').modal();
                        });
                        setTimeout('location.reload();',2000);
                      </script>";
}

function save_profile(){
	$user_id=$_SESSION['user_id'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$dept_id = $_POST['dept_id'];
	$u_email = $_POST['u_email'];
	$u_tel = $_POST['u_tel'];
	update("tb_user","firstname='$firstname',lastname='$lastname',dept_id='$dept_id',u_email='$u_email',u_tel='$u_tel'","where user_id='$user_id'");
	$modal=Modal("portlet-success","success","ยินดีด้วย","บันทึกข้อมูลเรียบร้อยแล้วครับ");
            echo "<script>
                        $(function(){
                        $('#portlet-success').modal();
                        });
                        setTimeout('parent.location.reload(true);',2000);
                      </script>";
}

function un_approve(){
	update("tb_borrow","br_apptxt='$_POST[txtRemark]',br_status='N'","where br_no='$_POST[br_no]'");
	$docs = selects("tb_borrow_dtl","where br_no='$_POST[br_no]'");
	foreach($docs as $d){
	update("tb_documents","doc_status=''","where prd_order='$d[prd_order]'");
	}
	$modal=Modal("portlet-success","success","ยินดีด้วย","บันทึกข้อมูลเรียบร้อยแล้วครับ");
				echo "<script>
							$(function(){
							$('#portlet-success').modal();
							});
							setTimeout('parent.location.reload(true);',1000);
						  </script>";
}

function approve(){
	$br_return=convFormatDate($_POST['br_return']);
	update("tb_borrow","br_return='$br_return',br_approve='$_POST[br_approve]',br_status='Y'","where br_no='$_POST[br_no]'");
	$docs = selects("tb_borrow_dtl","where br_no='$_POST[br_no]'");
	foreach($docs as $d){
	update("tb_documents","doc_status='A'","where prd_order='$d[prd_order]'");
	}
	$modal=Modal("portlet-success","success","ยินดีด้วย","บันทึกข้อมูลเรียบร้อยแล้วครับ");
				echo "<script>
							$(function(){
							$('#portlet-success').modal();
							});
							setTimeout('parent.location.reload(true);',2000);
						  </script>";
}

function search_po(){
	$prd_order = explode(',',$_POST['prd_order']);
	$po = "";
	$tmp = "";
	foreach($prd_order as $val){
		$po .= ($tmp != $val ? ($po != "" ? ','.$val : $val) : "");
	 }
	 echo $po;
	$sql = selects("tb_documents","where prd_order in ($po)");
	echo "<table width='100%' class='table table-striped table-bordered table-hover'><tr class='alert alert-success'><th>QR Code</th>
		<th>Document No</th>
        <th>Materail No</th>
        <th>PO No</th>
		<th>Short Text</th>
        <th>Plant</th>
        <th>Start Date</th>
        <th>Accept Date</th>
        <th>Period</th><th>Status</th></tr>";
	foreach($sql as $v){
		if($v['doc_status'] == ""){
			$status = "<font color='green'>มีเอกสาร</font>";
		}else{
			$status = "<font color='red'>เอกสารถูกยืมแล้ว</font>";
		}
	echo "<tr style='cursor:pointer;'>
		<td><img src='docs/$v[prd_order].png'></td>
		<td>$v[doc_no]</td>
        <td>$v[mat_no]</td>
        <td>$v[prd_order]</td>
        <td>$v[short_text]</td>
        <td>$v[plant]</td>
        <td>$v[start_date]</td>
        <td>$v[date_accept]</td>
      	<td>$v[doc_period]</td>
		<td>$status</td>
	</tr>";
	}
	echo "</table>";
}

function search_borrow(){
$br_no = $_POST['br_no'];
$br = select("tb_borrow br inner join tb_user un on br.emp_id=un.user_id inner join department dp on un.dept_id=dp.dept_id","where br.br_no = '$br_no' and br.br_status = 'Y' and (br.ret_status is null or br.ret_status = 'CK' or br.ret_status = '')");
$br_dtl = selectss("tb_borrow_dtl","where br_no = '$br[br_no]'");
echo "test".$br_dtl;
if($br_dtl = 0){
	echo "<center><font color='red'>ไม่พบรายการ เนื่องจาก มีการคืนรายการเอกสารแล้ว หรือ สถานะเอกสารยังไม่ได้ถูกยืม หรือ ยังไม่ได้รับการอนุมัติให้ยืม</font></center>";
}
$ret_data = selectss("tb_user ur inner join department dp on ur.dept_id = dp.dept_id","where ur.user_id = '$br[ret_emp]'");
$ret_assign_txt = select("tb_user ur inner join department dp on ur.dept_id = dp.dept_id","where ur.user_id = '$br[ret_assign]'");
$ret_emp_name = $ret_data['firstname']." ".$ret_data['lastname'];
$ret_assign_name = $ret_assign_txt['firstname']." ".$ret_assign_txt['lastname'];
$br_date = ($br['br_date'] != '0000-00-00' ? DThai($br['br_date']) : '');
$ret_date = ($br['ret_date'] != '0000-00-00' ? DThai($br['ret_date']) : '');
$ret_realdate = ($br['ret_realdate'] != '0000-00-00' ? DThai($br['ret_realdate']) : '');
if(empty($br['br_no'])){
echo "<center><font color='red'>ไม่พบรายการ เนื่องจาก มีการคืนรายการเอกสารแล้ว หรือ สถานะเอกสารยังไม่ได้ถูกยืม หรือ ยังไม่ได้รับการอนุมัติให้ยืม</font></center>";
}else{
echo "<table width='100%' cellpadding='3' cellspacing='3' class='table table-striped table-bordered table-hover'>
		<tr class='alert alert-success'>
		<th align='left'><input type='checkbox' id='chk_all'></th>
		<th align='left'>ลำดับที่</th>
		<th align='left'>Material No. #</th>
		<th align='left'>Pro-Order No. #</th>
		<th align='left'>Short Text</th>
		<th align='left'>สถานะเอกสาร</th>
		</tr>";
$i=1;
$status = "";
foreach($br_dtl as $v){
	$chk_doc=select("tb_documents","where prd_order='$v[prd_order]'");
	if($v['ret_status'] == "OK"){
	$status = "<font color=green>รับคืนแล้ว</font>";
	}else{
	$status = "<font color=red>ยังไม่ได้รับคืน</font>";
	}
	echo "<tr>
		<td><input type='checkbox' name='chk[]' value='$v[br_dtlid]' class='checkboxes'></td>
		<td>$i</td>
		<td>$v[mat_no]</td>
		<td>$v[prd_order]</td>
		<td>$chk_doc[short_text]</td>
		<td>$status</td></tr>";
		$i++;
}
echo "</table>";
}
echo "<script>
$(function(){
$('#txt1').val('$br[user_id]');
$('#txt2').val('$br[firstname]'+' '+'$br[lastname]');
$('#txt3').val('$br[dept_id]');
$('#txt4').val('$br[dept_name]');
$('#txt5').val('$br[emp_tel]');
$('#txt6').val('$br_date');
$('#txt7').val('$br[remark]');
$('#ret_emp').val('$ret_data[user_id]');
$('#ret_emp_name').val('$ret_emp_name');
$('#ret_emp_dept').val('$ret_data[dept_name]');
$('#ret_date').val('$ret_date');
$('#ret_assign').val('$ret_assign_txt[user_id]');
$('#ret_assign_txt').val('$ret_assign_name');
$('#ret_realdate').val('$ret_realdate');
});
</script>";
}

function save_setting(){
	update("tb_setting","sett_status='$_POST[sett_status]',sett_qr='$_POST[sett_qr]'","where sett_id = 1");
	$modal=Modal("portlet-success","success","ยินดีด้วย","บันทึกข้อมูลเรียบร้อยแล้วครับ");
				echo "<script>
							$(function(){
							$('#portlet-success').modal();
							});
							setTimeout('parent.location.reload(true);',1000);
						  </script>";
}

function return_borrow(){
	$ret_date = convFormatDate($_POST['ret_date']);
	$ret_realdate = convFormatDate($_POST['ret_realdate']);
	foreach($_POST['chk'] as $d){
	$prd_no = select("tb_borrow_dtl","where br_dtlid = '$d'");
	update("tb_documents","doc_status=''","where prd_order='$prd_no[prd_order]'");
	update("tb_borrow_dtl","ret_status='OK'","where br_dtlid = '$d'");
	}

	$docs = selects("tb_borrow_dtl","where br_no='$_POST[borrow_no]'");
	$chk_doc = "";
	foreach($docs as $dd){
		if($dd['ret_status'] == ''){
			$chk_doc .= "#";
		}
	}

	if($chk_doc == ''){
	update("tb_borrow","ret_emp='$_POST[ret_emp]',ret_date='$ret_date',ret_assign='$_POST[ret_assign]',ret_realdate='$ret_realdate',ret_status='OK'","where br_no='$_POST[borrow_no]'");
	}else{
	update("tb_borrow","ret_emp='$_POST[ret_emp]',ret_date='$ret_date',ret_assign='$_POST[ret_assign]',ret_realdate='$ret_realdate',ret_status='CK'","where br_no='$_POST[borrow_no]'");
	}

	$modal=Modal("portlet-success","success","ยินดีด้วย","บันทึกข้อมูลเรียบร้อยแล้วครับ");
				echo "<script>
							$(function(){
							$('#portlet-success').modal();
							});
							setTimeout('parent.location.reload(true);',2000);
						  </script>";
						  
}

?>