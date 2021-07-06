<?PHP
$data=select("tb_borrow","where br_no='$_GET[br_no]'");
$button = ($data['br_status'] == "N" || $data['br_status'] == "Y" ? "disabled" : "");
?>
<div id="resp"></div>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">ยืมเอกสาร</a></li>
    <li><a href="#tabs-2">คืนเอกสาร</a></li>
  </ul>
  <div id="tabs-1">
  <form name="frm_add" id="frm_add" method="post">
  <input type="hidden" name="br_no" id="br_no" value="<?=$data['br_no'];?>"/>
  <div class="ui-toolbar">
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
    <tr>
      <th width="12%" align="right" valign="middle">รหัสพนักงาน : </th>
      <td width="20%" valign="middle">
      <input name="emp_id" type="text" class="wt" id="emp_id" maxlength="4" placeholder="ค้นหา หรือ ระบุรหัสพนักงาน" value="<?=$data['emp_id'];?>"/>
      </td>
      <th width="10%" align="right" valign="middle">ชื่อ - นามสกุล : </th>
      <td width="20%" valign="middle"><input type="text" name="emp_name" id="emp_name" class="wt" placeholder="ชื่อ - นามสกุล"/></td>
      <th width="10%" align="right" valign="middle">แผนก / หน่วยงาน : </th>
      <td width="20%" valign="middle"><input type="text" name="dept_id" id="dept_id" class="wt" placeholder="แผนก / หน่วยงาน"/></td>
    </tr>
    <tr>
      <th width="15%" align="right" valign="middle">ชื่อแผนก / ชื่อหน่วยงาน : </th>
      <td width="20%" valign="middle"><input type="text" name="dept_name" id="dept_name" class="wt" placeholder="ชื่อแผนก / ชื่อหน่วยงาน"/></td>
      <th width="10%" align="right" valign="middle">เบอร์โทรศัพท์ : </th>
      <td width="20%" valign="middle"><input type="text" name="emp_tel" id="emp_tel" class="wt" placeholder="เบอร์โทรศัพท์" value="<?=$data['emp_tel'];?>"/></td>
      <th width="10%" align="right" valign="middle">วันที่ยืม : </th>
      <td width="20%" valign="middle"><input type="text" name="br_date" id="br_date" class="wt" placeholder="วันที่ยืม" value="<?=($data['br_date'] != '0000-00-00' ? DThai($data['br_date']) : '');?>"/></td>
    </tr>
    <tr>
      <th width="12%" align="right" valign="middle">เหตุผลในการยืมเอกสาร : </th>
      <td colspan="5" valign="middle"><textarea name="remark" rows="3" class="wtt" id="remark" placeholder="เหตุผลในการยืมเอกสาร"><?=$data['remark'];?></textarea></td>
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
  
  <div class="ui-toolbar">
  <table width="100%" border="0" cellpadding="2" cellspacing="1">
    <tr>
      <th width="18%" align="right">ผู้รับผิดชอบ : </th>
      <td width="15%">
      <input type="text" name="emp_resp" id="emp_resp" class="span1" 
	  <?=setDisabledInput(2,$_SESSION['g_id']);?> value="<?=($data['emp_resp']);?>"/>
      <input type="text" class="span2" id="emp_resp_txt" <?=setDisabledInput(2,$_SESSION['g_id']);?>/>
      </td>
      <th width="18%" align="right">วันที่ : </th>
      <td width="15%"><input type="text" name="resp_date" id="resp_date" class="wt" value="<?=($data['resp_date'] != '0000-00-00' ? DThai($data['resp_date']) : '');?>" <?=setDisabledInput(2,$_SESSION['g_id']);?>/></td>
      </tr>
    <tr>
      <th align="right">&nbsp;</th>
      <td>( ระดับแผนกขึ้นไป )</td>
      <th align="right">ความเห็น : </th>
      <td>
      <input type="radio" name="resp_assign" id="resp_assign" value="Y" <?=setDisabledInput(2,$_SESSION['g_id']);?> <?=($data['resp_assign'] == 'Y' ? 'checked' : '');?>/> อนุมัติ 
      <input type="radio" name="resp_assign" id="resp_assign" value="N" <?=setDisabledInput(2,$_SESSION['g_id']);?> <?=($data['resp_assign'] == 'N' ? 'checked' : '');?>/> ไม่อนุมัติ
      </td>
    </tr>
  </table>
