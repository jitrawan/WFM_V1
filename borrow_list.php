<?PHP
$FormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
$FormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if(isset($_POST['MM_find']) and $_POST['MM_find'] == 'frmFind'){
$cond = "";
$selby = $_POST['sel_by'];  
$selby_status = $_POST['selby_status'];
$selby_return = $_POST['selby_return'];  
if($selby != "" and $selby == "br_no"){
    $cond .= " and br.br_no = '$_POST[sel_des]'";
}
if($selby != "" and $selby == "dept_id"){
     $cond .= " and br.dept_id = '$_POST[sel_des]'";
}
if($selby != "" and $selby == "br_date"){
     $cond .= " and br.br_date = '$_POST[sel_des]'";
}
if($selby_return != "" and $selby_return == 'NO'){
    $cond .= " and br.ret_status = ''";
}
if($selby_return != "" and $selby_return == 'CK'){
    $cond .= " and br.ret_status = 'CK'";
}
if($selby_return != "" and $selby_return == 'OK'){
    $cond .= " and br.ret_status = 'OK'";
}
if($selby_status != "" and $selby_status == "1"){
	$cond .= " and br.br_status = '' and br.resp_assign = ''";
}
if($selby_status != "" and $selby_status == "2"){
	$cond .= " and br.br_status = '' and br.resp_assign = 'Y'";
}
if($selby_status != "" and $selby_status == "3"){
	$cond .= " and br.br_status = 'Y'";
}
if($selby_status != "" and $selby_status == "4"){
	$cond .= " and br.br_status = 'N'";
}

if($_SESSION['g_id'] == 3){
$br_sql = "select * from tb_borrow br inner join tb_user un on br.emp_id=un.user_id inner join department dp on un.dept_id=dp.dept_id where 1=1 $cond  order by br.br_no desc";
}else{
$dept_id = substr($_SESSION["dept_id"],0,1); // ดึงข้อมูลตาม Costcenter
$br_sql = "select * from tb_borrow br inner join tb_user un on br.emp_id=un.user_id inner join department dp on un.dept_id=dp.dept_id where br.dept_id like '$dept_id%' $cond order by br.br_no desc";
}
}
$rs = @mysqli_query($connect,$br_sql);
?>
<div id="resp"></div>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1" class="active">รายการยืม / คืนเอกสาร</a></li>
    <!-- li><a href="#tabs-2">รายการคืนเอกสาร</a></li -->
  </ul>
  <div id="tabs-1">
	<div class="ui-toolbar">
	<form name="frmFind" id="frmFind" action="<?=$FormAction;?>" method="post">
	<table width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <th width="15%" align="right">สถานะการอนุมัติ : </th>
      <td width="35%">
      <select name="selby_status" class="wt" id="selby_status">
      <option value="">---- เลือก ----</option>
      <option value="1" <?=$sel = (isset($_POST['selby_status']) == '1' ? 'selected' : '');?>>รอการตรวจสอบจากแผนก</option>
      <option value="2" <?=$sel = (isset($_POST['selby_status']) == '2' ? 'selected' : '');?>>รอการตรวจสอบจาก DCC</option>
      <option value="3" <?=$sel = (isset($_POST['selby_status']) == '3' ? 'selected' : '');?>>อนุมัติ</option>
      <option value="4" <?=$sel = (isset($_POST['selby_status']) == '4' ? 'selected' : '');?>>ไม่อนุมัติ</option>
      </select>
      </td>
      <th width="15%" align="right">สถานะการคืนเอกสาร : </th>
      <td>
        <select name="selby_return" class="wt" id="selby_return">
          <option value="">---- เลือก ----</option>
          <option value="NO" <?=$sel = (isset($_POST['selby_return']) == 'NO' ? 'selected' : '');?>>ยังไม่ได้คืนเอกสาร</option>
          <option value="CK" <?=$sel = (isset($_POST['selby_return']) == 'CK' ? 'selected' : '');?>>คืนเอกสารไม่ครบ</option>
          <option value="OK" <?=$sel = (isset($_POST['selby_return']) == 'OK' ? 'selected' : '');?>>คืนเอกสารแล้ว</option>
          </select>
      </td>
      </tr>
    <tr>
      <th width="15%" align="right">ค้นจาก : </th>
      <td width="35%"><select name="sel_by" class="wt" id="sel_by">
        <option value="">---- เลือก ----</option>
        <option value="br_no" <?=$sel = (isset($_POST['sel_by']) == 'br_no' ? 'selected' : '');?>>เลขที่อ้างอิง</option>
        <option value="dept_id" <?=$sel = (isset($_POST['sel_by']) == 'dept_id' ? 'selected' : '');?>>แผนก / หน่วยงาน</option>
        <option value="br_date" <?=$sel = (isset($_POST['sel_by']) == 'br_date' ? 'selected' : '');?>>วันที่ทำการยืมเอกสาร</option>
      </select></td>
      <td colspan="2"><input type="text" name="sel_des" id="sel_des" class="wt" placeholder="ระบุรายละเอียด เพื่อค้นหากลางคำ" value=""/></td>
      </tr>
    <tr>
      <th width="15%" align="right">&nbsp;</th>
      <td colspan="3"><input type="button" class="btn btn-info span2" id="btnSearch" name="btnSearch" value="ค้นหาข้อมูล"> <input type="button" class="btn btn-danger span2" id="btnCancel" name="btnCancel" value="ยกเลิก">
      </tr>
  </table>
  <input type="hidden" name="MM_find" value="frmFind" />
  </form>
	</div>
    <div class="ui-toolbar">
	<table width="100%" class="table table-striped table-bordered table-hover" id="tb_pang">
