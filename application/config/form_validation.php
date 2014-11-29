<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
	'form_error_prefix' => '<div class="alert alert-danger" role="alert">',
	'form_error_suffix' => '</div>',
	'adm_login' => array(
		'email' => array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|xss_clean'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required'
		)
	),
	'adm_user' => array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Name',
			'rules' => 'trim|required|xss_clean'
		), 
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email|callback__unique_email|xss_clean'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|matches[password_confirm]'
		),
		'password_confirm' => array(
			'field' => 'password_confirm', 
			'label' => 'Confirm password', 
			'rules' => 'trim|matches[password]'
		)
	),
	'adm_settings_general' => array(
		'mvs_site_name' => array(
			'field' => 'mvs_site_name',
			'label' => 'Site Name',
			'rules' => 'trim|required'
		),
		'mvs_cache_expire' => array(
			'field' => 'mvs_cache_expire',
			'label' => 'Cache Expire',
			'rules' => 'trim|required|numeric'
		),
		'mvs_img_path' => array(
			'field' => 'mvs_img_path',
			'label' => 'Image Path',
			'rules' => 'trim|required'
		),
		'mvs_img_l_size' => array(
			'field' => 'mvs_img_l_size',
			'label' => 'List Image Sizes',
			'rules' => 'trim|required'
		),
		'mvs_img_d_size' => array(
			'field' => 'mvs_img_d_size',
			'label' => 'Detail Image Sizes',
			'rules' => 'trim|required'
		)
	)
);
/*
$config['form_error_prefix'] = '<span class="help-inline error">';
$config['form_error_suffix'] = '</span>';
*/