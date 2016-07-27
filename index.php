<?php
/*
Plugin Name: KD Options
Plugin URI: http://bgwebagency.com
Version: 1.0
Author: Kiran Dash
Plugin URI: http://bgwebagency.com
*/

class KD_Options {
	
	public function __construct(){
		
	}
	
	public function add_menu_page(){
		add_options_page('Theme Options','Theme Options','administrator',__FILE__, array('KD_Options'),'display_options_page');	
	}
	
	public function display_options_page(){
		?>
		<div class="wrap">
            <h2>My theme Options</h2>
            <form method="post" action="options.php" enctype="multipart/form-data">
            	<input>
            </form>
        </div>
		<?php				
	}
	
}

add_action('admin_menu', function(){
	KD_Options::add_menu_page();
});
?>