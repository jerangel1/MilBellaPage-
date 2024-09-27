<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Banner_2 extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-banner-2';
    }
	
	public function get_title(){
        return esc_html__( 'TS Banner 2', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'general' );
    }
	
	public function get_icon(){
		return 'eicon-image-bold';
	}
	
	protected function register_controls(){
		$this->start_controls_section(
            'section_general'
            ,array(
                'label' 	=> esc_html__( 'General', 'themesky' )
                ,'tab'   	=> Controls_Manager::TAB_CONTENT
            )
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
            'img_text'
            ,array(
                'label' 		=> esc_html__( 'Image Text', 'themesky' )
                ,'type' 		=> Controls_Manager::MEDIA
                ,'default' 		=> array( 'id' => '', 'url' => '' )		
                ,'description' 	=> esc_html__( 'Display this image over the main image', 'themesky' )
            )
        );
		
		$this->add_control(
            'img_text_position'
            ,array(
                'label' 		=> esc_html__( 'Image Text Position', 'themesky' )
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
            'link'
            ,array(
                'label'     	=> esc_html__( 'Link', 'themesky' )
                ,'type'     	=> Controls_Manager::URL
				,'default'  	=> array( 'url' => '', 'is_external' => true, 'nofollow' => true )
				,'show_external'=> true
            )
        );
		
		$this->add_control(
            'style_effect'
            ,array(
                'label' 		=> esc_html__( 'Hover Effect', 'themesky' )
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
			'img_bg'				=> array( 'id' => '', 'url' => '' )
			,'img_text'				=> array( 'id' => '', 'url' => '' )
			,'img_text_position'	=> 'left-top'
			,'link' 				=> array( 'url' => '', 'is_external' => true, 'nofollow' => true )
			,'style_effect'			=> 'eff-zoom-in'
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
		
		$link_attr = $this->generate_link_attributes( $link );
		?>
		<div class="ts-banner-image <?php echo esc_attr($style_effect) ?> <?php echo esc_attr($img_text_position) ?>">
			<a class="image-link" <?php echo implode(' ', $link_attr); ?>>
				<?php
				echo wp_get_attachment_image($img_bg['id'], 'full', 0, array('class'=>'img bg-image'));
				
				echo wp_get_attachment_image($img_text['id'], 'full', 0, array('class'=>'img text-image'));
				?>
			</a>
		</div>
		<?php
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Banner_2() );