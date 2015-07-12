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
	
	function getMoviePoster($poster, $slug, $size){
		
		$path = 'images/placeHolder.jpg';
		
		if($poster == 1){
			
			switch($size){
				
				case 'medium':
					$size = '_175X240_';
					break;
				
				case 'small':
					$size = '_80X120_';
				break;
				
			}
			
			$path = 'data/movies/thumbs/'.$slug.$size.'.jpg';
			
		}
		
		return $path;
	
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
								$where_or .= $sSep.$allFilters['like'][$key][0]." LIKE '%|".$v."|%'";
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
						$where_or .= $sSep.$allFilters['equal'][$key][0].' = '.$v;
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
		
		$vars = FALSE;
		
		if($qs){
			
			$vars = array();
			
			foreach($qs as $key => $val){
				$val = explode(',', $val);
				foreach($defs as $def){
					if(isset($def[$key]))
						$vars[$key] = array_map('intval', array_filter($val, "array_is_numeric"));
				}
			}
			
			if(count($vars) == 0)
				$vars = FALSE;
			
		}
		
		return $vars;
	}
	
	// Creating cache id by query string
	function get_cache_id($vars){
		
		$id = '';
		
		if($vars){
			
			ksort($vars);
			
			foreach($vars as $key => $val){
				
				sort($val);
				$sep = ($id == '') ? '' : '_';
				$id .= $sep.$key.'-'.implode('-', $val);
				
			}
		}
		
		return $id;
		
	}
	
	// Change array key prefix
	function changePrefix($array, $prefOld, $prefNew){
		
		$prefLen = strlen($prefOld);
		$data = array();
		
		if(count($array)){
			foreach($array as $key => $val){
				if(substr($key, 0, $prefLen) === $prefOld){
					$data[str_replace($prefOld, $prefNew, $key)] = $val;
				}
			}
		}
		
		return $data;
		
	}
	
	
	function gnrtSlug($type){
		
		$len = array(5,3);

		if($type == 'user')
			$prefix = 'qu';
		else{
			$prefix = 'ql';
			$len = array(9,7);
		}
		
		$slug = $prefix.str_shuffle(strtolower(random_string('alpha', $len[0])).random_string('numeric', $len[1]));
		return $slug;
		
	}
	
	function gnrtString($alpha, $num){
		
		$str = str_shuffle(strtolower(random_string('alpha', $alpha)).random_string('numeric', $num));
		return $str;
		
	}
	
	function time_calculator($time){
		
		$postTime = strtotime($time);
    $time = time() - $postTime;
		
		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
    );

    foreach($tokens as  $unit => $text){
        
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s ago':' ago');

    }
		
	}
	
	// User Nick Check
	function slugify($text){

		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	
		// trim
		$text = trim($text, '-');
	
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	
		// lowercase
		$text = strtolower($text);
	
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
	
		if (empty($text))
		{
			return '';
		}
	
		return $text;
	}
	
	function get_user_avatar($usr_avatar){
		
		if($usr_avatar == '')
			$usr_avatar = 'images/user.jpg';
		else
			$usr_avatar = 'data/users/'.$usr_avatar.'.jpg';
			
		return $usr_avatar;
		
	}