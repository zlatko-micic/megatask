<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model','',TRUE);
	}
	
	function index() {
		//page details
		$data['page_details']['id'] = 2;
		
		if ($this->session->userdata('logged_in')) {
			//already logged in
			redirect('home', 'refresh');
		}
		else {
			//not logged in
                    
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
			
			if ($this->form_validation->run() == FALSE) {
				//Field validation failed. User redirected to login page
				
				//
				$data['post_string'] = array(
					's_username' => $this->input->post('username')
				 );
				$this->template->load('template', 'login_view', $data);
				
			
			}
			else {
				//login sucess. Go to home page
				redirect('home', 'refresh');
			}
		}
	}
        
	function check_database($password) {
		//Field validation succeeded. Validate against database
		$username = $this->input->post('username');
	
		//query the database
		
		$password = hash("sha256", $password);
		$result = $this->user_model->login($username, $password);
	
		if($result) {
			$sess_array = array();
			foreach($result as $row) {
				$sess_array = array(
					'user_id' => $row->id,
					'name' => $row->name,
					'surname' => $row->surname
					);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}

}