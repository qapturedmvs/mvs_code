<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['mvs_site_name'] = '';
$config['mvs_cache_expire'] = 0;
$config['mvs_img_path'] = '';
$config['mvs_img_l_size'] = '';
$config['mvs_img_d_size'] = '';

//Global cache settings
$config['cache_sets'] = array('adapter' => 'file', 'backup' => 'memcached');

// Time Formats
$config['mvs_db_time'] = 'Y-m-d H:i:s';
$config['mvs_user_time'] = 'Y-m-d H:i:s';