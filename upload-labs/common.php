<?php
function deldot($s){
	for($i = strlen($s)-1;$i>0;$i--){
		$c = substr($s,$i,1);
		if($i == strlen($s)-1 and $c != '.'){
			return $s;
		}

		if($c != '.'){
			return substr($s,0,$i+1);
		}
	}
}
?>