<?PHP
function drawExel($phpex,$row="",$coll="",$txt="",$fontstyle="",$color="",$bgcolor="",$mergefm="",$mergeto="",$txtcenter="",$CollWidth="",$RowHeight="",$border="",$font="",$txtsize=""){
		
		IF ($mergefm!="" && $mergeto!=""){
			$phpex->getActiveSheet()->MergeCells($mergefm.":".$mergeto);
		}
		IF ($fontstyle!="" || $fontstyle!=0){
			IF ($fontstyle==1){
				$phpex->getActiveSheet()->getStyle($row.$coll)->getFont()->setBold(true);
			}else if($fontstyle==2){
				$phpex->getActiveSheet()->getStyle($row.$coll)->getFont()->setItalic(true);
			}else if($fontstyle==3){
				$phpex->getActiveSheet()->getStyle($row.$coll)->getFont()->setBold(true);
				$phpex->getActiveSheet()->getStyle($row.$coll)->getFont()->setItalic(true);
			}
		}
		if($txt!=""){
			$phpex->getActiveSheet()->setCellValue($row.$coll,$txt);
		}
		 
		if ($txtcenter==1){
			 $phpex->getActiveSheet()->getStyle($row.$coll)->getAlignment()->applyFromArray(
					array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						'rotation'   => 0
					)
					);                                                       
		}else  if ($txtcenter==2){
			 $phpex->getActiveSheet()->getStyle($row.$coll)->getAlignment()->applyFromArray(
					array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						'rotation'   => 0
					)
					);                                                       
		}else  if ($txtcenter==3){
			 $phpex->getActiveSheet()->getStyle($row.$coll)->getAlignment()->applyFromArray(
					array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						'rotation'   => 0
					)
					);                                                       
		}
		if ($CollWidth!="" && $CollWidth > 0){
			$phpex->getActiveSheet()->getColumnDimension($row)->setWidth($CollWidth);
		}
		if ($RowHeight!="" && $RowHeight > 0){
			$phpex->getActiveSheet()->getRowDimension($coll)->setRowHeight($RowHeight);
		}
		
		if ($bgcolor!=""){
				$phpex->getActiveSheet()->getStyle($row.$coll)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$phpex->getActiveSheet()->getStyle($row.$coll)->getFill()->getStartColor()->setARGB("FF".$bgcolor);
		}
		IF ($color !=""){
			$phpex->getActiveSheet()->getStyle($row.$coll)->getFont()->getColor()->setARGB("FF".$color);
		}
		if ($border==1){
			$phpex->getActiveSheet()->getStyle($row.$coll)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
		}
		if($font!=""){
			$phpex->getActiveSheet()->getStyle($row.$coll)->getFont()->setName($font);
		   // $objPHPExcel->getActiveSheet()->getStyle('A3:P3')->getFont()->setName('Browallia New');
		}
		if($txtsize>0){
			$phpex->getActiveSheet()->getStyle($row.$coll)->getFont()->setSize($txtsize);            
		}
	}

	function merge($phpex,$mergefm="",$mergeto=""){
		IF ($mergefm!="" && $mergeto!=""){
			$phpex->getActiveSheet()->MergeCells($mergefm.":".$mergeto);
		}    
	}

	function heightcell($phpex,$coll,$size){
			if ($size>0){
				$phpex->getActiveSheet()->getRowDimension($coll)->setRowHeight($size);
			}
	}
	
	function widhtcell($phpex,$coll,$size){
			if ($size>0){
				$phpex->getActiveSheet()->getColumnDimension($coll)->setWidth($size);
			}
	}
	function setbgcell($phpex,$cell,$color){
				$phpex->getActiveSheet()->getStyle($cell)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$phpex->getActiveSheet()->getStyle($cell)->getFill()->getStartColor()->setARGB("FF".$color);    
	}
	function setborder($phpex,$cell){
		$phpex->getActiveSheet()->getStyle($cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	}
	function setallborder($phpex,$cellfrom,$cellto){
		$phpex->getActiveSheet()->getStyle($cellfrom.":".$cellto)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	}
	function setColor($phpex,$cell,$color){
			$phpex->getActiveSheet()->getStyle($cell)->getFont()->getColor()->setARGB("FF".$color);
	}
	function setwordwrap($phpex,$cell){
	   $phpex->getActiveSheet()->getStyle($cell)->getAlignment()->setWrapText(true);
	}
	function head_excel($str){
		if(strlen($str)>1){
			$c_max = substr($str,(strlen($str)-1),1);
		}
		$array_return="";
			$a = range("A","Z");
			$b = range("A",$c_max);
			for($i=0;$i<=25;$i++){    
				$array_return[] .= $a[$i];
			}
			foreach($b as $key=>$j){
				$array_return[] .=$a[0].$b[$key];
			}
			return $array_return;
	}

function CreateExcel($phpex,$setActiveSheet,$setShowGridlines,$title,$font){
	$phpex->createSheet();
	$phpex->setActiveSheetIndex($setActiveSheet);
	$phpex->getActiveSheet()->setShowGridlines($setShowGridlines);
	$phpex->getActiveSheet()->setTitle($title);
	$phpex->getActiveSheet()->getDefaultStyle()->getFont()->setName($font);
}

function getCol($num, $index=0) {
        $index = abs($index*1);
        $numeric = ($num - $index) % 26; 
        $letter = chr(65 + $numeric);
        $num2 = intval(($num -$index) / 26);
        if ($num2 > 0) {
            return getCol($num2 - 1 + $index) . $letter;
        } else {
            return $letter;
        }
    }

function countHr($begin,$end){
	$remain=intval(strtotime($end)-strtotime($begin));
	$wan=floor($remain/86400);
	$l_wan=$remain%86400;
	$hour=floor($l_wan/3600);
	$l_hour=$l_wan%3600;
	$minute=floor($l_hour/60);
	$second=$l_hour%60;
	return $hour.":".$minute;
}

function DateDiff($strDate1,$strDate2){
        return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
}

function TimeDiff($strTime1,$strTime2){
        return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
}
     
function DateTimeDiff($strDateTime1,$strDateTime2){
        return (strtotime($strDateTime2) - strtotime($strDateTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
}

function diff2time($time_a,$time_b){
    $now_time1=strtotime(date("Y-m-d ".$time_a));
    $now_time2=strtotime(date("Y-m-d ".$time_b));
    $time_diff=abs($now_time2-$now_time1);
    $time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน
    $time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน
    $time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน
    //return $time_diff_h." ชั่วโมง ".$time_diff_m." นาที ".$time_diff_s." วินาที";
    return $time_diff_h.":".$time_diff_m;
}

?>