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
	
	function movies_where($vars, $allFilters){
		
		$where = '';

		foreach($vars as $key => $val){
			 if(isset($allFilters['like'][$key])){
					$where_or = '';
					$sep = ($where == '') ? '' : ' AND ';
					$sSep = '';
		
					foreach($val as $v){
								$sSep = ($where_or == '') ? '' : ' OR ';
								$where_or .= $sSep.$allFilters['like'][$key]." LIKE '%|".$v."|%'";
					}
					
					if($where_or != ''){
						 $where .= $sep.'('.$where_or.')';
					}
						 
			 }else if(isset($allFilters['equal'][$key])){
					$where_or = '';
					$sep = ($where == '') ? '' : ' AND ';
					$sSep = '';
					
					foreach($val as $v){
						$sSep = ($where_or == '') ? '' : ' OR ';
						$where_or .= $sSep.$allFilters['equal'][$key].' = '.$v;
					}
					
					if($where_or != ''){
						 $where .= $sep.'('.$where_or.')';
					}
		
			 }else if(isset($allFilters['between'][$key])){
					$sep = ($where == '') ? '' : ' AND ';
					$where .= $sep.'('.$allFilters['between'][$key].' BETWEEN '.$val[0].' AND '.$val[1].')';
			 }
			 
		}
		
		return $where;
		
	}
	
	function array_is_numeric($e){
		if(is_numeric($e))
			return $e;
		else
			return false;
	}
	
	function qs_filter($qs, $defs){
		$vars = array();

		foreach($qs as $key => $val){
			$val = explode(',', $val);
			foreach($defs as $def){
				if(isset($def[$key])){
					sort($val);
					$vars[$key] = array_filter($val, "array_is_numeric");
				}
			}
		}

		ksort($vars);
		
		return $vars;
	}