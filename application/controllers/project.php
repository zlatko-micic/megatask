<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->model('projects','',TRUE);
	}
	
	function index() {
		if ($this->session->userdata('logged_in')) {
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			$this->template->load('template', 'project_view', $data);
			
		}
		else {
			//not logged in
			redirect('login', 'refresh');
		}
	}

}