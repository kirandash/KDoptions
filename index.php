<?php
/*
Plugin Name: KD Options
Plugin URI: http://bgwebagency.com
Version: 1.0
Author: Kiran Dash
Plugin URI: http://bgwebagency.com
*/
add_action('admin_menu', function(){
	add_options_page('Theme Options','Theme Options','administrator',__FILE__, function(){
		//__FILE__ is used as id which returns the path to the page
		?>
		<div class="wrap">
            <h2>My theme Options</h2>
            <form method="post" action="options.php" enctype="multipart/form-data">
            	<input>
            </form>
        </div>
		<?php	
	});
});
?>