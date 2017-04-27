jQuery(document).ready(function(){
	jQuery(window).scroll(function(event) {
	function footer()
    {
        var scroll = jQuery(window).scrollTop();
        if(scroll > 50)
        {
            jQuery(".footer-section").fadeIn("slow").addClass("show");
        }
        else
        {
            jQuery(".footer-section").fadeOut("slow").removeClass("show");
        }
		 });
});
