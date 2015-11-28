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
		
		$path = 'images/noPoster.jpg';
		
		if($poster == 1){
			
			$folder = 'thumbs/';
			
			switch($size){
				
				case 'medium':
					$size = '_220X326_';
					break;
				
				case 'small':
					$size = '_150X222_';
				break;
				
				case 'original':
					$size = '';
					$folder = '';
				break;
				
			}
			
			$path = 'data/movies/'.$folder.$slug.$size.'.jpg';
			
		}
		
		return $path;
	
	}
	
	function get_movie_Cover($slug, $size = NULL){
		
		$path = '/data/covers/';
			
			switch($size){
				
				case 'hd':
					$path = '/data/login-covers/';
				break;

			}
			
			return $path.$slug.'.jpg';
		
	}
	
	function getStarPhoto($photo, $slug, $size){
		
		$path = 'images/noAvatar.jpg';
		
		if($photo == 1){
			
			$folder = 'thumbs/';
			
			switch($size){
				
				case 'medium':
					$size = '_250X362_';
				break;
				
				case 'small':
					$size = '_90X123_';
				break;
				
				case 'original':
					$size = '';
					$folder = '';
				break;
				
			}
			
			$path = 'data/stars/'.$folder.$slug.$size.'.jpg';
			
		}
		
		return $path;
	
	}
	
	function movies_where($vars, $defs){
			
		$where = '';
		
		if($vars){

			foreach($vars as $key => $val){
				
				$where_or = '';
				
				if(isset($defs['like'][$key])){

					 $sep = ($where == '') ? '' : ' AND ';
		 
					foreach($val as $v){
					 
						$sSep = ($where_or == '') ? '' : ' OR ';
						$where_or .= $sSep.$defs['like'][$key][0]." LIKE '%|".$v."|%'";
								
					}
					 
					if($where_or != '')
						$where .= $sep.'('.$where_or.')';

							
				}else if(isset($defs['equal'][$key])){

					$sep = ($where == '') ? '' : ' AND ';
					
					foreach($val as $v){
						
						$sSep = ($where_or == '') ? '' : ' OR ';
						$where_or .= $sSep.$defs['equal'][$key][0].' = '.$v;
						
					}
					 
					if($where_or != '')
						$where .= $sep.'('.$where_or.')';

				}else if(isset($defs['between'][$key])){
					
					 $sep = ($where == '') ? '' : ' AND ';
					 $where .= $sep.'('.$defs['between'][$key].' BETWEEN '.$val[0].' AND '.$val[1].')';
					 
				}
				 
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
				}else{
					$data[$key] = $val;
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
			$usr_avatar = '/images/noAvatar.jpg';
		else
			$usr_avatar = '/data/users/'.$usr_avatar.'.jpg?t='.time();
			
		return $usr_avatar;
		
	}
	
	function get_user_Cover($usr_cover){
		
		if($usr_cover == '')
			$usr_cover = '/images/noCover.jpg';
		else
			$usr_cover = '/data/user-covers/'.$usr_cover.'.jpg?t='.time();
			
		return $usr_cover;
		
	}