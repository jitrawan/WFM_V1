<?PHP
$max_no = auto_inc("tb_borrow");
$br_no="WFO-".str_pad($max_no,6,'0',STR_PAD_LEFT);
?>
<div id="resp"></div>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">ทำรายการยืมเอกสาร</a></li>
    <li><a href="#tabs-2">ทำรายการคืนเอกสาร</a></li>
  </ul>
  <div id="tabs-1">
  <form name="frm_add" id="frm_add" method="post">
  <input type="hidden" name="br_no" id="br_no" value="<?=$br_no;?>"/>
  <div class="ui-toolbar">
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
    <tr>
      <th width="12%" align="right" valign="middle">รหัสพนักงาน : </th>
      <td width="20%" valign="middle"><input name="emp_id" type="text" class="wt" id="emp_id" maxlength="4" placeholder="ค้นหา หรือ ระบุรหัสพนักงาน"/></td>
      <th width="10%" align="right" valign="middle">ชื่อ - นามสกุล : </th>
      <td width="20%" valign="middle"><input type="text" name="emp_name" id="emp_name" class="wt" placeholder="ชื่อ - นามสกุล"/></td>
      <th width="10%" align="right" valign="middle">แผนก / หน่วยงาน : </th>
      <td width="20%" valign="middle"><input type="text" name="dept_id" id="dept_id" class="wt" placeholder="แผนก / หน่วยงาน"/></td>
    </tr>
    <tr>
      <th width="15%" align="right" valign="middle">ชื่อแผนก / ชื่อหน่วยงาน : </th>
      <td width="20%" valign="middle"><input type="text" name="dept_name" id="dept_name" class="wt" placeholder="ชื่อแผนก / ชื่อหน่วยงาน"/></td>
      <th width="10%" align="right" valign="middle">เบอร์โทรศัพท์ : </th>
      <td width="20%" valign="middle"><input type="text" name="emp_tel" id="emp_tel" class="wt" placeholder="เบอร์โทรศัพท์"/></td>
      <th width="10%" align="right" valign="middle">วันที่ยืม : </th>
      <td width="20%" valign="middle"><input type="text" name="br_date" id="br_date" class="wt" placeholder="วันที่ยืม"/></td>
    </tr>
    <tr>
      <th width="12%" align="right" valign="middle">เหตุผลในการยืมเอกสาร : </th>
      <td colspan="5" valign="middle"><textarea name="remark" rows="3" class="wtt" id="remark" placeholder="เหตุผลในการยืมเอกสาร"></textarea></td>
      </tr>
    <tr>
      <th align="right" valign="top">รายการเอกสาร : </th>
      <td colspan="5" valign="middle">
      <table width="60%" border="0" align="center" cellpadding="3" cellspacing="3" id="tb_add">
        <tr>
          <th width="10%" align="left">Material No. #</th>
          <th width="10%" align="left">Pro-Order No. #</th>
          <th width="5%" align="left">&nbsp;</th>
        </tr>
        <tr>
          <td width="10%" valign="middle"><input type='text' name='mat_no[]' class='wt mat_no' maxlength='8'/></td>
          <td width="10%" valign="middle"><input type='text' name='prd_order[]' class='wt po_no' maxlength='8'/></td>
          <td width="5%" valign="middle"><input type="button" name="button" id="button" value="+ เพิ่มแถว" class="add btn"/></td>
        </tr>
      </table>
      <div class="alert alert-info">
      *** หากรายการเอกสารที่ท่านต้องการยืมมีจำนวนมาก ท่านสามารถอัพโหลดเป็นเอกสาร Excel โดยจะต้องมีรูปแบบ (File Format) ตามที่เรากำหนดเท่านั้น !
      <br /><br />
      <center>(<i class="icon-file"></i><a href="include/format.xlsx">ดาวน์โหลดตัวอย่างรูปแบบไฟล์ Excel ที่นี่</a>)</center>
      </div>
      </td>
    </tr>
  </table>
