<?php 
/**
* Main Class of this plugin for saving jquery for each post
*/
class jQuery_in_Posts_Pages
{
	
	function __construct()
	{
		add_action( 'add_meta_boxes', array($this, 'wcp_script_box') );
		add_action( 'save_post', array($this, 'wcp_saving_custom_js') );
		add_action( 'wp_footer', array($this, 'enque_scripts_here') );
	}

	function wcp_script_box(){
		add_meta_box( 'WCP_script', 'jQuery or JavaScript', array($this, 'wcp_script_cb'), '', 'normal', 'default' );
	}

	function wcp_script_cb(){
		global $post;
		$wcp_meta = get_post_meta( $post->ID, 'wcp_custom_script', true );
		$wcp_js_code = ($wcp_meta != '') ? $wcp_meta : '' ;
		echo '<div class="wp-editor-container"><textarea class="wp-editor-area" name="wcp_custom_script">'.stripcslashes($wcp_js_code).'</textarea></div>';
		echo '<br><div><a target="_blank" href="http://codecanyon.net/item/custom-styles-and-scripts/14322786?ref=WebCodingPlace" class="button-secondary">Explore Pro Features</a></div>';		
	}

	function wcp_saving_custom_js($post_id){
		if (isset($_POST['wcp_custom_script'])) {
			update_post_meta( $post_id, 'wcp_custom_script', $_POST['wcp_custom_script'] );
		}
	}

	function enque_scripts_here(){
		if (!is_singular()) {
			return;
		}
		global $post;
		
		$wcp_meta = get_post_meta( $post->ID, 'wcp_custom_script', true );
		if ($wcp_meta != '') {
			ob_start(); ?>
				<script type="text/javascript">
				<!--
					jQuery(document).ready(function($) {
						<?php echo stripcslashes($wcp_meta); ?>
					});				
				//--></script>				
			<?php echo ob_get_clean();
		}		
	}
}
?>