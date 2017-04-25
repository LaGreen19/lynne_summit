<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:       NoouModal
 * Plugin URI:        http://wearenoou.com/morphing-modal/
 * Description:       This plugin was created by our very own Ben with the base code from a tutorial over at CODYHOUSE written by <a href="http://codyhouse.co/gem/morphing-modal-window/" target="_blank">Claudia Romano</a> – credit where credit is due He has managed to take what Claudia published and turn it into a very neat shortcode based WordPress plugin, that’s mobile friendly. $
 * Version:           1.0.5
 * Author:            Ben at Noou
 * Author URI:        http://wearenoou.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nooumodal
 * Domain Path:       /languages
 */
$noouVersion = 'v1.0.3';
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


require 'plugin_update_check.php';
$MyUpdateChecker = new PluginUpdateChecker_2_0 (
    'https://kernl.us/api/v1/updates/55d724625ccb64483341958d/',
    __FILE__,
    'nooumodal',
    1
);





add_action('admin_menu', 'noou_modal_menu');
 
function noou_modal_menu(){
        add_menu_page( 'NoouModal', 'Noou Modal', 'manage_options', 'nooumodal', 'noou_modal_init', plugin_dir_url( __FILE__ ) . 'img/menu-icon.png' );
}
 
function noou_modal_init(){
        echo '
		
		<h1>NoouModal</h1><br>
		<p>We would love to hear from you if you have found a bug in our plugin or if you have a feature request.</p>
		<p>Please complete the form below and we will add this to our list. </p>
		<p>Thank you<br>The Noou Team</p>
		
		<iframe src="//www.wearenoou.com/gfembed/?f=5" width="100%" height="500" frameBorder="0" class="gfiframe"></iframe>
<script src="//www.wearenoou.com/noou/wp-content/plugins/gravity-forms-iframe-master/assets/scripts/gfembed.min.js" type="text/javascript"></script>

		';
}








