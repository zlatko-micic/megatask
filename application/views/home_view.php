<div id="leftRow">
	<h1>Tasks that have to be finished soon</h1>
	<?php
	$html = '';
	if ($due_task) {
		
		$html .= '<ul class="taskList">' . "\n";
		foreach ($due_task as $row) {
			//add css class for tasks that are overdue
			$time_now = date("Y-m-d H:i:s");
			$css = $row->due_date <= $time_now ? 'important' : '';
			
			$html .= '<li class="'.$css.'">' . "\n";
			$html .= '<a href="'.site_url('/task/'.$row->id).'"><b>'. $row->title .'</b><br>' . "\n";
			$html .= 'Project: '. $row->project .'<br>' . "\n";
			$html .= 'Due '. $row->due_date .'</a>' . "\n";
			$html .= '</li>' . "\n";
		}
		
		$html .= '</ul>' . "\n";
		
		
	}
	else {
		$html .= '<div class="infonote"><em></em>No tasks that have to be finished in next 7 days</div>' . "\n";
	}
	echo $html;
	?>


</div>

<div id="rightRow">
	<h1>Pending project invitations</h1>
	
	<?php
	$html = '';
	if ($pending_projects) {
		$html .= '<ul class="taskList">' . "\n";
		foreach ($pending_projects as $row) {
			$html .= '<li>' . "\n";
			$html .= $row->name .' ' . $row->surname . ' has invited you to join project <b>' . $row->title .'</b>' . "\n";
			$html .= '<br>' . "\n";
			$html .= '<span class="accept" data-action="1" data-pid="' . $row->project_id . '" data-id="' . $row->id . '">Accept</span>' . "\n";
			$html .= '<span class="reject" data-action="2" data-pid="' . $row->project_id . '" data-id="' . $row->id . '">Reject</span>' . "\n";
			$html .= '<span class="indicator"></span>' . "\n";
			$html .= '<div class="acceptProjectRespond"></div>' . "\n";
			$html .= '</li>' . "\n";
		}
		$html .= '</ul>' . "\n";
	}
	else {
		$html .= '<div class="infonote"><em></em>No pending invitations at the moment</div>' . "\n";
	}
	echo $html;
	?>
	
</div>


