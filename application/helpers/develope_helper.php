<?php
if(!function_exists('print_rr')){
	function print_rr($array){
		$count = count($array);
		if(($count) > 0) {
			foreach($array as $key=>$value){
				if(is_array($value)){
					$id = md5(rand());
					echo '[<a href="#" onclick="return expandParent(\''.$id.'\')">'.$key.'</a>]<br />';
					echo '<div id="'.$id.'" style="display:none;margin:10px;border-left:1px solid; padding-left:5px;">';
					print_rr($value, $count);
					echo '</div>';
				} else {
					echo "<b>&nbsp;&nbsp;&nbsp;&nbsp;$key</b>: ".htmlentities($value)."<br />";
				}
			}
			echo '
			<script language="Javascript">
				function expandParent(id){
					toggle="block";
					if(document.getElementById(id).style.display=="block"){
						toggle="none"
					}
					document.getElementById(id).style.display=toggle
					return false;
				};
			</script>
			';
		} else {
			echo "data kosong";
		}
	}
}

if(!function_exists('print_rrr')){
	function print_rrr($array,$unusedfield, $ahref, $title, $color){
		$CI = & get_instance();
		$count = count($array);
		echo "<table border='0' align='center' style='font-size:11px;font-family:'Arial''>";
		echo "<tr align='center' valign='top'>";
		echo "<td align='center'><b>";
		echo $title;
		echo "</b></td>";
		echo "</tr>";
		echo "</table>";
		echo "<table border='1' align='center' style='font-size:11px;font-family:'Arial''>";
		echo "<tr align='center' valign='top'>";
		if(($count) > 0) {
			foreach($array as $key => $value) {
				if(!in_array($key, $unusedfield)) {
					echo "<td width='150px'>";
						echo "<table border='0' valign='top' width='100%' style='font-size:11px;font-family:'Arial''>";
							echo "<tr bgcolor='".$color."' valign='top' align='center'>";
								echo "<td width='100%'>";
									echo "<b>".$key."</b>";
								echo "</td>";
							echo "</tr>";
							echo "<tr align='center'>";
								echo "<td width='150px'>";
									if($key != "id") {
										echo $value;
									} else {
										echo "<a href='".site_url('testing_functions/'.$ahref.'/'.$value)."'>".$value."</a>";
									}
								echo "</td>";
							echo "</tr>";
						echo "</table>";
					echo "</td>";
				}
			}
		}
		echo "</tr>";
		echo "</table>";
	}
}

if(!function_exists('in_object')) {
	function in_object($pebanding, $obj, $check_variable = "") {
		$status = 0;
		if($obj) {
			foreach($obj as $key => $val) {
				if(is_array($val)) {
					## Cek apakah yang di cari adalah variable tertentu ##
					if($check_variable != "") {
						if($pebanding == $val[$check_variable]) {
							$status = 1;
						} else {
							$status = 0;
						}

					## Cek untuk mencari keseluruhan field dalam array ##
					} else {
						if(in_array($pebanding, $val)) {
							$status = 1;
							break;
						} else {
							$status = 0;
						}
					}


				} else {
					$status = 0;
				}
			}

			if($status == 1) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
}

if(!function_exists('array_key_exists_r')) {
	function array_key_exists_r($needle, $haystack) {
		$result = array_key_exists($needle, $haystack);
		if ($result) return $result;
		foreach ($haystack as $v) {
			if (is_array($v)) {
				$result = array_key_exists_r($needle, $v);
			}
			if ($result) return $result;
		}
		return $result;
	}
}

if(!function_exists('in_array_r')) {
	function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
		return false;
	}
}


if(!function_exists('summing_array_with_same_key')) {
	function summing_array_with_same_key($array, $same_key, $sum_val){
		$resultArray = array();
		$arrayParam = array();
		$i = 0;
	
		foreach($array as $key => $value) {
			$total = 0;
			$j = 0;
			foreach($array as $key_2 => $value_2)
			{
				if($value[$same_key] == $value_2[$same_key])
				{
					$total += $value_2[$sum_val];
					$j++;
				}
			}
			if(!in_array($value[$same_key],$arrayParam))
			{
				$arrayParam[] = $value[$same_key];
	
				$resultArray[$i] = $value;
				$resultArray[$i]['total'] = $total/$j;
				$i++;
			}
		}
		return $resultArray;
	}
}