</div>
<br />
  <center>
  <!-- input type="button" name="btn_upload" id="btn_upload" value="อัพโหลด Excel" class="btn btn-warning" -->
  <input id="btn_saved" name="btn_saved" type="button" value="บันทึกข้อมูล" class="btn btn-primary"/>
  <input id="btn_cancel" name="btn_cancel" type="button" value="ยกเลิก" class="btn btn-danger"/>
  </center>
  </form>
<br />
<br />
<br />
  </div>
  
  <div id="tabs-2">
  <form name="frm_return" id="frm_return" method="post">
    <div class="ui-toolbar">
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td width="50%" valign="top">
	<?PHP
	if($sett['sett_qr'] == 'on'){
	?>
    <div style="width: 350px; height: 350px;" id="qrcodebox"></div>
    <br />
    <p style="margin-left:10%;">
    <input type="button" value="เริ่ม" id="btn_start" class="btn btn-info"/> 
    <input type="button" value="หยุด" id="btn_stop" class="btn btn-danger"/>
    </p>
	<?PHP
	 }else{	
	?>
	<img src="img/documents2.png" style="margin-top:-5px;">
	<?PHP
	}	
	?>
    </td>
    <td align="left" valign="top">
	<label><b>เลขที่อ้างอิง</b></label>
    <input type="text" name="borrow_no" id="borrow_no" class="wtt" placeholder="ระบุเลขที่อ้างอิง">
    <center><input type="button" name="btn_search" id="btn_search" value="รายการเอกสาร" class="btn btn-warning"></center>
    </td>
  </tr>
</table>
<br>
<h4>ตรวจสอบรายการคืนเอกสาร</h4>
<div id="callBack" class="well"></div>
<h4>รายละเอียดการขอยืมเอกสาร</h4>
<div class="well">
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
    <tr>
      <th width="12%" align="right" valign="middle">รหัสพนักงาน : </th>
      <td width="20%" valign="middle">
      <input name="txt1" type="text" class="wt" id="txt1" maxlength="4" placeholder="ค้นหา หรือ ระบุรหัสพนักงาน"/>
      </td>
      <th width="10%" align="right" valign="middle">ชื่อ - นามสกุล : </th>
      <td width="20%" valign="middle"><input type="text" name="txt2" id="txt2" class="wt" placeholder="ชื่อ - นามสกุล"/></td>
      <th width="11%" align="right" valign="middle">แผนก / หน่วยงาน : </th>
      <td width="20%" valign="middle"><input type="text" name="txt3" id="txt3" class="wt" placeholder="แผนก / หน่วยงาน"/></td>
    </tr>
    <tr>
      <th width="12%" align="right" valign="middle">ชื่อแผนก / ชื่อหน่วยงาน : </th>
      <td width="20%" valign="middle"><input type="text" name="txt4" id="txt4" class="wt" placeholder="ชื่อแผนก / ชื่อหน่วยงาน"/></td>
      <th width="10%" align="right" valign="middle">เบอร์โทรศัพท์ : </th>
      <td width="20%" valign="middle"><input type="text" name="txt5" id="txt5" class="wt" placeholder="เบอร์โทรศัพท์"/></td>
      <th width="11%" align="right" valign="middle">วันที่ยืม : </th>
      <td width="20%" valign="middle"><input type="text" name="txt6" id="txt6" class="wt" placeholder="วันที่ยืม"/></td>
    </tr>
    <tr>
      <th width="15%" align="right" valign="middle">เหตุผลในการยืมเอกสาร : </th>
      <td colspan="5" valign="middle"><textarea name="txt7" rows="3" class="wtt" id="txt7" placeholder="เหตุผลในการยืมเอกสาร"><?=$data['remark'];?></textarea></td>
      </tr>
  </table>
