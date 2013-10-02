<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('download');
		$this->load->model('file_model','',TRUE);
	}
	
	function index() {
		
		if ($this->session->userdata('logged_in')) {
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//check if user can see this file
			$file_result = $this->file_model->checkUserPrivilege($data['session_data']['user_id'], $this->uri->segment(2));
			if (isset($file_result[0]->server_file_name) && file_exists("media/uploads/".$file_result[0]->server_file_name)) {
				//user is allowed to see file
				$data = file_get_contents("media/uploads/".$file_result[0]->server_file_name); // Read the file's contents
				$name = $file_result[0]->original_file_name;
				

				force_download($name, $data);
				
			}
			else {
				//not allowed. redirect to home
				redirect('/', 'refresh');
			}
			
		}
		else {
			//not logged in
			redirect('login', 'refresh');
		}
	}
	
}