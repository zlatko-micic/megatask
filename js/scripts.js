$(document).ready(function() {
	
	//background noise
    $('body, #content').noisy();
	
	//tooltips for links
	$(".tiptip").tipTip();
	
	//createProjectBox
	$(".createProjectTrigger").on('click', function(e) {
		if ($(".createProjectBox").is(":visible") ) {
			$(".createProjectBox").fadeOut();
		}
		else {
			$(".createProjectBox").fadeIn();
			//hide other boxes
			$(".listProjectBox").fadeOut();
		}
		e.preventDefault();
	});
	
	//my projoects show/hide
	$(".myProjectsTrigger").on('click', function(e) {
		if ($(".listProjectBox").is(":visible") ) {
			$(".listProjectBox").fadeOut();
		}
		else {
			$(".listProjectBox").fadeIn();
			//hide other boxes
			$(".createProjectBox").fadeOut();
		}
		e.preventDefault();
	});
	
	//submit create project
	$("#createProjectForm").on('submit', function() {
		var title = $('#project_title').val();
		
		$('#respond').html('&nbsp;').activity({segments: 8, width:2, space: 0, length: 3, color: '#ccc', speed: 1.5});

		$.ajax({
			url: globalLink + "a/create_project",
			type: "POST",
			data: { title: title},
			dataType: "json",
			success: function (json) {
				if (json.success) {
					window.location.href = globalLink + "project/"+ json.project_id;
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
	
	//stopwatch
	var $stopwatch = $('#show_working_stopwatch');

    if ($stopwatch.length) {
		var milseconds = parseInt($stopwatch.data('seconds'));
		
		$stopwatch.stopwatch({startTime: milseconds}).stopwatch('start');
    }
	
	//stop working
	$("#stop_working_task").on('click', function() {		
		$.ajax({
			url: globalLink + "a/start_working/stop", 
			type: "POST",
			data: { },
			dataType: "json",
			success: function (json) {
				if (json.success) {
					$('#show_working_stopwatch_details').fadeOut();
					window.location.href = document.URL;
				}
				else {
					alert(json.message);
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
			}
		});

		return false;

    });
	
});

//alert(document.URL);