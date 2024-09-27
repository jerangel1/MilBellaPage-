<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Banner extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-banner';
    }
	
	public function get_title(){
        return esc_html__( 'TS Banner', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'general' );
    }
	
	public function get_icon(){
		return 'eicon-image';
	}
	
	protected function register_controls(){
		$this->start_controls_section(
            'section_general'
            ,array(
                'label' 	=> esc_html__( 'General', 'themesky' )
                ,'tab'   	=> Controls_Manager::TAB_CONTENT
            )
        );
				
		$this->add_responsive_control(
			'banner_min_height',
			[
				'label' => __( 'Banner Min Height(px)', 'themesky' )
				,'type' => Controls_Manager::SLIDER
				,'range' => [
					'px' => [
						'min' => 0
						,'max' => 1000
					]
				]
				,'devices' => [ 'desktop', 'tablet', 'mobile' ]
				,'desktop_default' => [
					'size' => 0
					,'unit' => 'px'
				]
				,'tablet_default' => [
					'size' => 0
					,'unit' => 'px'
				]
				,'mobile_default' => [
					'size' => 0
					,'unit' => 'px'
				]
				,'selectors' => [
					'{{WRAPPER}} .banner-bg img' => 'min-height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		
		$this->add_control(
            'img_bg'
            ,array(
                'label' 		=> esc_html__( 'Background Image', 'themesky' )
                ,'type' 		=> Controls_Manager::MEDIA
                ,'default' 		=> array( 'id' => '', 'url' => '' )		
                ,'description' 	=> ''
            )
        );

		$this->add_control(
            'banner_text'
            ,array(
                'label' 		=> esc_html__( 'Banner Text', 'themesky' )
                ,'type' 		=> Controls_Manager::WYSIWYG
                ,'default' 		=> ''		
                ,'description' 	=> ''
            )
        );
		
		$this->add_responsive_control(
			'banner_text_size',
			[
				'label' => __( 'Font Size Banner Text(px)', 'themesky' )
				,'type' => Controls_Manager::SLIDER
				,'range' => [
					'px' => [
						'min' => 0
						,'max' => 100
					]
				]
				,'devices' => [ 'desktop', 'tablet', 'mobile' ]
				,'desktop_default' => [
					'size' => 14
					,'unit' => 'px'
				]
				,'tablet_default' => [
					'size' => 14
					,'unit' => 'px'
				]
				,'mobile_default' => [
					'size' => 14
					,'unit' => 'px'
				]
				,'selectors' => [
					'{{WRAPPER}} .box-content div.banner-text' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);
		
		$this->add_control(
            'text_position'
            ,array(
                'label' 		=> esc_html__( 'Banner Text Position', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'left-top'
				,'options'		=> array(
									'left-top'			=> esc_html__( 'Left Top', 'themesky' )
									,'left-bottom'		=> esc_html__( 'Left Bottom', 'themesky' )
									,'left-center'		=> esc_html__( 'Left Center', 'themesky' )
									,'right-top'		=> esc_html__( 'Right Top', 'themesky' )
									,'right-bottom'		=> esc_html__( 'Right Bottom', 'themesky' )
									,'right-center'		=> esc_html__( 'Right Center', 'themesky' )
									,'center-top'		=> esc_html__( 'Center Top', 'themesky' )
									,'center-bottom'	=> esc_html__( 'Center Bottom', 'themesky' )
									,'center-center'	=> esc_html__( 'Center Center', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'text_align'
            ,array(
                'label' 		=> esc_html__( 'Text Align', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'text-left'
				,'options'		=> array(
									'text-left'		=> esc_html__( 'Left', 'themesky' )
									,'text-right'	=> esc_html__( 'Right', 'themesky' )
								)			
                ,'description' 	=> ''
				,'condition'	=> array( 'text_position' => array( 'left-top', 'right-top', 'left-center', 'right-center', 'left-bottom', 'right-bottom' ) )
            )
        );
		
		$this->add_control(
            'text_color'
            ,array(
                'label'     	=> esc_html__( 'Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#ffffff'
				,'selectors'	=> array(
					'{{WRAPPER}} .box-content .banner-text, {{WRAPPER}} .button-text .ts-banner-button a' => 'color: {{VALUE}}'
				)
            )
        );		

		$this->add_control(
            'link'
            ,array(
                'label'     	=> esc_html__( 'Link', 'themesky' )
                ,'type'     	=> Controls_Manager::URL
				,'default'  	=> array( 'url' => '', 'is_external' => true, 'nofollow' => true )
				,'show_external'=> true
            )
        );
		
		$this->add_control(
            'button_style'
            ,array(
                'label' 		=> esc_html__( 'Button Style', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'nobtn'
				,'options'		=> array(
									'nobtn'					=> esc_html__( 'Hide Button', 'themesky' )
									,'button-default'		=> esc_html__( 'Button Default', 'themesky' )
									,'button-text'			=> esc_html__( 'Button Text', 'themesky' )
									
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'button_text'
            ,array(
                'label' 		=> esc_html__( 'Button Text', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> 'Shop Now'		
                ,'description' 	=> ''
				,'condition'	=> array( 'button_style' => array( 'button-default', 'button-text' ) )
            )
        );
		
		$this->add_responsive_control(
			'button_size',
			[
				'label' => __( 'Font Size Button', 'themesky' )
				,'type' => Controls_Manager::SLIDER
				,'condition'	=> array( 'button_style' => array( 'button-default', 'button-text' ) )
				,'range' => [
					'px' => [
						'min' => 0
						,'max' => 100
					]
				]
				,'devices' => [ 'desktop', 'tablet', 'mobile' ]
				,'desktop_default' => [
					'size' => 14
					,'unit' => 'px'
				]
				,'tablet_default' => [
					'size' => 14
					,'unit' => 'px'
				]
				,'mobile_default' => [
					'size' => 14
					,'unit' => 'px'
				]
				,'selectors' => [
					'{{WRAPPER}} .box-content .ts-banner-button .button' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);
		
		$this->add_control(
            'button_background_color'
            ,array(
                'label'     	=> esc_html__( 'Button Background Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#00B412'
				,'selectors'	=> array(
					'{{WRAPPER}} .button' => 'background-color: {{VALUE}}'
				)
				,'condition'	=> array( 'button_style' => 'button-default' )
            )
        );
		
		$this->add_control(
            'button_text_color'
            ,array(
                'label'     	=> esc_html__( 'Button Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#ffffff'
				,'selectors'	=> array(
					'{{WRAPPER}} .button' => 'color: {{VALUE}}'
				)
				,'condition'	=> array( 'button_style' => 'button-default' )
            )
        );
		
		$this->add_control(
            'button_background_color_hover'
            ,array(
                'label'     	=> esc_html__( 'Button Background Color Hover', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#ffffff'
				,'selectors'	=> array(
					'{{WRAPPER}} .button:hover' => 'background-color: {{VALUE}}'
				)
				,'condition'	=> array( 'button_style' => 'button-default' )
            )
        );
		
		$this->add_control(
            'button_text_color_hover'
            ,array(
                'label'     	=> esc_html__( 'Button Text Color Hover', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#00B412'
				,'selectors'	=> array(
					'{{WRAPPER}} .button:hover' => 'color: {{VALUE}}'
				)
				,'condition'	=> array( 'button_style' => 'button-default' )
            )
        );

		$this->add_control(
            'style_effect'
            ,array(
                'label' 		=> esc_html__( 'Style Effect', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'eff-zoom-in'
				,'options'		=> array(									
									'eff-zoom-in'				=> esc_html__('Zoom In', 'themesky')
									,'eff-zoom-out' 			=> esc_html__('Zoom Out', 'themesky')
									,'eff-zoom-rotate' 			=> esc_html__('Rotate and zoom in', 'themesky')
									,'eff-flash' 				=> esc_html__('Flash', 'themesky')
									,'eff-line' 				=> esc_html__('Line', 'themesky')
									,'no-effect' 				=> esc_html__('None', 'themesky')
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$default = array(
			'img_bg'							=> array( 'id' => '', 'url' => '' )
			,'banner_min_height'				=> '0'
			,'banner_text'						=> ''
			,'banner_text_size'					=> '14'
			,'text_color'						=> '#ffffff'
			,'text_align'						=> 'text-left'
			,'text_position'					=> 'left-top'
			,'button_style'						=> 'nobtn'
			,'button_text'						=> 'Shop Now'
			,'button_size'						=> '14'
			,'button_background_color'			=> '#000000'
			,'button_text_color'				=> '#ffffff'
			,'button_background_color_hover'	=> '#ffffff'
			,'button_text_color_hover'			=> '#000000'
			,'link' 							=> array( 'url' => '', 'is_external' => true, 'nofollow' => true )
			,'style_effect'						=> 'eff-zoom-in'
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
		
		$link_attr = $this->generate_link_attributes( $link );
		
		$classes = array();
		$classes[] = $text_align;
		$classes[] = $style_effect;
		$classes[] = $button_style;
		$classes[] = $text_position;
		
		$allowed_html = array(
			'br'		=> array()
			,'del'		=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'ins'		=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'h1'			=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'h2'			=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'h3'			=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'h4'			=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'h5'			=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'h6'			=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'p'			=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'strong'	=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'span'		=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'small'		=> array(
				'class'		=> array()
				,'style'	=> array()
			)
			,'img'		=> array(
				'src'		=> array()
				,'alt'		=> array()
				,'class'	=> array()
				,'width'	=> array()
				,'height'	=> array()
				,'loading'	=> array()
				,'srcset'	=> array()
				,'sizes'	=> array()
			)
			,'div'	=> array(
				'class'		=> array()
				,'style'	=> array()
			)
		);
		?>
		<div class="ts-banner <?php echo esc_attr( implode(' ', $classes) ); ?>">
			<div class="banner-wrapper">
			
				<?php if( $link_attr ): ?>
				<a class="banner-link" <?php echo implode(' ', $link_attr); ?>></a>
				<?php endif;?>
					
				<div class="banner-bg">
					<div class="bg-content">
					<?php echo wp_get_attachment_image($img_bg['id'], 'full', 0, array('class'=>'img')); ?>
					</div>
				</div>
							
				<div class="box-content">
					<div>
					
						<?php if( $banner_text ): ?>				
						<div class="banner-text"><?php echo wp_kses($banner_text, $allowed_html); ?></div>
						<?php endif; ?>
						
						<?php if( $button_text ):?>
						<div class="ts-banner-button">
							<a class="button <?php echo esc_attr($button_style == 'button-text'?'button-text':''); ?>" <?php echo implode(' ', $link_attr); ?>><?php echo esc_attr($button_text) ?></a>
						</div>
						<?php endif; ?>
						
					</div>
				</div>
				
			</div>
		</div>
		<?php
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Banner() );