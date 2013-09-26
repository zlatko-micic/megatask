$(document).ready(function() {
	
	//hide tasks
	$('#task_working').on("click",function() {
		
		var id = $(this).attr('data-id');
		
		$("#ajax_working_activity").html('&nbsp;').activity({segments:8,width:2,space:0,length:3,color:'#000',speed:1.5});
		
		$.ajax({
			url: "http://localhost:8888/megatask/a/start_working", //change this link
			type: "POST",
			data: {
				task: id
			},
			dataType: "json",
			success: function (json) {
				if (json.success) {
					//$('#working_stopwatch').stopwatch().stopwatch('start');
					 location.reload();
				}
				else {
					$('#respond_working').html('<div class="infoerrornote"><em></em>'+ json.message +' <span id="working_stopwatch_json"></span></div>');
					
					if (json.diff) {
						$('#working_stopwatch_json').stopwatch({startTime: json.diff}).stopwatch('start');
					}
				}

			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				//$('#createProjectRespond').html('<div class="infoerrornote"><em></em>Error status: '+ xhr.status +'<br>'+ thrownError +'</div>');
			}
		}); //end ajax
		
		$("#ajax_working_activity").html('&nbsp;');


		return false;
	});
	
});