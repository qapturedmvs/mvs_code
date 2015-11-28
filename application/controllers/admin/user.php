<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends Backend_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index ()
	{
		// Fetch all users
		$db_data = $this->user_m->get_data();
		$this->data['users'] = $db_data['data'];
		
		// Load view
		$this->data['subview'] = 'admin/user/index';
		$this->load->view('admin/_main_body_layout', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a user or set a new one
		if ($id) {
			$db_data = $this->user_m->get_data($id);
			$this->data['user'] = $db_data['data'];
			count($this->data['user']) || $this->data['errors'][] = 'User could not be found';
			
			if( count($this->data['user']) == 0 ) redirect('admin/user'); //-->user bulunamazsa hatay� �nlemek i�in redirect
		}
		else {
			$this->data['user'] = $this->user_m->get_new();
		}
		
		// Set up the form	
		$rules = $this->config->config['adm_user'];
		$id || $rules['password']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);
		
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {			
			$data = $this->user_m->array_from_post(array('name', 'email', 'password', 'note'));
			
			$psw = str_replace(array("\n", "\r"), '', $data['password']);
			if( trim( $psw ) == '' ) unset( $data['password'] );
			else $data['password'] = $this->user_m->hash($data['password']);
			
			$data = changeObjectKeys($data, 'adm_usr_');
			$this->user_m->save($data, $id);
			redirect('admin/user');
		}

		// Load the view
		$this->data['subview'] = 'admin/user/edit';
		$this->load->view('admin/_main_body_layout', $this->data);
	}

	public function delete($id)
	{
		$this->user_m->delete($id);
		redirect('admin/user');
	}

	public function login()
	{
		// Redirect a user if he's already logged in
		$dashboard = 'admin/dashboard';
		$this->user_m->loggedin() == FALSE || redirect($dashboard);
		
		// Set form
		$rules = $this->config->config['adm_login'];
		$this->form_validation->set_rules($rules);

		// Process form
		if ($this->form_validation->run() == TRUE){
			
			// We can login and redirect
			if ($this->user_m->login() == TRUE) {
				redirect($dashboard);
			}
			else {
				$this->session->set_flashdata('error', 'That email/password combination does not exist');
				redirect('admin/user/login', 'refresh');
			}
		}

		// Load view
		$this->data['subview'] = 'admin/user/login';
		$this->load->view('admin/_modal_body_layout', $this->data);
	}

	public function logout ()
	{
		$this->user_m->logout();
		redirect('admin/user/login');
	}

	public function _unique_email ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current user
		
		$id = $this->uri->segment(4);
		$filters = array(
				'where' => "adm_usr_email = '".$this->input->post('email')."' AND adm_usr_id != '".$id."'"
		);
		

		//$this->db->where('adm_usr_email', $this->input->post('email'));
		//!$id || $this->db->where('adm_usr_id !=', $id);
		$user = $this->user_m->get_data(NULL, 0, FALSE, $filters);
		if (count($user['data'])) {
			$this->form_validation->set_message('_unique_email', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}

}