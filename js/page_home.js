$(document).ready(function() {
	
	//accept/reject project
	$('.accept, .reject').on('click',function(){
		if(!$('.breakAll').is('*')) {
			var globalId = $(this).attr('data-id');
			var pId = $(this).attr('data-pid');
			var action = $(this).attr('data-action');
			
			$(this).parent().addClass('breakAll');
			$(this).siblings('.indicator').html('&nbsp;').activity({segments:8,width:2,space:0,length:3,color:'#cacaca',speed:1.5});
			
			$.ajax({
				url: globalLink + "a/join_project",
				type: "POST",
				data: { 
					accept: action,
					invitation: globalId
				},
				dataType: "json",
				success: function (json) {
					if (json.success) {
						$('.breakAll').html('<div class="infooknote"><em></em><a href="'+ globalLink +'project/'+ pId +'">Click here to see project details</a></div>');
						
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
				}
			}); //end ajax
			
		}//end if there is no .breakall
	});	
	
});