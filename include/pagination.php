<?phpfunction paginate($reload, $page, $tpages, $adjacents) {	$prevlabel = "&lsaquo; Prev";	$nextlabel = "Next &rsaquo;";	$out = '<div class="pagin green">';
	// previous label
	if($page==1) {		$out.= "<span>$prevlabel</span>";	} else if($page==2) {		$out.= "<a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a>";	}else {		$out.= "<a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a>";
	}
		// first label	if($page>($adjacents+1)) {		$out.= "<a href='javascript:void(0);' onclick='load(1)'>1</a>";	}	// interval	if($page>($adjacents+2)) {		$out.= "...\n";	}
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;	for($i=$pmin; $i<=$pmax; $i++) {		if($i==$page) {			$out.= "<span class='current'>$i</span>";		}else if($i==1) {			$out.= "<a href='javascript:void(0);' onclick='load(1)'>$i</a>";		}else {			$out.= "<a href='javascript:void(0);' onclick='load(".$i.")'>$i</a>";		}	}
	// interval
	if($page<($tpages-$adjacents-1)) {		$out.= "...\n";	}
	// last
	if($page<($tpages-$adjacents)) {		$out.= "<a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a>";	}
	// next
	if($page<$tpages) {		$out.= "<a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a>";	}else {		$out.= "<span>$nextlabel</span>";	}
	$out.= "</div>";
	return $out;
}?>