<?php

	function getItemFromObj($objs, $val, $key1, $key2){
		$item = NULL;
		foreach($objs as $obj) {
			if ($obj->{$key1} == $val){
				$item = $obj->{$key2};
				break;
			}
		}
		return $item;
	}