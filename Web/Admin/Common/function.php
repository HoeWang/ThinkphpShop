<?php

function abc($kid) {
	$info2 = [];$change = [];
	// 移除数组中重复的值
    $info = array_unique($kid);
    foreach ($info as $key => $val) {
        $info2[$val] = array_keys($kid, $val, false);
        
    }
    foreach ($info2 as $k => $v) {
        $change[$k] = join(',', $v);
    }
    return $change;
}