</div>
<h4>ทำรายการคืนเอกสาร</h4>
<div class="well">
  <table width="95%" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <th width="15%" align="right">รหัสพนักงาน : </th>
      <td width="25%"><input name="ret_emp" type="text" class="wt" id="ret_emp" placeholder="รหัสพนักงาน" maxlength="4"/></td>
      <th width="15%" align="right">ชื่อ - นามสกุล : </th>
      <th width="25%" align="left"><input type="text" name="ret_emp_name" id="ret_emp_name" class="wt" placeholder="ชื่อ - นามสกุล"/></th>
      </tr>
    <tr>
      <th width="15%" align="right">แผนก / หน่วยงาน : </th>
      <td width="25%"><input type="text" name="ret_emp_dept" id="ret_emp_dept" class="wt" placeholder="แผนก / หน่วยงาน"/></td>
      <th width="15%" align="right">วันที่คืน : </th>
      <th width="25%" align="left"><input type="text" name="ret_date" id="ret_date" class="wt" placeholder="รุะบุวันที่คืน"/></th>
      </tr>
    <tr>
      <th width="15%" align="right">DCC/ผู้ที่ได้รับหมอบหมาย : </th>
      <td width="25%"><input name="ret_assign" type="text" id="ret_assign" class="span1" value="<?=($data['ret_assign'] != '' ? $data['ret_assign'] : '')?>" maxlength="4" <?=setDisabledInput(3,$_SESSION['g_id']);?>/>
      <input type="text" id="ret_assign_txt" style="width:72%;" <?=setDisabledInput(3,$_SESSION['g_id']);?>/></td>
      <th width="15%" align="right">รับคืนวันที่ : </th>
      <th width="25%" align="left"><input type="text" name="ret_realdate" id="ret_realdate" class="wt" placeholder="รุะบุวันที่รับคืน"/></th>
      </tr>
  </table>
</div>
</div>
<center>
<input id="btn_return" name="btn_return" type="button" value="บันทึกข้อมูล" class="btn btn-primary"/>
<input id="btn_cancel" name="btn_cancel" type="button" value="ยกเลิก" class="btn btn-danger"/>
</center>
</form>
</div>
</div>

