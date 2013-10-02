$(document).ready(function() {
	
	//datetime picker
	$('#started, #ended').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'HH:mm:ss',
	});
});