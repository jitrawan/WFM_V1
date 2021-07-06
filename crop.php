<?php
function cropImage($source,$target,$thumbwidth,$thumbheight){
 $size = getImageSize($source);
    $w = $size[0];
    $h = $size[1];
 switch ($size[mime]){
  case 'image/gif':
   $o_im = imageCreateFromGIF( $source );
   break;
  case 'image/jpeg':
   $o_im = imageCreateFromJPEG( $source );
   break;
  case 'image/png':
   $o_im = imageCreateFromPNG( $source );
   break;
  default:
   $error = $size[mime].' ไม่รองรับ.';
   break;
 };
  
 if ( $error == '' ){
  $wm = $w / $thumbwidth;
  $hm = $h / $thumbheight;
  $h_height = $thumbheight / 2;
  $w_height = $thumbwidth / 2;

  $t_im = ImageCreateTrueColor( $thumbwidth , $thumbheight );

  if( $w > $h ){
   $adjusted_width = $w  / $hm;
   $half_width = $adjusted_width / 2;
   $int_width = $half_width - $w_height;
   ImageCopyResampled( $t_im , $o_im , -$int_width , 0 , 0 , 0 , $adjusted_width , $thumbheight , $w , $h );
  }
  elseif ( ( $w < $h ) || ( $w == $h ) ){
   $adjusted_height = $h / $wm;
   $half_height = $adjusted_height / 2;
   $int_height = $half_height - $h_height;
   ImageCopyResampled( $t_im , $o_im , 0 , -$int_height , 0 , 0 , $thumbwidth , $adjusted_height , $w , $h );
  }else{
   ImageCopyResampled( $t_im , $o_im , 0 , 0 , 0 , 0 , $thumbwidth , $thumbheight , $w , $h );
  };

  if ( !@ImageJPEG( $t_im , $target ) ){
   $error = "ไม่สามารถสร้างรูปได้, ตรวจสอบไดเร็คทอรี่ให้ถูกต้อง";
  };

  imageDestroy( $o_im );
  imageDestroy( $t_im );
 };

 return $error;
};

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $targ_w = $targ_h = 150;
    $jpeg_quality = 50;
  
    $src = 'demo_files/pool.jpg';
    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
  
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
    $targ_w,$targ_h,$_POST['w'],$_POST['h']);
  
    header('Content-type: image/jpeg');
    imagejpeg($dst_r,null,$jpeg_quality);
  
    exit;
}
?>