$(document).ready(function() {
	
	//background noise
    $('body').noisy();
	
	//tooltips for links
	$(".tiptip").tipTip();
	
	//createProjectBox
	$(".createProjectTrigger").on('click', function(e) {
		if ($(".createProjectBox").is(":visible") ) {
			$(".createProjectBox").fadeOut();
		}
		else {
			$(".createProjectBox").fadeIn();
		}
		//alert('s');
		e.preventDefault();
	});

	$("#createProjectForm").on('submit', function() {
		var title = $('#project_title').val();
		//alert(title);
		
		$('#respond').html('&nbsp;').activity({segments: 8, width:2, space: 0, length: 3, color: '#ccc', speed: 1.5});
		
		$.ajax({
			url: "/megatask/a/create_project", //change this link
			type: "POST",
			data: { title: title},
			dataType: "json",
			success: function (json) {
				if (json.success) {
					window.location.href = "/megatask/project/"+ json.project_id; //change this link
					console.log(json.project_id)
				}
				else {
					$('#createProjectRespond').html('<div class="infoerrornote"><em></em>'+ json.message +'</div>');
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$('#createProjectRespond').html('<div class="infoerrornote"><em></em>Error status: '+ xhr.status +'<br>'+ thrownError +'</div>');
			}
		});

		return false;

    });
	
	
	
});