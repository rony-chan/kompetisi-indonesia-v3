$(document).ready(function(){
	$('#arrowLNew').click(function(){
		$('#thumb-new').animate({'left':'-=300px'});
	});
	$('#arrowRNew').click(function(){
		$('#thumb-new').animate({'left':'+=300px'});
	});
});