<thead>
	<tr class='alert alert-success'>
	<th>ลำดับ</th>
	<th>เลขที่อ้างอิง</th>
	<th>ผู้ขอยืม</th>
	<th>แผนก / หน่วยงาน</th>
	<th>โทรศัพท์</th>
	<th>วันที่ยืม</th>
	<th>ผู้รับผิดชอบ (แผนก)</th>
	<th>วันที่รับทราบ</th>
	<th>ผู้อนุมัติ (DCC)</th>
	<th>กำหนดคืนเอกสาร</th>
	<th>ผู้ส่งคืน</th>
	<th>วันที่รับคืนเอกสาร</th>
	<th>รายละเอียด</th>
	<th>สถานะการอนุมัติ</th>
	<th>สถานะการคืนเอกสาร</th>
	</tr>
</thead>
<tbody>
<?PHP
	$i=1;
	$br_status = "";
	$ret_status = "";
	//foreach($br_list as $list){
	while($list = @mysqli_fetch_assoc($rs)){
	// สถานะการอนุมัติการขอยืมเอกสาร
	if($list['br_status'] == "" and $list['resp_assign'] == ""){
		$br_status = "<img src='img/icon/alarm.png'> รอการตรวจสอบจากแผนก";
	}else if($list['br_status'] == "" and $list['resp_assign'] == "Y"){
		$br_status = "<img src='img/icon/bookmark_folder.png'> รอการตรวจสอบจาก DCC";
	}else if($list['br_status'] == "N"){
		$br_status = "<font color='red' class='example' rel='popover' data-placement='left' data-title='ไม่ได้รับการอนุมัติเนื่องจาก' data-html='true' data-content='$list[br_apptxt]'><img src='img/icon/cross.png'> ไม่อนุมัติ</font>";
	}else if($list['br_status'] == "Y"){
		$br_status = "<font color='green'><img src='img/icon/accept.png'> อนุมัติ</font>";
	}
	// สถานะการคืนเอกสาร
	if($list['ret_status'] == ""){
		$ret_status = "-";
	}else if($list['ret_status'] == "OK"){
		$ret_status = "<font color='green'><img src='img/icon/accept.png'> คืนเอกสารแล้ว</font>";
	}else if($list['ret_status'] == "CK"){
		$ret_status = "<font color='#ff9900' class='example' rel='popover' data-placement='left' data-title='คืนเอกสารไม่ครบ' data-html='true' data-content='ตรวจสอบแล้วพบว่ายังคืนเอกสารไม่ครบ'><img src='img/icon/page_white_error.png'> คืนเอกสารไม่ครบ</font>";
	}
		$br_app=select("tb_user","where user_id='$list[br_approve]'");
		$br_resp=select("tb_user","where user_id='$list[emp_resp]'");
		$ret_emp=select("tb_user","where user_id='$list[ret_emp]'");
?>
	<tr id="event_br" value="<?=$list['br_no'];?>">
	<td><?=$i++;?></td>
	<td><?=$list['br_no'];?></td>
	<td><?=$list['user_id']." ".$list['firstname']." ".$list['lastname'];?></td>
	<td><?=$list['dept_id']." ".$list['dept_name'];?></td>
	<td><?=$list['emp_tel'];?></td>
	<td><?=DThai($list['br_date']);?></td>
	<td><?=($list['emp_resp'] != "" ? $br_resp['user_id']." ".$br_resp['firstname']." ".$br_resp['lastname'] : "-")?></td>
	<td><?=($list['resp_date'] != '0000-00-00'  ? DThai($list['resp_date']) : "-")?></td>
	<td><?=($list['br_approve'] != "" ? $br_app['user_id']." ".$br_app['firstname']." ".$br_app['lastname'] : "-")?></td>
	<td><?=($list['br_return'] != '0000-00-00'  ? DThai($list['br_return']) : "-")?></td>
	<td><?=($list['ret_emp'] != "" ? $ret_emp['user_id']." ".$ret_emp['firstname']." ".$ret_emp['lastname'] : "-")?></td>
	<td><?=($list['ret_date'] != '0000-00-00'  ? DThai($list['ret_date']) : "-")?></td>
	<td style="text-align:center;"><a href="javascript:void(0);" id="br_detail" value="<?=$list['br_no'];?>"><img src="img/icon/application_view_list.png" border="0"></a></td>
	<td><?=$br_status;?></td>
	<td><?=$ret_status;?></td>
	</tr>
<?PHP
	}
