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

				jQuery('.footer-section').hover(
					function() {
						jQuery(this).fadeIn();
					},
					function(){
						jQuery(this).fadeOut();
}
);
				clearTimeout(jQuery.data(this, 'scrollTimer'));
		         jQuery.data(this, 'scrollTimer', setTimeout(function() {
		 		}, 2000));
		     }
		     footer();
		 });
});
