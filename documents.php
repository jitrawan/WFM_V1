<div id="res"></div>
<div class="alert alert-error hide">
<button type="button" class="close" data-dismiss="alert">×</button>
<span>กรุณาป้อน ข้อมูลให้ครบ ด้วยครับ.</span>
</div>
<form name="frmAdd" id="frmAdd" method="post" enctype="multipart/form-data">
<table width="50%" border="0" align="center" cellpadding="3" cellspacing="3">
  <tr>
    <th align="right" valign="top">Document No : </th>
    <td><input name="doc_no" type="text" id="doc_no" size="40" autocomplete="off" class="span4" placeholder="Document No"/></td>
  </tr>
  <tr>
    <th align="right" valign="top">Materail No : </th>
    <td><input name="mat_no" type="text" class="span4" id="mat_no" placeholder="Materail No" size="40"/></td>
  </tr>
  <tr>
    <th align="right" valign="top">PO No : </th>
    <td><input name="prd_order" type="text" class="span4" id="prd_order" placeholder="PO No" size="40"/></td>
    </tr>
  <tr>
    <th align="right" valign="top">Plant : </th>
    <td>
      <select class="span5" id="plant" name="plant">
        <option value="">-- Plant --</option>
        <option value="1000">1000</option>
        <option value="2000">2000</option>
        </select>
      </td>
  </tr>
  <tr>
    <th align="right" valign="top">Start Date : </th>
    <td><input name="start_date" type="text" class="span4" id="start_date" placeholder="Start Date" size="40"/></td>
  </tr>
  <tr>
    <th align="right" valign="top">Accept Date : </th>
    <td><input name="date_accept" type="text" class="span4" id="date_accept" placeholder="Accept Date" size="40"/></td>
  </tr>
  <tr>
    <th align="right" valign="top">Short Text : </th>
    <td><input name="short_text" type="text" class="span4" id="short_text" placeholder="Short Text" size="40"/></td>
  </tr>
  <tr>
    <th align="right" valign="top">Period : </th>
    <td><input name="doc_period" type="text" class="span4" id="doc_period" placeholder="Period" size="40"/></td>
    </tr>
  <tr>
    <td colspan="2" align="center">
    <input type="button" name="save" id="save" value="บันทึก" class="btn btn-success span2">
      &nbsp; <input type="button" name="cancel" id="cancel" value="ยกเลิก" class="btn span2">
      &nbsp; <input type="button" name="btn_upload" id="btn_upload" value="อัพโหลด Excel" class="btn btn-warning span2">
      </td>
  </tr>
</table>
<input name="h_val_id" type="hidden" id="h_val_id" value="">
</form>
<br />
<table width="100%" class="table table-striped table-bordered table-hover">
<thead>
	<tr class='alert alert-success'>
		<th style="width:8px;"><!-- input type="checkbox" class="group-checkable" data-set="#tb_pang .checkboxes" -->เลือก</th>
		<th>QR Code</th>
		<th>Document No</th>
        <th>Materail No</th>
        <th>PO No</th>
        <th>Plant</th>
        <th>Start Date</th>
        <th>Accept Date</th>
        <th>Period</th>
		<th>แก้ไข</th>
		<th>ลบ</th>
	</tr>
