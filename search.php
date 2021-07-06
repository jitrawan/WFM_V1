<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td width="350" valign="top">
	<?PHP
	if($sett['sett_qr'] == 'on'){
	?>
    <div style="width: 350px; height: 350px;" id="qrcodebox"></div>
    <br />
    <center>
    <input type="button" value="เริ่ม" id="btn_start" class="btn btn-info"/> 
    <input type="button" value="หยุด" id="btn_stop" class="btn btn-danger"/>
    </center>
	<?PHP
	 }else{	
	?>
	<img src="img/documents2.png" style="margin-top:-5px;">
	<?PHP
	}	
	?>
    </td>
    <td align="left" valign="top">
    <textarea class="wtt" id="txt_po" name="txt_po" rows="3" placeholder="ระบุเลขที่ PO ในการสืบค้น และตรวจสอบสถานะเอกสาร หากต้องการสืบค้นหลาย PO ให้คั่นด้วยเครื่องหมาย (,) ตัวอย่าง (00000001,00000002,00000003,00000004)"></textarea>
    <center><input type="button" name="btn_search" id="btn_search" value="สืบค้นเอกสาร" class="btn btn-warning"></center>
    </td>
  </tr>
</table>
<br>
<h4>รายการเอกสารที่สืบค้น</h4>
<div id="callBack" class="well"></div>
<script>
	$('document').ready(function(){
		$("#callBack").html("<center><font color='red'>ยังไม่มีรายการ</font></center>");
		$('#qrcodebox').WebcamQRCode({
			delay : 5000,
			messageNoFlash : "ตรวจสอบไม่พบ Flash Player Plungin บนคอมพิวเตอร์เครื่องนี้ กรุณาติดต่อห้องคอมฯ",
			webcamStopContent : "หยุดการอ่าน QR Code",
			onQRCodeDecode: function(data){
				$('#txt_po').append(data+',');
				var prd_order = $('#txt_po').val();
				if(prd_order != ""){
					$.post('action.php?op=search_po',{'prd_order':prd_order},function(data){
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
			var prd_order = $('#txt_po').val();
				if(prd_order != ""){
					$.post('action.php?op=search_po',{'prd_order':prd_order},function(data){
						$("#callBack").html(data);
					});				
				}	
		});
	});
</script>