<?php

/*

Plugin Name: Merchoo

Description: Add A Merchoo Merchandise Store To Your WordPress Site

Author: Merchoo

Author URI: https://merchoo.com/

Version: 1.0

Text Domain: merchoo_plugin

*/

//-----------------





//Backend functionality

add_action('admin_menu', 'merchoo_admin_menu');



function merchoo_load_scripts() {



wp_enqueue_script('jquery');



wp_enqueue_style('form', plugins_url('form.css', __FILE__) );

wp_enqueue_style('spectrumcss', plugins_url('spectrum.css', __FILE__) );



}



//Admin menu add function

function merchoo_admin_menu(){

wp_enqueue_script('spectrum', plugins_url('spectrum.js', __FILE__), 'jquery');



  add_menu_page('Merchoo', 'Merchoo', 'manage_options', 'wp_merchoo', 'merchoo_admin_function',plugins_url( 'merchoo/icon.png' ));

}

// Add settings link on plugin page

function merchoo_plugin_settings_link($links) { 

  $settings_link = '<a href="admin.php?page=wp_merchoo">Settings</a>'; 

  array_unshift($links, $settings_link); 

  return $links; 

}

 

$plugin = plugin_basename(__FILE__); 

add_filter("plugin_action_links_$plugin", 'merchoo_plugin_settings_link' );

function merchoo_admin_function(){

$logolink = plugins_url( 'merchoo/logo6_dark.png' );

merchoo_load_scripts();

	?>

     <div class="wrap">

    <a href="https://merchoo.com"><img src="<?php echo $logolink; ?>"></a>

	<br><br>

    <?php

	

	if(isset($_POST['merchoo_submit'])){

		update_option( 'merchoo_id',$_POST['merchoo_id'] );

		update_option( 'merchoo_color',$_POST['merchoo_color'] );

		update_option( 'merchoo_btn_text',$_POST['merchoo_btn_text'] );

		echo '<div class="updated settings-error" id="setting-error-settings_updated"> 

<p><strong>Merchoo information saved.</strong></p></div>';

	}

	$merchoo_id=get_option( 'merchoo_id' );

  	$merchoo_color=get_option( 'merchoo_color' );

	$merchoo_btn_text=get_option( 'merchoo_btn_text' );

	

	if(substr($merchoo_color,0,1)!='#'){

		$merchoo_color='#ff7e00';

	}



	if(substr($merchoo_btn_text,0,1)!='#'){

		$merchoo_btn_text='#ffffff';

	}



	?>







<form method="post" action="" class="pure-form pure-form-aligned">

    <fieldset>

	

        <div class="pure-control-group">

            <label for="name">Merchoo Account #</label>

            <input name="merchoo_id" id="merchoo_id" type="text" value="<?php echo $merchoo_id;?>">

        </div>



        <div class="pure-control-group">

            <label for="password">Button Color</label>

            <input value="<?php echo $merchoo_color; ?>" name="merchoo_color" type="text" id="choosecolor"/>

        </div>

		

	<div class="pure-control-group">

            <label for="password">Button Text Color</label>

            <input value="<?php echo $merchoo_btn_text; ?>" name="merchoo_btn_text" type="text" id="choosecolor2"/>

        </div>	

		

        <div class="pure-controls"> 

            <button name="merchoo_submit" type="submit" class="pure-button pure-button-primary">Save</button>

        </div>

    </fieldset>

</form>

<br>

<a href="https://merchoo.com/login.php">Login</a> to your Merchoo account to add designs and check your earnings.

<br><br>

Don't have a Merchoo account? <a href="https://merchoo.com">Sign up</a>  now, it's free!

   

    </div>



<script>



jQuery( window ).load(function() {

 //alert('test')

});

  // Run code



jQuery("#choosecolor").spectrum({

    preferredFormat: "hex",

    showInput: true,

    color: "<?php echo $merchoo_color;?>"

});



jQuery("#choosecolor2").spectrum({

    preferredFormat: "hex",

    showInput: true,

    color: "<?php echo $merchoo_btn_text;?>"

});



</script>



    <?php

}

//Frontend functionality

function merchoo_scripts() {		

wp_enqueue_script( 'merchoo_scripts','https://merchoo.com/app/store.js', array(), null, true );

}



function insert_my_footer(){

 $merchoo_id=get_option( 'merchoo_id' );

 $merchoo_color=get_option( 'merchoo_color' );

 $merchoo_btn_text=get_option( 'merchoo_btn_text' );

 if(empty($merchoo_id)){

	 $merchoo_id="''";

 }else{

	 $merchoo_id=$merchoo_id;

 }

 if(empty($merchoo_color)){

	 $merchoo_color="#ff7e00";

 }else{

	 $merchoo_color=$merchoo_color;

 }

 if(empty($merchoo_btn_text)){

	$merchoo_btn_text='White';

 }else{

	$merchoo_btn_text=$merchoo_btn_text;

 }



echo '

<script>

var merchoo_id='.$merchoo_id.';

var merchoo_color="'.$merchoo_color.'";

var merchoo_btn_color="'.$merchoo_btn_text.'";

</script>

';

}

add_action('wp_footer', 'insert_my_footer');

add_action( 'wp_enqueue_scripts', 'merchoo_scripts', 20, 1);



?>