</thead>
<tbody>
<?PHP
$page = (int) (!isset($_GET["subpage"]) ? 1 : $_GET["subpage"]);
$limit =100;
$startpoint = ($page * $limit) - $limit;
$statement = "tb_documents  where 1=1 order by doc_no asc";
$cont="SELECT * , case doc_period when '10' then '#ffd2ff' when '5' then '#ffffcc' else '#ffffff' end as row_color FROM {$statement} LIMIT {$startpoint} , {$limit}";		
$query = mysqli_query($connect,$cont);
while($data=mysqli_fetch_array($query)){
$val = $data['doc_no']."@".$data['mat_no']."@".$data['prd_order']."@".$data['plant']."@".$data['start_date']."@".$data['date_accept']."@".$data['short_text']."@".$data['doc_period'];
?>
	<tr style="cursor:pointer;" src="<?=$data['doc_id'];?>">
		<td><input type="checkbox" name="chk[]" class="checkboxes" value="<?=$data['doc_id'];?>" /></td>
		<td><img src='docs/<?=$data['prd_order'];?>.png'></td>
		<td><?=$data['doc_no'];?></td>
        <td><?=$data['mat_no'];?></td>
        <td><?=$data['prd_order'];?></td>
        <td><?=$data['plant'];?></td>
        <td><?=$data['start_date'];?></td>
        <td><?=$data['date_accept'];?></td>
      	<td style="background-color:<?=$data['row_color'];?>;"><?=$data['doc_period'];?></td>
		<td align='center'><a href="javascript:void(0)" id='edit' value="<?=$data['doc_id'];?>" name="<?=$val;?>"><i class="icon-edit"></i> แก้ไข</a></td>
		<td align='center'><a href="javascript:void(0)" id='del' value="<?=$data['doc_id'];?>"><i class="icon-trash"></i> ลบ</a></td>
	</tr>
<?PHP
}	
?>
</tbody>
</table>
<center>
<?PHP
echo guPagination($statement,$limit,$page,$url='?page=documents&');
?>
</center>
<script type="text/javascript">
$(function(){
	$("#btn_upload").click(function(){
		$.fancybox({
			'width'				: '80%',
			'height'			: '100%',
			'autoScale'			: true,
			'transitionIn'		: 'fadein',
			'transitionOut'	: 'fadeout',
			'type'				: 'iframe',
			'href'				: 'upload_docs.php'
		});		
	});
	
	$("a[id='edit']").click(function(){
				var user_id = $(this).attr('value');
				var data = $(this).attr('name').split("@");
				console.log(data);
                $("#h_val_id").val(user_id); 
                $("#doc_no").val(data[0]);
                $("#mat_no").val(data[1]);
                $("#plant").val(data[2]);
				$("#prd_order").val(data[3]);
                $("#start_date").val(data[4]);
                $("#date_accept").val(data[5]);
				$("#short_text").val(data[6]);
				$("#doc_period").val(data[7]);
	});

	$("a[id='del']").click(function(){
				var selectedItems = new Array(); //สร้าง Array เพื่อเก็บข้อมูล Checkbox
				var user_id = $(this).attr('value'); //Id ของ แถวที่ต้องการลบ
				$("input[name='chk[]']:checked").each(function() {selectedItems.push($(this).val());}).get().join(",");
				
				if(selectedItems != ''){
					if(confirm('คุณต้องการลบข้อมูลที่เลือกหรือไม่ ?')==true){
					$.post('action.php?op=del_user_all',{'user_id':selectedItems},function(data){
						$("#res").html(data);
					});
					}else{
						return false;
					}	
				}else{
				if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')==true){
				$.post('action.php?op=del_user',{'user_id':user_id},function(data){
					$("#res").html(data);
				});
				}else{
					return false;
				}	
				}
				$('#frmAdd').trigger("reset"); 
				$('#frmAdd')[0].reset(); 
	});
    
    $('#frmAdd input:text, input:password, textarea, select').blur(function(){
          var check = $(this).val();
          if(check == ''){
                $(this).css({'background-color':'#FFC0C0'});
          }else{
                $(this).css({'background-color':'#FFFFFF'});  
          }
       });

	$("#save").live('click',function(){
        $('#frmAdd input:text, input:password, textarea, select').each(function(index, obj){
         if($(obj).val().length === 0) {
            $(obj).css({'background-color':'#FFC0C0'});  
         }else{
            $(obj).css({'background-color':'#FFFFFF'});
         }
         });
         
		if($('#user_id').val().length == 0 || $('#firstn').val().length == 0 || $('#lastn').val().length == 0 || $('#dept_id').val().length == 0 || $('#level').val().length == 0){
			$('.alert-error').fadeIn(1000);
			return false;
		}else{
			$('.alert-error').fadeOut(1000);
		var chk_mt = $("#h_val_id").val();
		if(chk_mt == ''){
			$.post('action.php?op=add_user',$("#frmAdd").serialize(),function(data){
				$("#res").html(data);
			});
			$('#frmAdd').trigger("reset"); 
			$('#frmAdd')[0].reset(); 
		}else{
			var hid = $("#h_val_id").val();
			$.post('action.php?op=edit_user',$("#frmAdd").serialize(),function(data){
				$("#res").html(data);
			});
			$('#frmAdd').trigger("reset"); //แบบนี้จะเคลียร์ input hidden ด้วย
			$('#frmAdd')[0].reset(); 
		}
		}
	});

	$("#cancel").click(function(){
		parent.location.reload();
	});
	
});
</script>