</div>

  <div class="ui-toolbar">
  <table width="100%" border="0" cellpadding="2" cellspacing="1">
    <tr>
      <th width="18%" align="right">กำหนดคืนเอกสาร วันที่ : </th>
      <td width="15%">
      <input type="text" name="br_return" id="br_return" class="wt" value="<?=($data['br_return'] != '0000-00-00'  ? DThai($data['br_return']) : "")?>" placeholder='กำหนดคืนเอกสาร' <?=setDisabledInput(3,$_SESSION['g_id']);?>/>										
      </td>
      <th width="18%" align="right">DCC/ผู้ที่ได้รับหมอบหมาย : </th>
      <td width="15%">
      <input type="text" name="br_approve" id="br_approve" class="span1" value="<?=($data['br_approve'] != '' ? $data['br_approve'] : '')?>" <?=setDisabledInput(3,$_SESSION['g_id']);?>/>
      <input type="text" id="br_approve_txt" class="span2" <?=setDisabledInput(3,$_SESSION['g_id']);?>/>
      </td>
      </tr>
  </table>
</div>
<br />
  <center>
  <?PHP
  if($_SESSION['g_id'] == 3 and $data['emp_resp'] != "" and $data['br_status'] != "Y"){
  ?>
  <input type="button" name="btn_approve" id="btn_approve" value="อนุมัติ" class="btn btn-success" src="<?=$data['br_no'];?>"/>
  <input type="button" name="btn_unapprove" id="btn_unapprove" value="ไม่อนุมัติ" class="btn btn-inverse" src="<?=$data['br_no'];?>"/>
  <?PHP
  }
  ?>
  <input type="button" name="btn_upload" id="btn_upload" value="รายการเอกสาร" class="btn btn-warning"/>
  <input id="btn_saved" name="btn_saved" type="button" value="บันทึกข้อมูล" class="btn btn-primary" <?=$button;?>/>
  <input id="btn_cancel" name="btn_cancel" type="button" value="ลบข้อมูล" class="btn btn-danger" <?=$button;?>/>
  </center>
  <br />
  </form>
  </div>
  
  <div id="tabs-2">
  <div class="ui-toolbar">
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <th width="17%" align="right" valign="middle">ผู้ส่งคืน : </th>
      <td width="15%" valign="middle"><input type="text" name="usr_repat" id="usr_repat" class="span2"/></td>
      <th width="15%" align="right" valign="middle">หน่วยงาน : </th>
      <td width="15%" valign="middle"><input type="text" name="repatdept_name" id="repatdept_name" class="span2"/></td>
      <th width="15%" align="right" valign="middle">วันที่คืน : </th>
      <td width="15%" valign="middle"><input type="text" name="repat_date" id="repat_date" class="span2"/></td>
    </tr>
  </table>
</div>
</div>
</div>

