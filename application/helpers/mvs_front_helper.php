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
	
	function getCoverPath($slug, $size){
		
		$size = ($size == 'medium') ? '_175x240_' : '';
		
		return 'data/movies/thumbs/'.$slug.$size.'.jpg';
	
	}
	
	function movies_where($vars, $allFilters, $filterArray = FALSE){
		
		$fArr = array();
		$where = "";
		
		foreach($vars as $key => $val){
			 if(array_key_exists($key, $allFilters['like'])){
					$items = explode(',', $val);
					$where_or = "";
					$sep = ($where == '') ? "" : " AND ";
 
					foreach($items as $item){
						 if(is_numeric($item)){
								$sSep = ($where_or == '') ? "" : " OR ";
								$where_or .= $sSep.$allFilters['like'][$key]." LIKE '%|".$item."|%'";
						 }
					}
					
					if($where_or != ''){
						 $fArr[$allFilters['like'][$key]] = array();
						 $where .= $sep."(".$where_or.")";
					}
						 
			 }else if(array_key_exists($key, $allFilters['between'])){
					$items = explode(',', $val);
					$sep = ($where == '') ? "" : " AND ";
					if(is_numeric($items[0]) && is_numeric($items[1])){
						 $fArr[$allFilters['between'][$key]] = array();
						 $where .= $sep."(".$allFilters['between'][$key]." BETWEEN ".$items[0]." AND ".$items[1].")";
					}
			 }else if(array_key_exists($key, $allFilters['equal']) && is_numeric($val)){
					$sep = ($where == '') ? "" : " AND ";
					$fArr[$allFilters['equal'][$key]] = array();
					$where .= $sep."(".$allFilters['equal'][$key]." = ".$items[0].")";
			 }
			 
		}

		return (!$filterArray) ? $where : $fArr;
		
	}