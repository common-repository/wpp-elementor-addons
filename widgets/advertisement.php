<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Wppee_Advertisement extends Widget_Base{
	
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		
		//wp_register_style( 'mywidgetcssforcdcover', plugins_url('/index_files/autoptimize_590b61ea9e4ae67bca6fd4b7c3676682.css') );
		
		//wp_register_style( 'mycdcovercss', plugins_url( '/index_files/autoptimize_590b61ea9e4ae67bca6fd4b7c3676682.css' ), array(), '1.0.0' );
	}
	

  public function get_name(){
    return 'advertisement';
  }

  public function get_title(){
    return 'Animated CD & Cover';
  }

  public function get_icon(){
    return 'fa fa-dot-circle';
  }

  public function get_categories(){
    return ['wppallelements'];
  }
  

  protected function _register_controls(){

    $this->start_controls_section(
      'section_content',
      [
        'label' => 'Settings',
      ]
    );

    $this->add_control(
      'label_heading',
      [
        'label' => 'Label Heading',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'My Example Heading'
      ]
    );
	
	$this->add_control(
			'content_link',
			[
				'label' => __( 'Link', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( '#', 'wordpresspioneers' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

    /*$this->add_control(
      'content_link',
      [
        'label' => 'Link',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '#'
      ]
    );*/
	
	$this->add_control(
			'cd_cover',
			[
				'label' => __( 'Choose Image', 'wordpresspioneers' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

    /*$this->add_control(
      'content',
      [
        'label' => 'Content',
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => 'Some example content. Start Editing Here.'
      ]
    );*/

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

    ?>
    
    
    <div id="index-91511" data-post-type="release" data-params="" class="clearfix items wvc-element wolf-core-element entry-grid-loading release-items releases caption-text-align-center caption-valign-middle grid-padding-yes display-animated_cover release-display-animated_cover module-grid release-module-grid items-thumbnail-size-square layout-standard release-layout-standard pagination-none grid hover-effect-simple release-hover-effect-simple">
      <article id="post-5743" class="post-5743 release type-release status-publish has-post-thumbnail hentry band-irene-blake entry clearfix entry-grid entry-columns-3 entry-release-module-layout-standard thumbnail-color-tone-dark is-single-audio entry-release entry-animated_cover entry-release-animated_cover" data-post-id="5743" itemscope="" itemtype="https://schema.org/MusicAlbum"><a href="<?php echo esc_url($settings['content_link']['url']); ?>" class="internal-link">
        <div class="wvc-album-disc wvc-album-disc-align-left wvc-album-disc-cd wvc-album-disc-worn-border-yes wvc-album-disc-rotate-hover wvc-element" style="">
          <div class="wvc-album-disc-cover-container">
            <div class="wvc-album-disc-disc-container wow wvc-album-disc-reveal animated" style="transition-delay: 0.4s; visibility: visible;">
              <div class="wvc-album-disc-disc-inner" style="animation-duration:10s;"><img class="wvc-album-disc-disc-img " src="<?php echo esc_url($settings['cd_cover']['url']); ?>" alt="<?php echo esc_attr($settings['label_heading']); ?>" title="<?php echo esc_attr($settings['label_heading']); ?>" width="415" height="415">
                <div class="wvc-album-disc-disc-text"></div>
                <div class="wvc-album-disc-disc-hole"></div>
              </div>
            </div>
            <div class="wvc-album-disc-cover-inner"><img class="wvc-album-disc-cover-img " src="<?php echo esc_url($settings['cd_cover']['url']); ?>" alt="<?php echo esc_attr($settings['label_heading']); ?>" title="<?php echo esc_attr($settings['label_heading']); ?>" width="More Videos415" height="415">
              <div class="wvc-album-disc-cover-border"></div>
            </div>
          </div>
        </div>
        </a></article>
    </div>
    
    <?php
	
	
  }

  protected function _content_template(){
	  
	  
	  
    ?>
    <#
        view.addInlineEditingAttributes( 'label_heading', 'basic' );
    view.addRenderAttribute(
        'label_heading',
        {
            'class': [ 'advertisement__label-heading' ],
        }
    );
        #>    
    
    <div id="index-91511" data-post-type="release" data-params="" class="clearfix items wvc-element wolf-core-element entry-grid-loading release-items releases caption-text-align-center caption-valign-middle grid-padding-yes display-animated_cover release-display-animated_cover module-grid release-module-grid items-thumbnail-size-square layout-standard release-layout-standard pagination-none grid hover-effect-simple release-hover-effect-simple">
      <article id="post-5743" class="post-5743 release type-release status-publish has-post-thumbnail hentry band-irene-blake entry clearfix entry-grid entry-columns-3 entry-release-module-layout-standard thumbnail-color-tone-dark is-single-audio entry-release entry-animated_cover entry-release-animated_cover" data-post-id="5743" itemscope="" itemtype="https://schema.org/MusicAlbum"><a href="{{{ settings.content_link.url }}}" class="internal-link">
        <div class="wvc-album-disc wvc-album-disc-align-left wvc-album-disc-cd wvc-album-disc-worn-border-yes wvc-album-disc-rotate-hover wvc-element" style="">
          <div class="wvc-album-disc-cover-container">
            <div class="wvc-album-disc-disc-container wow wvc-album-disc-reveal animated" style="transition-delay: 0.4s; visibility: visible;">
              <div class="wvc-album-disc-disc-inner" style="animation-duration:10s;"><img class="wvc-album-disc-disc-img " src="{{ settings.cd_cover.url }}" alt="{{ settings.label_heading }}" title="{{ settings.label_heading }}" width="415" height="415">
                <div class="wvc-album-disc-disc-text"></div>
                <div class="wvc-album-disc-disc-hole"></div>
              </div>
            </div>
            <div class="wvc-album-disc-cover-inner"><img class="wvc-album-disc-cover-img " src="{{ settings.cd_cover.url }}" alt="{{ settings.label_heading }}" title="{{ settings.label_heading }}" width="More Videos415" height="415">
              <div class="wvc-album-disc-cover-border"></div>
            </div>
          </div>
        </div>
        </a></article>
    </div>
    
    <?php
		
  }
}