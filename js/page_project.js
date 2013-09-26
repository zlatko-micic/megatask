$(document).ready(function() {
	
	//hide tasks
	$('#showHideAll li').on("click",function(){
		$(this).siblings().removeClass('selected');
		$(this).addClass('selected');
		
		var m = $(this).data('id');
		//alert(m);
		
		if (m == 1) {
			$('.mineTask').fadeIn();
			//alert('in');
		}
		else if (m == 2) {
			$('.mineTask').fadeOut();
			//alert('out');
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