?>
</tbody>
</table>
	</div>
  </div>
<!-- div id="tabs-2">
<div class="ui-toolbar">
</div>
</div -->
</div>

<script type="text/javascript">
$(function(){
	
	$("#tabs").tabs();
	$(".example").popover();
	

	var oTable = $('#tb_pang').dataTable({
			"sScrollX": "100%",
			"sScrollXInner": "200%",
			"bScrollCollapse": true,
            "aLengthMenu": [
                [50,100,150,300,500,1000, -1],
                [50,100,150,300,500,1000, "ทั้งหมด"]
            ],      
            "iDisplayLength": 50,
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
				"sProcessing": "กำลังประมวลผล...",
                "sLengthMenu": "แสดง _MENU_ รายการ",
                "sZeroRecords": "<font color='red'><center>ไม่พบข้อมูลที่คุณต้องการ ค้นหา</center></font>",
                "sEmptyTable": "<font color='red'><center>ไม่มีข้อมูลในตาราง</center></font>",
                "sLoadingRecords": "กำลังโหลด ...",
                "sInfo": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                "sInfoEmpty": "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
                "sInfoFiltered": "(ค้นหา จากทั้งหมด _MAX_ รายการ)",
				"sSearch": "ค้นหา:",
                "oPaginate": {
                    "sFirst":    "หน้าแรก",
                    "sPrevious": "ก่อนหน้า",
                    "sNext":     "ถัดไป",
                    "sLast":     "หน้าสุดท้าย"
                }
            },
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
                //"aaSorting":[[0, "asc"]]
            }]
        });
		
		new FixedColumns( oTable, {
		"iLeftColumns": 0,
		//"iRightColumns": 1
 		});

		$("#br_detail").live('click',function(){
		var br_no = $(this).attr('value');
		location.href="main.php?page=borrow_detail&br_no="+br_no;
		});

		$("tr[id=event_br]").live('click',function(){
		var br_no = $(this).attr('value');	
		location.href="main.php?page=borrow_detail&br_no="+br_no;
		});

		$("#btnSearch").live('click',function(){
			console.log("onclick");
		$("#frmFind").submit();
		});
		
		$("#btnCancel").live('click',function(){
			location.reload();	
			$('#frmFind').trigger("reset");
		});
            
});
</script>