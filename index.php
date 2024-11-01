<?php
/**
 * Plugin Name:       WPP Elementor Addons
 * Plugin URI:        https://wordpresspioneers.com
 * Description:       Best Free Elementor Addons for all types of websites like shop, blog, business directy, portfolio, personal and many more
 * Version:           1.2
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Suhail Ahmad
 * Author URI:        https://wordpresspioneers.com/author
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wordpresspioneers
 * Domain Path:       https://wordpresspioneers.com
 */


function wppee_enqueue_style() {
    wp_enqueue_style('wct_aut_my', plugins_url('/index_files/autoptimize_590b61ea9e4ae67bca6fd4b7c3676682.css', __FILE__));
	wp_enqueue_style('wct_core', plugins_url('/index_files/wct_grid_assets/wct_core.css', __FILE__)); 
	wp_enqueue_style('wct_fontawesome', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css'); 
}

add_action( 'wp_enqueue_scripts', 'wppee_enqueue_style' );


require_once(__DIR__ . '/elementor-widget.php');


// create custom plugin settings menu
add_action('admin_menu', 'wppee_elementor_addons_extension_menu');

function wppee_elementor_addons_extension_menu() {

	//create new top-level menu
	add_menu_page('A Basic Preview and Names of Our Available Elementor Elements', 'WPP Elements', 'administrator', __FILE__, 'wppee_elementor_addons_extension_page' , plugins_url('/images/icon.ico', __FILE__) );
	
}

function wppee_elementor_addons_extension_page() { 
	echo "<h3>A Basic Preview and Names of Our Available Elements</h3>";
	?>
    	<table width="100%" class="elements-preview">
        	<tr>
            	<td><?php echo "<img src='https://ps.w.org/wpp-elementor-addons/assets/screenshot-1.png?rev=2570676' width='100%'>"; ?><h4 style="width:100%;text-align:center;font-size: 20px;">Animated Rotating CD Cover</h4></td>
                <td><?php echo "<img src='https://ps.w.org/wpp-elementor-addons/assets/screenshot-2.png?rev=2570676' width='100%'>"; ?><h4 style="width:100%;text-align:center;font-size: 20px;">WooCommerce Responsive Product Grid</h4></td>
            </tr>
            <tr>
            	<td><?php echo "<img src='https://ps.w.org/wpp-elementor-addons/assets/screenshot-3.gif?rev=2570676' width='100%'>"; ?><h4 style="width:100%;text-align:center;font-size: 20px;">Portfolio Filter Gallery</h4></td>
                <td></td>
            </tr>

        
        </table>
	<style> .elements-preview td { padding:45px; }</style>
	<?php

}

add_action('init', 'wppee_custom_post_portfolio');

function wppee_custom_post_portfolio()
{
  $labels = array(
    'name' => _x('Portfolio', 'post type general name', 'bisnezia'),
    'singular_name' => _x('Portfolio', 'post type singular name', 'bisnezia'),
    'add_new' => _x('Add New', 'Portfolio', 'bisnezia'),
    'add_new_item' => __('Add New Portfolio', 'bisnezia'),
    'edit_item' => __('Edit Portfolio', 'bisnezia'),
    'new_item' => __('New Portfolio', 'bisnezia'),
    'view_item' => __('View Portfolio', 'bisnezia'),
    'search_items' => __('Search Portfolio', 'bisnezia'),
    'not_found' =>  __('No Portfolio found', 'bisnezia'),
    'not_found_in_trash' => __('No Portfolio found in Trash', 'bisnezia'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
	'rewrite' => true,
	'taxonomies' => array('post_tag'),
    'supports' => array('title','editor','thumbnail', 'thumbnail')
  );
  register_post_type('portfolio',$args);
}

add_action( 'init', 'wppee_add_custom_taxonomies1', 0 );

function wppee_add_custom_taxonomies1() {

    // Add new taxonomy, make it hierarchical (like categories)
	$labels_adp = array(
						'name'                => _x( 'Portfolio Category', 'taxonomy general name', 'bisnezia' ),
						'singular_name'       => _x( 'Portfolio Category', 'taxonomy singular name', 'bisnezia' ),
						'search_items'        => __( 'Search Portfolio', 'bisnezia' ),
						'all_items'           => __( 'All Cats', 'bisnezia' ),
						'parent_item'         => __( 'Parent Cat', 'bisnezia' ),
						'parent_item_colon'   => __( 'Parent Cats:', 'bisnezia' ),
						'edit_item'           => __( 'Edit Portfolio Category', 'bisnezia' ), 
						'update_item'         => __( 'Update Portfolio Category', 'bisnezia' ),
						'add_new_item'        => __( 'Add New Portfolio Category', 'bisnezia' ),
						'new_item_name'       => __( 'New Portfolio Category', 'bisnezia' ),
						'menu_name'           => __( 'Portfolio Cats', 'bisnezia' )
						);    

	$args_adp = array(
						'hierarchical'        => true,
						'labels'              => $labels_adp,
						'show_ui'             => true,
						'show_admin_column'   => true,
						'query_var'           => true,
						'rewrite'             => array( 'slug' => 'portfolio-category' )
						);

	register_taxonomy( 'portfolio_cat', array( 'portfolio' ), $args_adp );

}

add_action( 'wp_ajax_wppee_get_portfolio_content', 'wppee_get_post_content_callback' );
// If you want not logged in users to be allowed to use this function as well, register it again with this function:
add_action( 'wp_ajax_nopriv_wppee_get_portfolio_content', 'wppee_get_post_content_callback' );

function wppee_get_post_content_callback() {
	
	// retrieve post_id, and sanitize it to enhance security
    $post_id = intval($_POST['post_id'] );

    // Check if the input was a valid integer
    if ( $post_id == 0 ) {
        echo "Invalid Input";
        die();
    }

    // get the post
    $thispost = get_post( $post_id );

    // check if post exists
    if ( !is_object( $thispost ) ) {
        echo 'There is no post with the ID ' . esc_html($post_id);
        die();
    }
	
	$custom = get_post_custom($post_id);
	
	$fields = array();
	
	$fields[] = array("name" => $custom["field_1_name"][0], "value"=>$custom["field_1_value"][0] );

	
	$fields[] = array("name" => $custom["field_2_name"][0], "value"=>$custom["field_2_value"][0] );
	
	$fields[] = array("name" => $custom["field_3_name"][0], "value"=>$custom["field_3_value"][0] );
	
	$fields[] = array("name" => $custom["field_4_name"][0], "value"=>$custom["field_4_value"][0] );
	
	$fields[] = array("name" => $custom["field_5_name"][0], "value"=>$custom["field_5_value"][0] );
	
	$fields[] = array("name" => $custom["field_6_name"][0], "value"=>$custom["field_6_value"][0] );
	
	$fields[] = array("name" => $custom["field_7_name"][0], "value"=>$custom["field_7_value"][0] );
	
	$fields[] = array("name" => $custom["field_8_name"][0], "value"=>$custom["field_8_value"][0] );
	
	$fields[] = array("name" => $custom["field_9_name"][0], "value"=>$custom["field_9_value"][0] );
	
	$fields[] = array("name" => $custom["field_10_name"][0], "value"=>$custom["field_10_value"][0] );
	
	$field_string = "";
	
	foreach($fields as $field){
		
		if($field["name"]!=NULL){
		
			$field_string.= "<span>".$field["name"].": </span><span>".$field["value"]."</span><br>";
		
		}
		
	}
	
	//echo $post_id."<br>";
    //echo $thispost->post_content; //Maybe you want to echo wpautop( $thispost->post_content );
	
	//get_header();
	//echo $thispost->post_content;
	//get_footer();
	
	$my_postid = $thispost;//This is page id or post id
	$content_post = get_post($my_postid);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	//$content = str_replace(']]>', ']]&gt;', $content);
	
	
	echo "<h1>".esc_html($thispost->post_title)."</h1>";
	
	echo '<div class="">
				<table class="portfolio_table" style="border:none;">
					<tr style="border:none;">
						<td style="border:none;">
							'.get_the_post_thumbnail($post_id, 'full', array('class'=>'img-responsive portfolio-image')).'
						</td>
						<td style="vertical-align:middle;border:none;">
							'.$field_string.'
						</td>
					</tr>
				</table>
				
		  </div>
		  <div class="">
		  	'.$content.'
		  </div>';

    die();
	
}


add_action("admin_init", "wppee_extra_custom_fields");
 
function wppee_extra_custom_fields(){
  add_meta_box("Extra Fields", "Information", "wppee_position_box", array("portfolio"), "normal", "low");
}

function wppee_position_box(){
  global $post;
  $custom = get_post_custom($post->ID);

  $field_1_name = $custom["field_1_name"][0];
  $field_1_value = $custom["field_1_value"][0];
  
  $field_2_name = $custom["field_2_name"][0];
  $field_2_value = $custom["field_2_value"][0];
  
  $field_3_name = $custom["field_3_name"][0];
  $field_3_value = $custom["field_3_value"][0];
  
  $field_4_name = $custom["field_4_name"][0];
  $field_4_value = $custom["field_4_value"][0];
  
  $field_5_name = $custom["field_5_name"][0];
  $field_5_value = $custom["field_5_value"][0];
  
  $field_6_name = $custom["field_6_name"][0];
  $field_6_value = $custom["field_6_value"][0];
  
  $field_7_name = $custom["field_7_name"][0];
  $field_7_value = $custom["field_7_value"][0];
  
  $field_8_name = $custom["field_8_name"][0];
  $field_8_value = $custom["field_8_value"][0];
  
  $field_9_name = $custom["field_9_name"][0];
  $field_9_value = $custom["field_9_value"][0];
  
  $field_10_name = $custom["field_10_name"][0];
  $field_10_value = $custom["field_10_value"][0];
  

 ?>
 	<h2>Only fill those fields which you want to add. Leaving fields empty will not show up on the frontend</h2>
 
    <label>Field 1</label><br />
    <input type="text" name="field_1_name" placeholder="Field 1 Name" value="<?php echo esc_attr($field_1_name); ?>" />
    <input type="text" name="field_1_value" placeholder="Field 1 Value" value="<?php echo esc_attr($field_1_value); ?>" />
    <br /><br />
    
    <label>Field 2</label><br />
    <input type="text" name="field_2_name" placeholder="Field 2 Name" value="<?php echo esc_attr($field_2_name); ?>" />
    <input type="text" name="field_2_value" placeholder="Field 2 Value" value="<?php echo esc_attr($field_2_value); ?>" />
    <br /><br />
    
    <label>Field 3</label><br />
    <input type="text" name="field_3_name" placeholder="Field 3 Name" value="<?php echo esc_attr($field_3_name); ?>" />
    <input type="text" name="field_3_value" placeholder="Field 3 Value" value="<?php echo esc_attr($field_3_value); ?>" />
    <br /><br />
    
    <label>Field 4</label><br />
    <input type="text" name="field_4_name" placeholder="Field 4 Name" value="<?php echo esc_attr($field_4_name); ?>" />
    <input type="text" name="field_4_value" placeholder="Field 4 Value" value="<?php echo esc_attr($field_4_value); ?>" />
    <br /><br />
    
    <label>Field 5</label><br />
    <input type="text" name="field_5_name" placeholder="Field 5 Name" value="<?php echo esc_attr($field_5_name); ?>" />
    <input type="text" name="field_5_value" placeholder="Field 5 Value" value="<?php echo esc_attr($field_5_value); ?>" />
    <br /><br />
    
    <label>Field 6</label><br />
    <input type="text" name="field_6_name" placeholder="Field 6 Name" value="<?php echo esc_attr($field_6_name); ?>" />
    <input type="text" name="field_6_value" placeholder="Field 6 Value" value="<?php echo esc_attr($field_6_value); ?>" />
    <br /><br />
    
    <label>Field 7</label><br />
    <input type="text" name="field_7_name" placeholder="Field 7 Name" value="<?php echo esc_attr($field_7_name); ?>" />
    <input type="text" name="field_7_value" placeholder="Field 7 Value" value="<?php echo esc_attr($field_7_value); ?>" />
    <br /><br />
    
    <label>Field 8</label><br />
    <input type="text" name="field_8_name" placeholder="Field 8 Name" value="<?php echo esc_attr($field_8_name); ?>" />
    <input type="text" name="field_8_value" placeholder="Field 8 Value" value="<?php echo esc_attr($field_8_value); ?>" />
    <br /><br />
    
    <label>Field 9</label><br />
    <input type="text" name="field_9_name" placeholder="Field 9 Name" value="<?php echo esc_attr($field_9_name); ?>" />
    <input type="text" name="field_9_value" placeholder="Field 9 Value" value="<?php echo esc_attr($field_9_value); ?>" />
    <br /><br />
    
    <label>Field 10</label><br />
    <input type="text" name="field_10_name" placeholder="Field 10 Name" value="<?php echo esc_attr($field_10_name); ?>" />
    <input type="text" name="field_10_value" placeholder="Field 10 Value" value="<?php echo esc_attr($field_10_value); ?>" />
    <br /><br />
    

    <?php 
}

add_action('save_post', 'wppee_save_details');

function wppee_save_details(){
	
  	global $post;
	
	if(isset($_POST["field_1_name"])){
		update_post_meta($post->ID, "field_1_name", sanitize_text_field($_POST["field_1_name"]));
	}
	if(isset($_POST["field_1_value"])){
		update_post_meta($post->ID, "field_1_value", sanitize_text_field($_POST["field_1_value"]));
	}
	
	if(isset($_POST["field_2_name"])){
		update_post_meta($post->ID, "field_2_name", sanitize_text_field($_POST["field_2_name"]));
	}
	if(isset($_POST["field_2_value"])){
		update_post_meta($post->ID, "field_2_value", sanitize_text_field($_POST["field_2_value"]));
	}
	
	if(isset($_POST["field_3_name"])){
		update_post_meta($post->ID, "field_3_name", sanitize_text_field($_POST["field_3_name"]));
	}
	if(isset($_POST["field_3_value"])){
		update_post_meta($post->ID, "field_3_value", sanitize_text_field($_POST["field_3_value"]));
	}
	
	if(isset($_POST["field_4_name"])){
		update_post_meta($post->ID, "field_4_name", sanitize_text_field($_POST["field_4_name"]));
	}
	if(isset($_POST["field_4_value"])){
		update_post_meta($post->ID, "field_4_value", sanitize_text_field($_POST["field_4_value"]));
	}
	
	if(isset($_POST["field_5_name"])){
		update_post_meta($post->ID, "field_5_name", sanitize_text_field($_POST["field_5_name"]));
	}
	if(isset($_POST["field_5_value"])){
		update_post_meta($post->ID, "field_5_value", sanitize_text_field($_POST["field_5_value"]));
	}
	
	if(isset($_POST["field_6_name"])){
		update_post_meta($post->ID, "field_6_name", sanitize_text_field($_POST["field_6_name"]));
	}
	if(isset($_POST["field_6_value"])){
		update_post_meta($post->ID, "field_6_value", sanitize_text_field($_POST["field_6_value"]));
	}
	
	if(isset($_POST["field_7_name"])){
		update_post_meta($post->ID, "field_7_name", sanitize_text_field($_POST["field_7_name"]));
	}
	if(isset($_POST["field_7_value"])){
		update_post_meta($post->ID, "field_7_value", sanitize_text_field($_POST["field_7_value"]));
	}

	
	if(isset($_POST["field_8_name"])){
		update_post_meta($post->ID, "field_8_name", sanitize_text_field($_POST["field_8_name"]));
	}
	if(isset($_POST["field_8_value"])){
		update_post_meta($post->ID, "field_8_value", sanitize_text_field($_POST["field_8_value"]));
	}
	
	if(isset($_POST["field_9_name"])){
		update_post_meta($post->ID, "field_9_name", sanitize_text_field($_POST["field_9_name"]));
	}
	if(isset($_POST["field_9_value"])){
		update_post_meta($post->ID, "field_9_value", sanitize_text_field($_POST["field_9_value"]));
	}
		
	if(isset($_POST["field_10_name"])){
		update_post_meta($post->ID, "field_10_name", sanitize_text_field($_POST["field_10_name"]));
	}
	if(isset($_POST["field_10_value"])){
		update_post_meta($post->ID, "field_10_value", sanitize_text_field($_POST["field_10_value"]));
	}
	
}