<div id='showRemark' class='modal hide fade in'>
	<div class='modal-header'>
		<button type='button' class='close' data-dismiss='modal'>×</button>
		<h3 style='color:#A00; font-size:15px;'><i class="icon-file"></i> ระบุเหตุผลในการไม่อนุมัติ รายการยืมเอกสารเลขที่ [ <?=$data['br_no'];?> ]</h3>
	</div>
	<div class='modal-body'>
    <textarea class="wt" name="txtRemark" id="txtRemark" placeholder="ระบุเหตุผลในการไม่อนุมัติรายการยืมเอกสาร" rows="5"></textarea>
    <center>
    <input type="button" name="btnEject" id="btnEject" value="บันทึก" class="btn btn-info"/>&nbsp;&nbsp;<input type="button" name="btnClose" id="btnClose" value="ยกเลิก" class="btn btn-danger"/></center>
	<input type='hidden' name='hd_id' id='hd_id'>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#tabs").tabs();
    $('.mat_no,.po_no').live('keyup',function () {     
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
	$("#br_date,#br_return,#resp_date").datepicker({
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
		$.post('action.php?op=edit_borrow',$("#frm_add").serialize(),function(data){
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
	
	$("#dept_id").autocomplete("action.php?op=find_dept", {
		matchContains: true,
		selectFirst: false
	});
	
	$("#emp_id,#emp_resp,#br_approve").autocomplete("action.php?op=find_emp_id", {
		matchContains: true,
		selectFirst: false
	});

	var user_id = $("#emp_id").val();
		$.post('action.php?op=get_empname',{'user_id':user_id},function(res){
			var data = res.split("@");
			$("#emp_name").val(data[0]+' '+data[1]);
			$("#dept_id").val(data[2]);
			$("#dept_name").val(data[3]);
		});	

	var user_id2 = $("#emp_resp").val();
		$.post('action.php?op=get_empname2',{'user_id':user_id2},function(res){
			var data = res.split("@");
			$("#emp_resp_txt").val(data[0]+' '+data[1]);
		});	

	var user_id3 = $("#br_approve").val();
		$.post('action.php?op=get_empname3',{'user_id':user_id3},function(res){
			var data = res.split("@");
			$("#br_approve_txt").val(data[0]+' '+data[1]);
		});	
	
	$("#emp_id").blur(function(){
		var user_id = $(this).val();
		$.post('action.php?op=get_empname',{'user_id':user_id},function(res){
			var data = res.split("@");
			$("#emp_name").val(data[0]+' '+data[1]);
			$("#dept_id").val(data[2]);
			$("#dept_name").val(data[3]);
		});	
	});

	$("#emp_resp").blur(function(){
		var user_id = $(this).val();
		$.post('action.php?op=get_empname2',{'user_id':user_id},function(res){
			var data = res.split("@");
			$("#emp_resp_txt").val(data[0]+' '+data[1]);
		});	
	});

	$("#br_approve").blur(function(){
		var user_id = $(this).val();
		$.post('action.php?op=get_empname3',{'user_id':user_id},function(res){
			var data = res.split("@");
			$("#br_approve_txt").val(data[0]+' '+data[1]);
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
			'width'				: '90%',
			'height'			: '100%',
			'autoScale'			: true,
			'transitionIn'		: 'fadein',
			'transitionOut'	: 'fadeout',
			'type'				: 'iframe',
			'href'				: 'upload_excel.php?br_no='+br_no
		});	
	});

	$("#btn_cancel").live('click',function(){
	if(confirm('คุณต้องการ ลบรายการยืมเอกสารนี้ใช่หรือไม่ ?')==true){
		var br_no = $("#br_no").val();
		$.post('action.php?op=del_borrow',{'br_no':br_no},function(data){
			$("#resp").html(data);
		});
		}else{
			return false;
		}	
	});

	$("#btn_unapprove").live('click',function(){
		var data = $(this).attr('src');
		if(confirm('ยืนยัน ไม่อนุมัติ รายการยืมเอกสารเลขที่ [ '+data+' ]')==true){
        	$('#showRemark').modal();
        }else{
            return false;
        }
	});

	$("#btnEject").live('click',function(){
		var br_no = $("#br_no").val();
		var txtRemark = $("#txtRemark").val();
		if($("#txtRemark").val().length === 0){
			$("#txtRemark").css({'background-color' : '#FFC0C0'});
			return false;
		}else{
			$.post('action.php?op=un_approve',{'br_no':br_no,'txtRemark':txtRemark},function(data){
			   $("#resp").html(data);
			});
		}
	});

	$("#btnClose").live('click',function(){
		$('#showRemark').modal('hide');
	});

	$("#btn_approve").live('click',function(){
		var br_no = $(this).attr('src');
		var br_return = $("#br_return").val();
		var br_approve = $("#br_approve").val();
		if($("#br_return").val().length === 0){
			$("#br_return").css({'background-color':'#FFC0C0','border':'1px solid #7F0000'});
			return false;
		}else{
		if(confirm('ยืนยัน อนุมัติ รายการยืมเอกสารเลขที่ [ '+br_no+' ]')==true){
		$.post('action.php?op=approve',{'br_no':br_no,'br_return':br_return,'br_approve':br_approve},function(data){
			$("#resp").html(data);
		});
		}else{
			return false;
		}
		}
	});
            
});
</script>