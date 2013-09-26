$(document).ready(function() {
	
	//accept/reject project
	$('.accept, .reject').on('click',function(){
		if(!$('.breakAll').is('*')) {
			var id = $(this).attr('data-id');
			var action = $(this).attr('data-action');
			
			$(this).parent().addClass('breakAll');
			$(this).siblings('.indicator').html('&nbsp;').activity({segments:8,width:2,space:0,length:3,color:'#cacaca',speed:1.5});
			
			$.ajax({
				url: "http://localhost:8888/megatask/a/join_project", //change this link
				type: "POST",
				data: { 
					accept: action,
					invitation: id
				},
				dataType: "json",
				success: function (json) {
					if (json.success) {
						$('.breakAll').fadeOut();
					}
					else {
						$('.breakAll .acceptProjectRespond').html('<div class="infoerrornote"><em></em>'+ json.message +'</div>');
					}
					$('.breakAll .indicator').html('');
					$('.breakAll').removeClass('breakAll');
					
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
					console.log(xhr);
					//$('#createProjectRespond').html('<div class="infoerrornote"><em></em>Error status: '+ xhr.status +'<br>'+ thrownError +'</div>');
				}
			}); //end ajax
			
		}//end if there is no .breakall
	});	
	
});