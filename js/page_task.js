function formatSeconds(seconds) {
    var date = new Date(1970,0,1);
    date.setSeconds(seconds);
    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
}

$(document).ready(function() {
	
	//hide tasks
	$('#task_working').on("click",function() {
		
		var id = $(this).attr('data-id');
		
		$("#ajax_working_activity").html('&nbsp;').activity({segments:8,width:2,space:0,length:3,color:'#000',speed:1.5});
		
		$.ajax({
			url: globalLink + "a/start_working",
			type: "POST",
			data: {
				task: id
			},
			dataType: "json",
			success: function (json) {
				if (json.success) {
					//$('#working_stopwatch').stopwatch().stopwatch('start');
					window.location.href = document.URL;
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
			}
		}); //end ajax
		
		$("#ajax_working_activity").html('&nbsp;');


		return false;
	});
	
	//filter working hours
	$('#filter_working_hours li').on("click",function() {
		$(this).siblings().removeClass('selected');
		$(this).addClass('selected');
		
		var m = parseInt($(this).data('id'));
		
		if (m > 0) {
			$('#working_hours_list li').each(function() {
				var uID = parseInt($(this).data('user'));
				//alert(uID);
				
				if (uID !== m) {
					$(this).hide();
					
				}
				else {
					$(this).show();
				}
			});
		}
		else {
			$('#working_hours_list li').show();
			//alert('out');
		}
		
		//get all visible datas
		var sumall = 0;
		$('#working_hours_list li').each(function() {
			if ($(this).is(":visible")) {
				m = $(this).data('seconds');
				
				sumall = sumall + m;
			}
		});
		$("#sumall").html(formatSeconds(sumall));
		
	});
	
	//scroll down working details
	$( ".menu_dropdown" ).click(function() {
		//alert('s');
		$(this).parent().find(".hidden_details").toggle("fast",function() {

		});
	});
	
	//close task
	$('#close_task').on("click",function() {
		
		var id = $(this).attr('data-id');
		
		$("#respond_task_close").html('&nbsp;').activity({segments:8,width:2,space:0,length:3,color:'#000',speed:1.5});
		
		$.ajax({
			url: globalLink + "a/task_end",
			type: "POST",
			data: {
				task_id: id
			},
			dataType: "json",
			success: function (json) {
				if (json.success) {
					window.location.href = document.URL;
				}
				else {
					$('#respond_task_close').html('<div class="infoerrornote"><em></em>'+ json.message +'</div>');
				}

			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}
		});

		return false;
	});
	
	//click all works (to count sum)
	$('#filter_working_hours li:first').click();
});