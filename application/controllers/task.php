<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('tasks','',TRUE);
		$this->load->library('upload');
		$this->load->library('form_validation');
	}
	
	function index() {
		if ($this->session->userdata('logged_in')) {
			
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//to do - do chekings on $this->uri->segment(2)
			
			//check if user is allowed to see this task
			if ($this->tasks->checkUserPrivilege($data['session_data']['user_id'], $this->uri->segment(2))) {
				//user is allowed to see this task
				
				//validate form (write message)
				$this->form_validation->set_rules('message', "Message", 'trim|required|min_length[3]|xss_clean');
				
				if ($this->form_validation->run() == FALSE) {
					
				}
				else {
					//load user model
					$this->load->model('tasks','',TRUE);
					
					//record message
					$record_result = $this->tasks->setMessage($this->input->post('message'),$data['session_data']['user_id'],$this->uri->segment(2));
					
					
					if ($record_result) {
						$message_id = $this->db->insert_id();
						//message in db
						$config['upload_path'] = 'media/uploads/';
						$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|sql|zip|rar';               
						$config['max_size'] = '2000'; //in KB
						$config['encrypt_name'] = TRUE;
						
						$this->upload->initialize($config);

						$this->load->library('upload');
						
						//do upload
						if ($this->upload->do_upload('upload_file')) {
							//success upload
							$file_data = $this->upload->data();
							
							$write_file_result = $this->tasks->setMessageFile($file_data['orig_name'],$file_data['file_name'], $message_id);
							
							if ($write_file_result) {
								//success
								die('ok');
							}
							else {
								//fail to write into db
								die('fail to write');
							}
						}
						else {
							echo $this->upload->display_errors('<p>', '</p>');
							die('upload fail');
						}
					}
					else {
						//error writing message
					}
				}
				
				
				//get messages
				$data['task_info'] = $this->tasks->getTaskInfo($this->uri->segment(2));
				
				//get working hours
				$data['working_hours'] = $this->tasks->taskWorkingHours($this->uri->segment(2));
				
				//get messages
				$data['messages'] = $this->tasks->taskMessages($this->uri->segment(2));
				
				$this->template->load('template', 'task_view', $data);
				
			}
			else {
				//user is NOT allowed to see this task
				redirect('home', 'refresh');
			}
		}
		else {
			//not logged in
			redirect('login', 'refresh');
		}
	}
}