if( ! function_exists( 'style' )){

    function style() {
        
        wp_enqueue_style ( 'morph-modal-css', plugins_url ( '/css/morph-modal.css', __FILE__ ) );
wp_enqueue_style ( 'nano-css', plugins_url ( '/css/nano.css', __FILE__ ) );
        wp_enqueue_script ( 'velocity-min-js', plugins_url ( '/js/velocity.min.js', __FILE__ ), array (), '1.0.0', true );
        wp_enqueue_script ( 'morph-modal-js', plugins_url ( '/js/morph-modal.js', __FILE__ ), array (), '1.0.0', true );
        wp_enqueue_script ( 'modernizr-js', plugins_url ( '/js/modernizr.js', __FILE__ ), array (), '1.0.0', true );
wp_enqueue_script ( 'nano-js', plugins_url ( '/js/nano.js', __FILE__ ), array (), '1.0.0', true );
    }
        add_action( 'wp_enqueue_scripts', 'style' );
}else{
    echo 'Function already exists'; 
}
function noou_admin_enqueue($hook) {
    if ( 'post.php' != $hook ) {
        return;
    }
    wp_enqueue_style( 'noou_admin_css', plugin_dir_url( __FILE__ ) . 'css/noou-admin.css' );
    wp_enqueue_script( 'noou_admin_js', plugin_dir_url( __FILE__ ) . 'js/noou-admin.js' );
}
add_action( 'admin_enqueue_scripts', 'noou_admin_enqueue' );
function noou_morphing_modal($atts,$content,$tag){
	//collect values, combining passed in values and defaults
	$values = shortcode_atts(array(
		'button_text' => 'click here',
		'button_color' => '#34383c',
		'button_text_color' => '#fff',
		'modal_color' => '#34383c',
		'modal_text_color' => '#fff',
	),$atts);  
	$noouButtonTitle = $values['button_text'];
	$noouButtonColor = $values['button_color'];
	$noouTextColor = $values['button_text_color'];
	$noouModalColor = $values['modal_color'];
	$noouModalTextColor = $values['modal_text_color'];
	//based on input determine what to return
	$output = '
	<style>
	.cd-modal-action .btn {
  		background-color: ' . $noouButtonColor . ';
	}
.cd-modal-action .cd-modal-bg, .cd-modal .cd-modal-content, .cd-modal nano  {
  background-color: '.$noouModalColor.';
}
.cd-modal-action .btn {
	color:' . $noouTextColor . ';
}
.cd-modal, .cd-modal p {
	color:' . $noouModalTextColor . ';
}
</style>
<section class="cd-section">

<div class="cd-modal-action">
			<a href="#0" class="btn" data-type="modal-trigger">'. $noouButtonTitle .'</a><span class="cd-modal-bg"></span>
		</div>
<p> <!-- cd-modal-action --></p>
<div class="cd-modal nano">
<div class="cd-modal-content nano-content">' . do_shortcode($content) . '


<div class="modal-spacer"></div>

</div>
<p> <!-- cd-modal-content -->
		</div>
<p> <!-- cd-modal --></p>
<p>		<a href="#0" class="cd-modal-close">Close</a><br />
	</section>
<p> <!-- .cd-section --></p>

';	
	return $output;
}
add_shortcode('noou_morphing_modal','noou_morphing_modal');
//add the button to the tinymce editor
add_action('media_buttons_context','add_my_tinymce_media_button');
function add_my_tinymce_media_button($context){
return $context.=__("
<a href=\"#TB_inline?width=585&inlineId=my_shortcode_popup&width=585&height=335\" class=\"button thickbox\" id=\"my_shortcode_popup_button\" title=\"NoouModal\">NoouModal</a>");
}
add_action('admin_footer','my_shortcode_media_button_popup');
//Generate inline content for the popup window when the "my shortcode" button is clicked
function my_shortcode_media_button_popup(){?>

  <div id="my_shortcode_popup" style="display:none;">
    <div class="wrap">	
      <div>
<?php
echo '<img class="noou-logo" src="' . plugins_url( 'img/nooumodal.png', __FILE__ ) . '" > ';
?>
        <div class="my_shortcode_add">
	<div class="noou-left-shortcode-options">
         <label>Button Colour</label><br> 
          <input type="text" id="mm_button_color"><br>
          <br><label>Button Text Colour</label><br>
          <input type="text" id="mm_button_text_color"><br>
           <br><label>Modal Colour</label><br>
           <input type="text" id="mm_modal_color">
		</div>
<div class="noou-right-shortcode-options">
            <label>Modal Text Colour</label><br>
          <input type="text" id="mm_modal_text_color"><br>
           <br><label>Button Text</label><br>
           <input type="text" id="mm_button_text"><br>   <br><br>
          <button class="button-primary" id="id_of_button_clicked">Add Modal</button>
</div>

        </div>
      </div>
    </div>
  </div>
<?php
}
//javascript code needed to make shortcode appear in TinyMCE edtor
add_action('admin_footer','noou_mm_editor');
function noou_mm_editor(){?>
<script>
jQuery('#id_of_button_clicked ').on('click',function(){
  var mmButtonColor = jQuery('#mm_button_color').val();
  var mmButtonTextColor = jQuery('#mm_button_text_color').val();
  var mmModalColor = jQuery('#mm_modal_color').val();
  var mmModalTextColor = jQuery('#mm_modal_text_color').val();
  var mmButtonText = jQuery('#mm_button_text').val();
  var mmModalContent = jQuery('#mm_modal_content').val();
  
  
  var shortcode = '[noou_morphing_modal button_text="'+mmButtonText+'" button_color="'+mmButtonColor+'" button_text_color="'+mmButtonTextColor+'" modal_text_color="'+mmModalTextColor+'" modal_color="'+mmModalColor+'"]INSERT YOUR MODAL CONTENT HERE[/noou_morphing_modal]';
  
  if( !tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()) {
    jQuery('textarea#content').val(shortcode);
  } else {
    tinyMCE.execCommand('mceInsertContent', 0, shortcode);
  }
  //close the thickbox after adding shortcode to editor
  self.parent.tb_remove();
});
</script>
<?php
}