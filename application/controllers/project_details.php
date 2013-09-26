<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Project_details extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('project_model','',TRUE);
		$this->load->model('user_model','',TRUE);
	}
	
	function index() {
		//page details
		$data['page_details']['id'] = 7;
		
		if ($this->session->userdata('logged_in')) {
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//check if user can see this project
			if ($this->project_model->checkUserPrivilege($data['session_data']['user_id'], $this->uri->segment(2))) {
				//user is allowed to see details
				
				//get working hours
				$data['project_details'] = $this->project_model->getWorkingHours($this->uri->segment(2));
				
				//sum all time in seconds
				$data['sum_seconds'] = 0;
				
				if ($data['project_details']) {
					foreach ($data['project_details'] as $row) {
						$data['sum_seconds'] += $row->seconds;
					}	
				}
				
				/*
				 * Get unique arrays of dates and users
				 * we need this one for highcharts stats
				 */
				$a_dates = array ();
				$a_users = array ();
				$a_highchart = array ();
				
				//create array with dates
				if ($data['project_details']) {
					foreach ($data['project_details'] as $row) 
						if (!in_array($row->date,$a_dates) && $row->finished != '0000-00-00 00:00:00') array_push($a_dates,$row->date);
				}
				
				//create array with user IDs
				if ($data['project_details']) {
					foreach ($data['project_details'] as $row)
						if (!$this->in_multiarray($row->user_id,$a_users,'id') && $row->finished != '0000-00-00 00:00:00') 
								array_push($a_users,array(
														'id' =>$row->user_id,
														'name' =>$row->name
														));
				}
				
				//create array for highchart
				foreach ($a_users as $key => $row) {
					
					$dates_sum = ''; //sum pro dates. (2, 5, 8, ...)
					$total_sum = 0; //total sum for user
					foreach ($a_dates as $date) {
						//loop through dates array and search for seconds for this user id
						$sum = 0;
						foreach ($data['project_details'] as $data_row) {
							if ($data_row->finished != '0000-00-00 00:00:00' && $data_row->user_id == $row['id'] && $data_row->date == $date) {
								$sum += $data_row->seconds;
								$total_sum += $data_row->seconds;
							}
						}
						
						//set sum for this date
						$dates_sum .= $sum.', ';
					}
					
					$a_highchart[$key]['user_id'] = $row['id'];
					$a_highchart[$key]['name'] = $row['name'];
					$a_highchart[$key]['dates'] = $dates_sum;
					$a_highchart[$key]['total'] = $total_sum;
				}
				
				$data['highchart'] = $a_highchart;
				$data['dates'] = $a_dates;
				
				//get all projects
				$data['my_projects'] = $this->project_model->userProjects($data['session_data']['user_id']);
				
				
				$this->template->load('template', 'project_details_view', $data);
			}
			else {
				//not allowed. redirec to home
				redirect('/', 'refresh');
			}
			
		}
		else {
			//not logged in
			redirect('login', 'refresh');
		}
	}
	
	function convertSeconds($time) {
		// time duration in seconds

		$days = floor($time / (60 * 60 * 24));
		$time -= $days * (60 * 60 * 24);

		$hours = floor($time / (60 * 60));
		$time -= $hours * (60 * 60);

		$minutes = floor($time / 60);
		$time -= $minutes * 60;

		$seconds = floor($time);
		$time -= $seconds;
		
		$result = '';
		
		if ($days > 0) {
			$result .= $days.' days ';
		}
		if ($days > 0 && $hours > 0) {
			$result .= $hours.' hours ';
		}
		if ($days > 0 && $hours > 0 && $minutes > 0) {
			$result .= $minutes.' minutes ';
		}
		
		if ($days > 0 && $hours > 0 && $minutes > 0 && $seconds > 0 ) {
			$result .= $seconds.' seconds ';
		}
		
		return $result;
	}
	
	function in_multiarray($elem, $array,$field) {
		$top = sizeof($array) - 1;
		$bottom = 0;
		while($bottom <= $top)
		{
			if($array[$bottom][$field] == $elem)
				return true;
			else 
				if(is_array($array[$bottom][$field]))
					if(in_multiarray($elem, ($array[$bottom][$field])))
						return true;

			$bottom++;
		}        
		return false;
	}

}