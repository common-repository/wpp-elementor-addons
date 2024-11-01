<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Wppee_Portfolioeffect extends Widget_Base{
	
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		
		//wp_register_style( 'mywidgetcssforcdcover', plugins_url('/index_files/autoptimize_590b61ea9e4ae67bca6fd4b7c3676682.css') );
		
		//wp_register_style( 'mycdcovercss', plugins_url( '/index_files/autoptimize_590b61ea9e4ae67bca6fd4b7c3676682.css' ), array(), '1.0.0' );
	}
	

  public function get_name(){
    return 'portfolioeffect';
  }

  public function get_title(){
    return 'Categorize Portfolio Effect';
  }

  public function get_icon(){
    return 'fa fa-table';
  }

  public function get_categories(){
    return ['wppallelements'];
  }
  

  protected function _register_controls(){

    $this->start_controls_section(
      'section_content',
      [
        'label' => 'Responsive Settings',
      ]
    );

    $this->add_control(
			'desktop_columns',
			[
				'label' => __( 'Desktop Columns', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'3'  => __( '4', 'wordpresspioneers' ),
					'4' => __( '3', 'wordpresspioneers' ),
					'6' => __( '2', 'wordpresspioneers' ),
					'12' => __( '1', 'wordpresspioneers' ),
					
				],
			]
		);
		
	$this->add_control(
			'tablet_columns',
			[
				'label' => __( 'Tablet Columns', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'3'  => __( '4', 'wordpresspioneers' ),
					'4' => __( '3', 'wordpresspioneers' ),
					'6' => __( '2', 'wordpresspioneers' ),
					'12' => __( '1', 'wordpresspioneers' ),
					
				],
			]
		);
		
	$this->add_control(
			'mobile_columns',
			[
				'label' => __( 'Mobile Columns', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '12',
				'options' => [
					'4' => __( '3', 'wordpresspioneers' ),
					'6' => __( '2', 'wordpresspioneers' ),
					'12' => __( '1', 'wordpresspioneers' ),
					
				],
			]
		);

    $this->end_controls_section();
	
	
	$this->start_controls_section(
		'section_style',
		[
			'label' => __( 'Colors', 'wordpresspioneers' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);
		
		
	$this->add_control(
		'filter_color1',
		[
			'label' => __( 'Filter Button Color 1', 'wordpresspioneers' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'scheme' => [
				'type' => \Elementor\Scheme_Color::get_type(),
				'value' => \Elementor\Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}} .filter-button' => 'border-color:{{VALUE}} !important;',
				'{{WRAPPER}} .filter-button' => 'color:{{VALUE}};',
				'{{WRAPPER}} .modal-header' => 'background-color:{{VALUE}};',
				'{{WRAPPER}} .filter-button:hover' => 'background-color:{{VALUE}};',
				
			],
		]
	);		
		
	$this->add_control(
		'filter_color2',
		[
			'label' => __( 'Filter Button Color 2', 'wordpresspioneers' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'scheme' => [
				'type' => \Elementor\Scheme_Color::get_type(),
				'value' => \Elementor\Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}} .filter-button:hover' => 'color:{{VALUE}};',
				'{{WRAPPER}} .modal-header h2' => 'color:{{VALUE}} !important;',
			],
		]
	);	
	
	$this->end_controls_section();
	
	$this->start_controls_section(
		'section_typography',
		[
			'label' => __( 'Typography', 'wordpresspioneers' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);
	
	$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_typography',
				'label' => __( 'Filter Typography', 'wordpresspioneers' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .filter-button',
			]
		);
		
	$this->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'content_title_typography',
			'label' => __( 'Content Title Typography', 'wordpresspioneers' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} #single-portfolio h1',
		]
	);
	
	$this->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'content_fields_typography',
			'label' => __( 'Content Fields Typography', 'wordpresspioneers' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .portfolio_table td span',
		]
	);
	
	
	$this->end_controls_section();
	
  }
  

  protected function render(){
	  
	  
    $settings = $this->get_settings_for_display();

    $this->add_inline_editing_attributes('label_heading', 'basic');
    $this->add_render_attribute(
      'label_heading',
      [
        'class' => ['advertisement__label-heading'],
      ]
    );
 
	
	$args = array(
		'type'                     => 'portfolio',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'portfolio_cat',
		'pad_counts'               => false 
	
	); 
	
	$cats = get_categories( $args );
	
	/*echo '<pre>';
	print_r($cats);
	echo "</pre>";*/
	
	
	
	$args = array(
						'posts_per_page'   => 300,
						'offset'           => 0,
						'category'         => '',
						'category_name'    => '',
						'orderby'          => 'date',
						'order'            => 'ASC',
						'include'          => '',
						'exclude'          => '',
						'meta_key'         => '',
						'meta_value'       => '',
						'post_type'        => 'portfolio',
						'portfolio_cat'			=> '',
						'post_mime_type'   => '',
						'post_parent'      => '',
						'author'	   => '',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					);
		$portfolio = get_posts( $args );
	

?>


<section>
 <div class="container">
        <div class="row">

        <div align="center">
            <button class="wct_btn wct_btn-default filter-button" data-filter="all" >All</button>
            <?php foreach($cats as $key=>$cat){ ?>
            <?php 
				
				if($key==0){
					$autoload_cat = $cat->slug;
				}
				
				//echo $autoload_cat;
			
			?>
            
            <button class="wct_btn wct_btn-default filter-button" data-filter="<?php echo esc_attr($cat->slug); ?>" ><?php echo esc_html($cat->name); ?></button>
            <?php } ?>
            <!--<button class="btn btn-default filter-button" data-filter="sprinkle">Sprinkle Pipes</button>
            <button class="btn btn-default filter-button" data-filter="spray">Spray Nozzle</button>
            <button class="btn btn-default filter-button" data-filter="irrigation">Irrigation Pipes</button>-->
        </div>
        <br/>

			
            <?php foreach($portfolio as $one_portfolio){ ?>
            
            <?php 
			
				$one_portfolio_terms = wp_get_post_terms( $one_portfolio->ID, 'portfolio_cat' );
			
			?>

                <div class="gallery_product wct_grid_col_xs_<?php echo esc_attr($settings['mobile_columns']); ?> wct_grid_col_sm_<?php echo esc_attr($settings['mobile_columns']); ?> wct_grid_col_md_<?php echo esc_attr($settings['tablet_columns']); ?> wct_grid_col_lg_<?php echo esc_attr($settings['desktop_columns']); ?> filter myBtn <?php echo esc_attr($one_portfolio_terms[0]->slug); ?>" data-cat="<?php echo esc_attr($one_portfolio_terms[0]->slug); ?>" data-id='<?php echo esc_attr($one_portfolio->ID); ?>'>
                    <?php echo get_the_post_thumbnail($one_portfolio->ID, array(300,300), array("class"=>"img-responsive center-block")); ?>
                </div>
            
            <?php } ?>

        </div>
    </div>
</section>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Details</h2>
    </div>
    <div class="modal-body" id="single-portfolio">
      <p>Loading</p>
    </div>
    
  </div>

</div>

<style>
	.myBtn {
		cursor:pointer;
	}
	
	.modal-header {
		background-color:<?php echo esc_html($settings['filter_color1']); ?>;
	}
	
	.portfolio_table td span {
		font-size:20px;	
	}
	.gallery-title
	{
		font-size: 36px;
		color: #42B32F;
		text-align: center;
		font-weight: 500;
		margin-bottom: 70px;
	}
	.gallery-title:after {
		content: "";
		position: absolute;
		width: 7.5%;
		left: 46.5%;
		height: 45px;
		border-bottom: 1px solid #5e5e5e;
	}
	.filter-button
	{
		font-size: 18px;
		border: 1px solid <?php echo esc_html($settings['filter_color1']); ?>;
		border-radius: 5px;
		text-align: center;
		color: <?php echo esc_html($settings['filter_color1']); ?>;
		margin-bottom: 30px;
		background-color:#fff;
	
	}
	.filter-button:hover
	{
		font-size: 18px;
		border: 1px solid <?php echo esc_html($settings['filter_color1']); ?>;
		border-radius: 5px;
		text-align: center;
		color: <?php echo esc_html($settings['filter_color2']); ?>;
		background-color: <?php echo esc_html($settings['filter_color1']); ?>;
	
	}
	.btn-default:active .filter-button:active
	{
		background-color: #42B32F;
		color: white;
	}
	
	.port-image
	{
		width: 100%;
	}
	
	.gallery_product
	{
		margin-bottom: 0px;
	}

</style>

<script>
	jQuery(document).ready(function(){

		jQuery(".filter-button").click(function(){
			var value = jQuery(this).attr('data-filter');
			
			if(value == "all")
			{
				//$('.filter').removeClass('hidden');
				jQuery('.filter').show('1000');
			}
			else
			{
	//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
	//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
				jQuery(".filter").not('.'+value).hide('3000');
				jQuery('.filter').filter('.'+value).show('3000');
				
			}
		});
		
		if (jQuery(".filter-button").removeClass("active")) {
	jQuery(this).removeClass("active");
	}
	jQuery(this).addClass("active");
	
	});
</script>

<script>
	// Get the modal
	var modal = document.getElementById("myModal");
	
	// Get the button that opens the modal
	/*var btn = document.getElementById("myBtn");*/
	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	
	// When the user clicks the button, open the modal 
	/*btn.onclick = function() {
	  modal.style.display = "block";
	}*/
	
	jQuery(".myBtn").on("click", function(){
		
		modal.style.display = "block";
		
		var data_url = jQuery(this).attr('data-url');
		var data_id = jQuery(this).attr('data-id');
		
		//alert(data_id);
		
		jQuery('#single-portfolio').html('Please wait ...');
		
		jQuery.ajax({
			type: 'POST',
			url: '<?php echo esc_js(admin_url('admin-ajax.php')); ?>',
			data: {
				'post_id': data_id,
				'action': 'wppee_get_portfolio_content' //this is the name of the AJAX method called in WordPress
			}, success: function (result) {
	
			   //alert(result);
			   jQuery('#single-portfolio').html(result);
			},
			error: function () {
				alert("error");
			}
		});
		
		
		var div_data = '';
		
		//alert(data_url);
		//jQuery('#single-portfolio').html(div_data);
		jQuery( "#single-portfolio-box" ).slideDown( "slow" );
		
	});
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	  jQuery('#single-portfolio').html('Loading...');
	}
	
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
		modal.style.display = "none";
	  }
	}
</script>

<script>
	var autoload_cat = '<?php echo esc_js($autoload_cat); ?>';
</script>

<?php
	
	
  }

}
