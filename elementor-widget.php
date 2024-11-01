<?php

namespace WPC;

// use Elementor\Plugin; ?????
class Widget_Loader{

  private static $_instance = null;

  public static function instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }


  private function include_widgets_files(){
    require_once(__DIR__ . '/widgets/advertisement.php');
	require_once(__DIR__ . '/widgets/productgrid.php');
	require_once(__DIR__ . '/widgets/portfolioeffect.php');
  }

  public function register_widgets(){

    $this->include_widgets_files();

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Wppee_Advertisement());
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Wppee_ProductGrid());
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Wppee_Portfolioeffect());

  }

  public function __construct(){
    add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
	add_action('elementor/elements/categories_registered', [$this, 'elementor_widget_category']);
  }
  
  
  
  public function elementor_widget_category($widgets_manager){
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'wppallelements',
			[
				'title' =>esc_html__( 'WPPAllElements', 'wordpresspioneers' ),
				'icon' => 'fa fa-twitter',
			],
			1
		);
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'wpp_elementor_addons_headerfooter',
            [
                'title' =>esc_html__( 'ElementsKit Header Footer', 'wordpresspioneers' ),
                'icon' => 'fa fa-plug',
            ],
            1
        );
	}
}

// Instantiate Plugin Class
Widget_Loader::instance();