<script type="text/javascript">
$(function(){
	$("#callBack").html("<center><font color='red'>ยังไม่มีรายการ</font></center>");
	$("#tabs").tabs();
    $('.mat_no,.po_no').live('keyup',function () {     
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
	$("#br_date,#ret_date,#ret_realdate").datepicker({
		changeMonth: true, 
		changeYear: true,
		dateFormat: 'dd-mm-yy', 
		dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
		dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
		monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
		firstDay: 1,
	});

	$("#btn_saved").click(function(){
		$('#frm_add input:text, input:password, textarea, select').each(function(index, obj){
         if($(obj).val().length === 0) {
            $(obj).css({'background-color':'#FFC0C0','border':'1px solid #7F0000'});  
         }else{
            $(obj).css({'background-color':'#FFFFFF'});
         }
         });
		 
		 if($("input[class='wt'],input[class='wtt']").val().length == 0){
			return false;
		}else{
		$.post('action.php?op=add_borrow',$("#frm_add").serialize(),function(data){
			$("#resp").html(data);
		});	
		}
	});

	$('.del').live('click',function(){
		$(this).parent().parent().remove();
	});
	
	$('.add').live('click',function(){
		$(this).val('- ลบแถว');
		$(this).attr('class','del btn');
		var appendTxt = "<tr><td width='10%' valign='middle'><input type='text' name='mat_no[]' class='wt mat_no' maxlength='8'/></td><td width='10%' valign='middle'><input type='text' name='prd_order[]' class='wt po_no' maxlength='8'/></td><td valign='middle'><input type='button' name='button' id='button' value='+ เพิ่มแถว' class='add btn'/></td></tr>";
		$("#tb_add").append(appendTxt);			
	});
	
	$("#dept_id,#repatdept_name").autocomplete("action.php?op=find_dept", {
		matchContains: true,
		selectFirst: false
	});
	
	$("#emp_id,#ret_emp,#ret_assign").autocomplete("action.php?op=find_emp_id", {
		matchContains: true,
		selectFirst: false
	});
	
	$("#emp_id").blur(function(){
		var user_id = $(this).val();
		$.post('action.php?op=get_empname',{'user_id':user_id},function(res){
			var data = res.split("@");
			$("#emp_name").val(data[0]+' '+data[1]);
			$("#dept_id").val(data[2]);
			$("#dept_name").val(data[3]);
			$("#emp_tel").val(data[4]);
		});	
	});
	
	$("#ret_emp").blur(function(){
		var user_id = $(this).val();
		$.post('action.php?op=get_empname',{'user_id':user_id},function(res){
			var data = res.split("@");
			$("#ret_emp_name").val(data[0]+' '+data[1]);
			$("#ret_emp_dept").val(data[3]);
		});	
	});
	
	var user_id2 = $("#ret_assign").val();
	$.post('action.php?op=get_empname2',{'user_id':user_id2},function(res){
		var data = res.split("@");
		$("#ret_assign_txt").val(data[0]+' '+data[1]);
	});	
	
	$("#ret_assign").blur(function(){
		var user_id = $(this).val();
		$.post('action.php?op=get_empname2',{'user_id':user_id},function(res){
			var data = res.split("@");
			$("#ret_assign_txt").val(data[0]+' '+data[1]);
		});	
	});
	
	$('#frm_add input:text, input:password, textarea, select').live('blur',function(){
          var check = $(this).val();
          if(check == ''){
                $(this).css({'background-color':'#FFC0C0','border':'1px solid #7F0000'});
          }else{
                $(this).css({'background-color':'#FFFFFF','border':'1px solid #007F00'});  
          }
    });
	
	$("#btn_upload").click(function(){
		var br_no = $("#br_no").val();
		$.fancybox({
			'width'				: '80%',
			'height'			: '100%',
			'autoScale'			: true,
			'transitionIn'		: 'fadein',
			'transitionOut'	: 'fadeout',
			'type'				: 'iframe',
			'href'				: 'upload_excel.php?br_no='+br_no
		});	
	});

	$('#qrcodebox').WebcamQRCode({
			delay : 5000,
			messageNoFlash : "ตรวจสอบไม่พบ Flash Player Plungin บนคอมพิวเตอร์เครื่องนี้ กรุณาติดต่อห้องคอมฯ",
			webcamStopContent : "หยุดการอ่าน QR Code",
			onQRCodeDecode: function(data){
				$('#borrow_no').val(data);
				var borrow_no = $('#borrow_no').val();
				if(br_no != ""){
					$.post('action.php?op=search_borrow',{'br_no':borrow_no},function(data){
						$("#callBack").html(data);
					});				
				}
			}
		});
		
		$('#btn_start').click(function(){
			$('#qrcodebox').WebcamQRCode().start();
		});
		
		$('#btn_stop').click(function(){
			$('#qrcodebox').WebcamQRCode().stop();
		});
		
		$("#btn_search").live('click',function(){
			var borrow_no = $('#borrow_no').val();
				if(borrow_no != ""){
					$.post('action.php?op=search_borrow',{'br_no':borrow_no},function(data){
						$("#callBack").html(data);
					});				
				}	
		});

		$("#chk_all").live('click',function () {
        if($("#chk_all").is(':checked')) {
            $(".checkboxes").not("[disabled]").prop("checked", true);
        }else {
            $(".checkboxes").prop("checked", false);
        }
    });
	
	$("#btn_return").click(function(){
		$('#frm_return input:text, input:password, textarea, select').each(function(index, obj){
         if($(obj).val().length === 0) {
            $(obj).css({'background-color':'#FFC0C0','border':'1px solid #7F0000'});  
         }else{
            $(obj).css({'background-color':'#FFFFFF'});
         }
         });
		 
		 if($("#borrow_no").val().length == 0 || $("#ret_emp").val().length == 0){
			return false;
		}else{
		$.post('action.php?op=return_borrow',$("#frm_return").serialize(),function(data){
			$("#resp").html(data);
		});	
		}
	});
            
});
</script>