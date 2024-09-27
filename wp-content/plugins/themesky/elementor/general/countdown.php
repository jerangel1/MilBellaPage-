<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Countdown extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-countdown';
    }
	
	public function get_title(){
        return esc_html__( 'TS Countdown', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'general' );
    }
	
	public function get_icon(){
		return 'eicon-countdown';
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
            'date'
            ,array(
                'label' 			=> esc_html__( 'Date', 'themesky' )
                ,'type' 			=> Controls_Manager::DATE_TIME
                ,'default' 			=> date( 'Y-m-d', strtotime('+1 day') )
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
									,'text-center'	=> esc_html__( 'Center', 'themesky' )
									,'text-right'	=> esc_html__( 'Right', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'color_style'
            ,array(
                'label' 		=> esc_html__( 'Color Style', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'default'
				,'options'		=> array(
									'default'		=> esc_html__( 'Default', 'themesky' )
									,'custom'	=> esc_html__( 'Custom', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'background_color'
            ,array(
                'label'     	=> esc_html__( 'Background Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#ff6e00'
				,'selectors'	=> array(
					'{{WRAPPER}} .counter-wrapper > div' => 'background: {{VALUE}}'
					,'{{WRAPPER}} .counter-wrapper > span' => 'color: {{VALUE}}'
				)
				,'condition'	=> array( 'color_style' => 'custom' )
            )
        );
		
		$this->add_control(
            'text_color'
            ,array(
                'label'     	=> esc_html__( 'Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#ffffff'
				,'selectors'	=> array(
					'{{WRAPPER}} .counter-wrapper > div' => 'color: {{VALUE}}'
				)
				,'condition'	=> array( 'color_style' => 'custom' )
            )
        );
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		if( empty($settings['date']) ){
			return;
		}
		
		$time = strtotime($settings['date']);
		
		if( $time === false ){
			return;
		}
		
		$current_time = current_time('timestamp');
		
		if( $time < $current_time ){
			return;
		}
		
		$settings['seconds'] = $time - $current_time;
		
		ts_countdown( $settings );
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Countdown() );