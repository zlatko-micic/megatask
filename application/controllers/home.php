<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}

	function index() {
		if ($this->session->userdata('logged_in')) {
			//user is logged in
			
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//load project model
			$this->load->model('projects','',TRUE);

			//get all projects
			$data['my_projects'] = $this->projects->userProjects($data['session_data']['user_id']);
			
			//load template
			$this->template->load('template', 'home_view', $data);
		
		}
		else {
			//If no session, redirect to login page
			$this->template->load('template', 'login_view' );
		}
	}
	
	function logout() {
		$this->session->unset_userdata('logged_in');
		session_destroy();
		$this->template->load('template', 'login_view' );
	}



}