<div id="res"></div>
<div class="well">
<form name="frmAdd" id="frmAdd" method="post" enctype="multipart/form-data" >
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5" class="table table-bordered">
  <tr>
    <th align="right" class="ui-widget-content">สถานะเว็บไซต์ :</th>
    <td class="ui-widget-content"><input type="radio" name="sett_status" id="radio" value="on" <? if($sett['sett_status']=='on'){echo "checked";}?>/>
      Online : ออนไลน์เว็บไซต์ 
      <input type="radio" name="sett_status" id="radio2" value="off" <? if($sett['sett_status']=='off'){echo "checked";}?>/> Offline : ระงับเว็บไซต์ชั่วคราว</td>
  </tr>
  <tr>
    <th align="right" class="ui-widget-content">ระบบ QR Code :</th>
    <td class="ui-widget-content">
    <input type="radio" name="sett_qr" id="radio" value="on" <? if($sett['sett_qr']=='on'){echo "checked";}?>/>
      Open : เปิดการใช้งาน 
      <input type="radio" name="sett_qr" id="radio" value="off" <? if($sett['sett_qr']=='off'){echo "checked";}?>/> Close : ปิดการใช้งาน
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center"><input name="save" type="button" class="btn btn-info" id="save" value="บันทึก" />
      &nbsp; <input name="cancel" type="button" class="btn" id="cancel" value="ยกเลิก" /></td>
  </tr>
</table>
<input name="h_comp_id" type="hidden" id="h_comp_id" value="" />
</form>
</div>
<script type="text/javascript">
$(function(){
	$("#save").click(function(){
		$.post('action.php?op=save_setting',$("#frmAdd").serialize(),function(data){
			$("#res").html(data);	
		});	
	});	
});
</script>