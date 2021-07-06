<?php
session_start();
require_once('../include/config.php');
require_once('../include/function.php');

$sql="SELECT * FROM tb_user WHERE user_id='$_SESSION[user_id]' ";
$qr=mysql_query($sql);
$user=mysql_fetch_assoc($qr);

$path = "../avartar/";

$valid_formats = array("jpg", "png", "gif", "bmp","JPG");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
	{
		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];
		@unlink("../avartar/".$user['avartar']);
		if(strlen($name))
			{
				list($txt, $ext) = explode(".", $name);
				if(in_array($ext,$valid_formats))
				{
				if($size<(1024*1024))
					{
						$actual_image_name = time().substr(str_replace(" ", "_", $txt), 255).".".$ext;
						$tmp = $_FILES['photoimg']['tmp_name'];
						if(move_uploaded_file($tmp, $path.$actual_image_name)){
						$sql=mysql_query("UPDATE tb_user SET avartar='$actual_image_name' WHERE user_id='$_SESSION[user_id]'");
								if($sql){
								echo ("<meta Http-equiv='refresh' Content='1; Url=../'>");
								}
								echo "<img src='../avartar/".$actual_image_name."'  class='preview'>";
							}
						else
							echo "ผิดพลาด ไม่สามารถอัพโหลดไฟล์ภาพของท่านได้ในขณะนี้";
					}
					else
					echo "ขนาดไฟล์ภาพต้องไม่เกิน 1 MB";					
					}
					else
					echo "นามสกุลไฟล์ภาพไม่ถูกต้องหรือระบบไม่อนุญาติให้อัพโหลดไฟล์ชนิดนี้..";	
			}
			
		else
			echo "กรุณาเลือกไฟล์ภาพของท่านด้วยครับ..!";
			
		exit;
	}
?>