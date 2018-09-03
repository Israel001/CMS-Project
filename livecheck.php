<?php
$q = $_REQUEST['q'];

if(strlen($q) > 0){
    $hint = "";
    for($i = 0; $i < strlen($q); $i++){
        if(strlen($q) > 11 && preg_match('/[^a-zA-Z\d]/', $q)){
			$hint = "<font color='green' size='-1'>Strength: Strong</font>";
		} elseif(strlen($q) > 5 && preg_match('/\d/', $q)){
			$hint = "<font color='orange' size='-1'>Strength: Medium</font>";
		} elseif(preg_match('/[a-zA-Z]/', $q)){
			$hint = "<font color='red' size='-1'>Strength: Weak</font>";
		}
    }
}

echo $hint == "" ? "" : $hint;
