$(document).ready(function() {
	
	//hide tasks
	$('#showHideAll li').on("click",function(){
		$(this).siblings().removeClass('selected');
		$(this).addClass('selected');
		
		var m = $(this).data('id');
		
		if (m == 1) {
			$('#project_tasks li').fadeIn();
		}
		else if (m == 2) {
			$('#project_tasks li:not(.mineTask)').fadeOut();
		}
		
		var cookieValue = $('#showHideAll li.selected').index()+','+$('#showHideDone li.selected').index();
		
		var today = new Date();
		var expire = new Date();
		expire.setTime(today.getTime() + 3600000*24*50);
		document.cookie = "AllDoneHide="+escape(cookieValue)
				   + ";expires="+expire.toGMTString();


		return false;
	});
	
});