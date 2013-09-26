<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('task_model','',TRUE);
		$this->load->model('project_model','',TRUE);
		$this->load->library('upload');
		$this->load->library('form_validation');
		$this->load->model('user_model','',TRUE);
	}
	
	function index() {
		//page details
		$data['page_details']['id'] = 5;
		
		if ($this->session->userdata('logged_in')) {
			
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//to do - do chekings on $this->uri->segment(2)
			
			//check if user is allowed to see this task
			if ($this->task_model->checkUserPrivilege($data['session_data']['user_id'], $this->uri->segment(2))) {
				//user is allowed to see this task
				
				//validate form (write message)
				$this->form_validation->set_rules('message', "Message", 'trim|required|min_length[3]|xss_clean');
				
				if ($this->form_validation->run() == FALSE) {
					
				}
				else {
					//load user model
					$this->load->model('task_model','',TRUE);
					
					//record message
					$record_result = $this->task_model->setMessage($this->input->post('message'),$data['session_data']['user_id'],$this->uri->segment(2));
					
					
					if ($record_result) {
						$message_id = $this->db->insert_id();
						//message in db
						$config['upload_path'] = 'media/uploads/';
						$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|sql|zip|rar';               
						$config['max_size'] = '200000'; //in KB
						$config['encrypt_name'] = TRUE;
						
						$this->upload->initialize($config);

						$this->load->library('upload');
						
						
						//do upload
						if ($this->upload->do_upload('upload_file')) {
							//success upload
							$file_data = $this->upload->data();
							
							$write_file_result = $this->task_model->setMessageFile($file_data['orig_name'],$file_data['file_name'], $message_id);
							
							if (!$write_file_result) {
								//fail to write into db
								$data['error_message'] = 'We could not store datas about your file in our db!';
							}
						}
						else {
							$data['error_message'] = validation_errors($this->upload->display_errors('<p>', '</p>'));
						}
						
						//end file copy
					}
					else {
						//error copying a file
						$data['error_message'] = 'There was a problem and your message is not submited!';
					}
				}
				
				
				//get task informations
				$data['task_info'] = $this->task_model->getTaskInfo($this->uri->segment(2));
				
				//create an array with details of users who are in project
				$a_project_users_names = explode(',',$data['task_info'][0]->names);
				$a_project_users_last_names = explode(',',$data['task_info'][0]->last_names);
				$a_project_users_ids = explode(',',$data['task_info'][0]->ids);
				
				$a_temp = array();
				foreach ($a_project_users_names as $key => $row) {
					$a_temp[$key]['name'] = $row;
					$a_temp[$key]['last_name'] = $a_project_users_last_names[$key];
					$a_temp[$key]['id'] = $a_project_users_ids[$key];
				}
				
				$data['task_info'][0]->task_users = $a_temp;
				
				//get working hours
				$data['working_hours'] = $this->task_model->taskWorkingHours($this->uri->segment(2));
				
				//get all projects
				$data['my_projects'] = $this->project_model->userProjects($data['session_data']['user_id']);
				
				//get messages
				$data['messages'] = $this->task_model->taskMessages($this->uri->segment(2));
				
				//is user working on task
				$data['now_woring_task'] = $this->user_model->isWorkingOnTask($data['session_data']['user_id']);
				
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