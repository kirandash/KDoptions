<?php
/*
Plugin Name: KD Options
Plugin URI: http://bgwebagency.com
Version: 1.0
Author: Kiran Dash
Plugin URI: http://bgwebagency.com
*/

class KD_Options {
	
	public $options;
	
	public function __construct(){
		//delete_option('kd_plugin_options');//To remove Uninitialized string offset: 0  error
		$this->options = get_option('kd_plugin_options');
		$this->register_settings_and_fields();
	}
	
	public function add_menu_page(){
		add_options_page('Theme Options','Theme Options','administrator',__FILE__, array('KD_Options','display_options_page'));	
	}
	
	public function display_options_page(){
		?>
		<div class="wrap">
            <h2>My theme Options</h2>
            <?php /*$o = get_option('kd_plugin_options'); 
			echo '<pre>';
			print_r($o);
			echo '</pre>'; */
			?>
            <form method="post" action="options.php" enctype="multipart/form-data">
            	<?php settings_fields('kd_plugin_options');//includes all the hidden fields for security ?>
                <?php do_settings_sections(__FILE__); ?>
                
                <p class="submit">
                	<input name="submit" type="submit" class="button-primary" value="Save Changes">
                </p>
            </form>
        </div>
		<?php				
	}
	
	public function register_settings_and_fields(){
		register_setting('kd_plugin_options','kd_plugin_options', array($this,'kd_validate_settings'));//3rd parameter = optional cb
		//get_option('kd_plugin_options');	
		add_settings_section('kd_main_section', 'Main Settings', array($this, 'kd_main_section_cb'), __FILE__);//id, title of section, cb, which page?
		add_settings_field('kd_banner_heading','Banner Heading', array($this, 'kd_banner_heading_setting'), __FILE__, 'kd_main_section');
		add_settings_field('kd_logo','Your Logo: ', array($this, 'kd_logo_setting'), __FILE__, 'kd_main_section');
	}
	
	/*
	 *
	 * Inputs
	 *
	 */
	 
	 // Banner Heading
	 public function kd_banner_heading_setting() {
		 echo "<input name='kd_plugin_options[kd_banner_heading]' type='text' value='{$this->options['kd_banner_heading']}'>";
	 }

	 // Logo
	 public function kd_logo_setting() {
		 echo '<input type="file" name="kd_logo_upload"><br><br>';
		 if(isset($this->options['kd_logo'])) {
			echo "<img src='{$this->options['kd_logo']}' alt='logo image'/>"; 
		 }		 
	 }
	 	 
	 //Function for validation and sanitization
	 public function kd_main_section_cb(){
		 //optional
	 }
	 
	 public function kd_validate_settings($plugin_options){
		 //Add validation later to check if input file is an image
		 if(!empty($_FILES['kd_logo_upload']['tmp_name'])) {
			 $override = array('test_form'=>false);
			 $file = wp_handle_upload($_FILES['kd_logo_upload'], $override);
			 $plugin_options['kd_logo'] = $file['url'];
		 }else{
			 $plugin_options['kd_logo'] = $this->options['kd_logo'];
		 }
		 return $plugin_options;
	 }
	
}

add_action('admin_menu', function(){
	KD_Options::add_menu_page();
});

add_action('admin_init', function(){
	new KD_Options();
});

?>