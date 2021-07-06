<?PHP
$profile=select("tb_user u inner join department d on u.dept_id=d.dept_id","where user_id='$_SESSION[user_id]'");
?>
<div id="resp"></div>
<div class="tabbable tabbable-custom">
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab1" data-toggle="tab">ข้อมูลทั่วไป</a></li>
	<li><a href="#tab2" data-toggle="tab">ข้อมูลบัญชีผู้ใช้งาน</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane profile-classic row-fluid active" id="tab1">
		<div class="span3">
		<? if($profile['avartar'] <> ""){?><img src="avartar/<?=$profile['avartar'];?>" alt=""/><?}else{?><img src="avartar/person.png" alt="" /><?}?> <a href="javascript:void(0)" class="profile-edit" id="profile-edit">เปลี่ยนรูปภาพ</a>
		</div>
		<ul class="unstyled span8">
			<li><span>รหัสพนักงาน : </span><?=$profile['user_id'];?></li>
			<li><span>ชื่อ - นามสกุล : </span><?=$profile['firstname']." ".$profile['lastname'];?></li>
			<li><span>แผนก / หน่วยงาน : </span><?=$profile['dept_id']." ".$profile['dept_name'];?></li>
			<li><span>อีเมล์ : </span><?=$profile['u_email'];?></li>
			<li><span>โทรศัพท์ : </span><?=$profile['u_tel'];?></li>
		</ul>
	</div>
	<!--tab_1_2-->
	<div class="tab-pane row-fluid profile-account" id="tab2">
		<div class="row-fluid">
			<div class="span12">
				<div class="span3">
					<ul class="ver-inline-menu tabbable">
						<li class="active">
							<a data-toggle="tab" href="#tab_1-1">
							<i class="icon-cog"></i> 
							ข้อมูลส่วนตัว
							</a> 
							<span class="after"></span>                           			
						</li>
						<li class=""><a data-toggle="tab" href="#tab_3-3"><i class="icon-lock"></i>เปลี่ยนรหัสผ่าน</a></li>
					</ul>
				</div>
				<div class="span9">
					<div class="tab-content">
						<div id="tab_1-1" class="tab-pane active">
							<div style="height: auto;" id="accordion1-1" class="accordion collapse">
							<form action="" method="post" name="profile_info" id="profile_info">
							<label class="control-label">ชื่อ</label>
							<input type="text" name="firstname" id="firstname" class="span6" value="<?=$profile['firstname'];?>"/>
							<label class="control-label">นามสกุล</label>
							<input type="text" class="span6" value="<?=$profile['lastname'];?>" name="lastname" id="lastname"/>
							<label class="control-label">แผนก / หน่วยงาน</label>
							<input type="text" class="span6" value="<?=$profile['dept_id'];?>" name="dept_id" id="dept_id"/>
							<label class="control-label">Email</label>
							<input type="text" class="span6" value="<?=$profile['u_email'];?>" name="u_email" id="u_email"/>
							<label class="control-label">เบอร์โทรศัพท์</label>
							<input type="text" class="span6" value="<?=$profile['u_tel'];?>" name="u_tel" id="u_tel"/>
							<div class="submit-btn">
							<a href="javascript:void(0)" class="btn btn-success" id="btnSubmit_profile_info">แก้ไขข้อมูลส่วนตัว</a>
							<a href="javascript:void(0)" class="btn">ยกเลิก</a>
							</div>
							</form>
							</div>
						</div>
						<div id="tab_3-3" class="tab-pane">
							<div style="height: auto;" id="accordion3-3" class="accordion collapse">
								<form action="" method="post" name="profile_password" id="profile_password">
									<label class="control-label">รหัสผ่านปัจจุบัน</label>
									<input type="password" class="span6" name="c_password" id="c_password" placeholder='รหัสผ่านปัจจุบัน'/>
									<label class="control-label">รหัสผ่านใหม่</label>
									<input type="password" class="span6" name="n_password" id="n_password" placeholder='รหัสผ่านใหม่'/>
									<label class="control-label">ยืนยัน รหัสผ่านใหม่</label>
									<input type="password" class="span6" name="r_password" id="r_password" placeholder='ยืนยัน รหัสผ่านใหม่'/>
									<div class="submit-btn">
										<a href="javascript:void(0)" class="btn btn-success" id="btnSubmit_profile_password">เปลี่ยนรหัสผ่าน</a>
										<a href="javascript:void(0)" class="btn">ยกเลิก</a>
									</div>
								</form>
							</div>
						</div>
						
					</div>
				</div>
				<!--end span9-->                                   
			</div>
		</div>
	</div>
	<!--end tab-pane-->
</div>
</div>
<!--END TABS-->
<script type="text/javascript">
$(function(){
$("#btnSubmit_profile_info").click(function(){
	$.post('action.php?op=save_profile',$('#profile_info').serialize(),function(data){
		$("#resp").html(data);
	});
});

$("#profile-edit").click(function(){
$.fancybox({
	'width'				: '50%',
	'height'			: '100%',
	'autoScale'			: true,
	'transitionIn'		: 'fadein',
	'transitionOut'	: 'fadeout',
	'type'				: 'iframe',
	'href'				: 'ajaximage/'
});	
});

});
</script>