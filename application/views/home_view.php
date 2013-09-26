<div id="leftRow">
	<h1>Tasks that have to be finished soon</h1>
	<?php
	$html = '';
	if ($due_task) {
		
		$html .= '<ul class="taskList">' . "\n";
		foreach ($due_task as $row) {
			$html .= '<li>' . "\n";
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
		foreach ($pending_projects as $row) {
			$html .= '<div>' . "\n";
			$html .= $row->name .' ' . $row->surname . ' has invited you to join his project <b>' . $row->title .'</b>' . "\n";
			$html .= '<br>' . "\n";
			$html .= '<span class="accept" data-action="1" data-id="' . $row->id . '">Accept</span>' . "\n";
			$html .= '<span class="reject" data-action="2" data-id="' . $row->id . '">Reject</span>' . "\n";
			$html .= '<span class="indicator"></span>' . "\n";
			$html .= '<div class="acceptProjectRespond"></div>' . "\n";
			$html .= '</div>' . "\n";
		}
	}
	else {
		$html .= '<div class="infonote"><em></em>No pending invitations at the moment</div>' . "\n";
	}
	echo $html;
	?>
	
</div>


