jQuery(document).ready(function() {
	$(window).scroll(function() {
	if($(window).scrollTop()>0)
	{
		$('#main-footer').fadeOut("fast").addClass("show");
	}
	else
	{
		$('#main-footer').fadeIn("fast").removeClass("show");
	}
});
