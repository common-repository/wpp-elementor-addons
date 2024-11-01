<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Wppee_ProductGrid extends Widget_Base{
	
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		
		//wp_register_style( 'mywidgetcssforcdcover', plugins_url('/index_files/autoptimize_590b61ea9e4ae67bca6fd4b7c3676682.css') );
		
		//wp_register_style( 'mycdcovercss', plugins_url( '/index_files/autoptimize_590b61ea9e4ae67bca6fd4b7c3676682.css' ), array(), '1.0.0' );
	}
	

  public function get_name(){
    return 'productgrid';
  }

  public function get_title(){
    return 'Products Grid';
  }

  public function get_icon(){
    return 'fa fa-shopping-cart';
  }

  public function get_categories(){
    return ['wppallelements'];
  }
  

  protected function _register_controls(){
	
	$args = array(
		'type'                     => 'product',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'product_cat',
		'pad_counts'               => false 
	
	); 
	
	$cats = get_categories( $args );
	
	$new_array = array();
	
	$new_array["all"] = "All";
	
	foreach($cats as $one_cat){
		
		$cat_id = $one_cat->term_id;
		$cat_name = $one_cat->name;
		$cat_slug = $one_cat->slug;
		
		$new_array[$cat_slug] = $cat_name;
		
	}
	
	
	
    $this->start_controls_section(
      'section_content',
      [
        'label' => 'Settings',
      ]
    );
	
	
	$this->add_control(
			'woo_cats',
			[
				'label' => __( 'Select Category', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'all',
				'options' => $new_array,
			]
		);
	
	$this->add_control(
      'posts_per_page',
      [
        'label' => 'Show Total Products',
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 9
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
			'badge_color',
			[
				'label' => __( 'Category Badge Color', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				/*'selectors' => [
					'{{WRAPPER}} .sale_tag' => 'background-color:{{VALUE}};',
				],*/
			]
		);
		
		$this->add_control(
			'title_opacity',
			[
				'label' => __( 'OPACITY', 'wordpresspioneers' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'opacity' => 70,
					'unit' => '%',
					
				],
				'selectors' => [
					'{{WRAPPER}} .wct_product_title' => 'background-color:rgba(0, 0, 0, {{SIZE}});',
				],
				
			]
		);
		
		$this->add_control(
			'price_color1',
			[
				'label' => __( 'Price Color 1', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				/*'selectors' => [
					'{{WRAPPER}} .sale_tag' => 'background-color:{{VALUE}};',
				],*/
			]
		);
		
		$this->add_control(
			'price_color2',
			[
				'label' => __( 'Price Color 2', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				/*'selectors' => [
					'{{WRAPPER}} .sale_tag' => 'background-color:{{VALUE}};',
				],*/
			]
		);
		
	$this->add_control(
			'cart_button_color',
			[
				'label' => __( 'Cart Button Background', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .wct_add_to_cart' => 'background-color:{{VALUE}};',
				],
			]
		);
	
	$this->add_control(
			'view_button_color',
			[
				'label' => __( 'View Button Background', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .wct_product_view' => 'background-color:{{VALUE}};',
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
				'name' => 'sale_tag_typography',
				'label' => __( 'Category Badge Text', 'wordpresspioneers' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .sale_tag',
			]
		);
		
	$this->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'content_typography',
			'label' => __( 'Title Text', 'wordpresspioneers' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .wct_product_title',
		]
	);
	
	
	$this->end_controls_section();
	
	$this->start_controls_section(
		'section_product_background',
		[
			'label' => __( 'Background', 'wordpresspioneers' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);
	
	$this->add_control(
			'background_zoom_min',
			[
				'label' => __( 'Min Zoom', 'wordpresspioneers' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', "%" ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
						'step' => 10,
					],
				],
				'default' => [
					'zoom' => 100,
					'unit' => 'px',
					
				],
				/*'selectors' => [
					'{{WRAPPER}} .wct_product' => 'background-size:{{SIZE}}%);',
				],*/
				
			]
		);
		
		$this->add_control(
			'background_zoom_max',
			[
				'label' => __( 'Max Zoom', 'wordpresspioneers' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', "%" ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
						'step' => 10,
					],
				],
				'default' => [
					'zoom' => 250,
					'unit' => 'px',
					
				],
				/*'selectors' => [
					'{{WRAPPER}} .wct_product:hover' => 'background-size:{{SIZE}}%);',
				],*/
				
			]
		);
		
		$this->end_controls_section();
  }
  
  
  protected function render(){
	
	
    $settings = $this->get_settings_for_display();
	
    $this->add_inline_editing_attributes('woo_cats', 'basic');
    $this->add_render_attribute(
      'woo_cats',
      [
        'class' => ['productgrid__woo_cats'],
      ]
    );
	
	/*$args = array(
		'type'                     => 'product',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'product_cat',
		'pad_counts'               => false 
	
	); 
	
	$cats = get_categories( $args );
	
	$new_array = array();
	
	foreach($cats as $one_cat){
		
		$cat_id = $one_cat->term_id;
		$cat_name = $one_cat->name;
		$cat_slug = $one_cat->slug;
		
		$new_array[$cat_slug] = $cat_name;
		
	}
	
	echo "<pre>";
	print_r($new_array);print_r($cats);
	echo "</pre>";*/

	$cat_name = $settings['woo_cats'];
	
	if($cat_name=="all"){
		$cat_name = '';
	}
	
	$args = array(
						'posts_per_page'   => $settings['posts_per_page'],
						'offset'           => 0,
						'category'         => '',
						'category_name'    => '',
						'orderby'          => 'date',
						'order'            => 'ASC',
						'include'          => '',
						'exclude'          => '',
						'meta_key'         => '',
						'meta_value'       => '',
						'post_type'        => 'product',
						'product_cat'			=> $cat_name,
						'post_mime_type'   => '',
						'post_parent'      => '',
						'author'	   => '',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					);
		$products = get_posts( $args );
		

    ?>
    
    
    <?php foreach($products as $one_product){ ?>
    
    
    <?php $post_thumbnail = get_the_post_thumbnail_url($one_product->ID);  ?>
    
    <?php
		
		$_product = wc_get_product( $one_product->ID );
		
		$terms = get_the_terms( $one_product->ID, 'product_cat' );
		
		$category = $terms[0]->name;
		
		//echo $category;
		
		/*echo "<pre>";
		print_r($category);
		echo "</pre>";*/
		
		$regular_price = $_product->get_regular_price();
		$sale_price = $_product->get_sale_price();
		$price = $_product->get_price();
		$rating = $_product->get_average_rating();
		$currency = get_woocommerce_currency_symbol();
		
		$rating = str_replace(".00", "", $rating);
		
		
	
	?>
    
    <div class="wct_grid_col_xs_<?php echo esc_attr($settings['mobile_columns']); ?> wct_grid_col_sm_<?php echo esc_attr($settings['mobile_columns']); ?> wct_grid_col_md_<?php echo esc_attr($settings['tablet_columns']); ?> wct_grid_col_lg_<?php echo esc_attr($settings['desktop_columns']); ?>">
        <div class="wct_product" style="background-image:url(<?php echo esc_url($post_thumbnail);?>);">
            <?php if($rating>=1){ ?><div class="wct_rating wct_<?php echo esc_attr($rating); ?>_star"></div><?php } ?>
            <div class="wct_product_title" style="background-color:rgba(0, 0, 0, <?php echo esc_attr($settings['title_opacity']['size']); ?>;"><?php echo esc_html($one_product->post_title); ?> <br /><br /><p class="price" style=" color:<?php echo esc_attr($settings['price_color1']); ?>">Price: <?php if($sale_price!=NULL){ ?> <span class="not-price" style=" color:<?php echo esc_attr($settings['price_color2']); ?>"><?php echo esc_html($currency).esc_html($regular_price);?> </span> <?php echo esc_html($currency).esc_html($sale_price);?> <?php } else { ?> <?php echo esc_html($currency).esc_html($regular_price);?>   <?php } ?></p></div>
            <a class="wct_btn wct_btn_green wct_add_to_cart" href="<?php echo esc_url(site_url()); ?>?add-to-cart=<?php echo esc_url($one_product->ID); ?>"><i class="fa fa-cart-plus"></i> </a>
            
            <a class="wct_btn wct_btn_grey wct_product_view" href="<?php echo esc_url(get_the_permalink($one_product->ID)); ?>"><i class="fa fa-eye"></i> </a>
            
            <span class="sale_tag" style=" background-color:<?php echo esc_attr($settings['badge_color']); ?>"><?php echo esc_html($category); ?></span>
        </div>
    </div>
    
    
    
    <?php }
	
	?>
	<style>
	
		.wct_product {
			background-repeat: no-repeat;
			animation: wct_shrink_back .3s;
			background-size: <?php echo esc_html($settings['background_zoom_min']['size']); ?>%;
			background-position: center center;
			
		}
		
		.wct_product:hover {
			animation: wct_shrink .3s;
			background-size:<?php echo esc_html($settings['background_zoom_max']['size']); ?>%;
		}
	
		@keyframes wct_shrink {
		  0% {
			background-size: <?php echo esc_html($settings['background_zoom_min']['size']); ?>%;
		  }
		  100% {
			background-size: <?php echo esc_html($settings['background_zoom_max']['size']); ?>%;
		  }
		}
		
		@keyframes wct_shrink_back {
		  0% {
			background-size: <?php echo esc_html($settings['background_zoom_max']['size']); ?>%;
		  }
		  100% {
			background-size: <?php echo esc_html($settings['background_zoom_min']['size']); ?>%;
		  }
		}
	</style>
    
    <?php
  }

  
}