<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Product_Categories extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-product-categories';
    }
	
	public function get_title(){
        return esc_html__( 'TS Product Categories', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'woocommerce-elements' );
    }
	
	public function get_icon(){
		return 'eicon-product-categories';
	}
	
	protected function register_controls(){
		$this->start_controls_section(
            'section_general'
            ,array(
                'label' 	=> esc_html__( 'General', 'themesky' )
                ,'tab'   	=> Controls_Manager::TAB_CONTENT
            )
        );
		
		$this->add_lazy_load_controls( array( 'thumb-height' => 120 ) );
		
		$this->add_title_and_style_controls();
		
		$this->add_control(
            'style'
            ,array(
                'label' 		=> esc_html__( 'Style', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'style-default'
				,'options'		=> array(
									'style-default'				=> esc_html__( 'Default', 'themesky' )
									,'category-style-2'		=> esc_html__( 'Style 2', 'themesky' )
									,'category-style-vertical'		=> esc_html__( 'Style Vertical', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'columns'
            ,array(
                'label'     	=> esc_html__( 'Columns', 'themesky' )
                ,'type'     	=> Controls_Manager::NUMBER
				,'default'  	=> 9
				,'min'      	=> 1
				,'condition'	=> array( 'style!' => 'category-style-vertical' )
            )
        );
		
		$this->add_control(
            'limit'
            ,array(
                'label'     	=> esc_html__( 'Limit', 'themesky' )
                ,'type'     	=> Controls_Manager::NUMBER
				,'default'  	=> 9
				,'min'      	=> 1
            )
        );

		$this->add_control(
            'first_level'
            ,array(
                'label' 		=> esc_html__( 'Only display the first level', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'parent'
            ,array(
                'label' 		=> esc_html__( 'Parent', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'taxonomy'
					,'name'		=> 'product_cat'
				)
				,'multiple' 	=> false
				,'sortable' 	=> false
				,'label_block' 	=> true
				,'description' 	=> esc_html__( 'Get direct children of this category', 'themesky' )
				,'condition'	=> array( 'first_level' => '0' )
            )
        );
		
		$this->add_control(
            'child_of'
            ,array(
                'label' 		=> esc_html__( 'Child of', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'taxonomy'
					,'name'		=> 'product_cat'
				)
				,'multiple' 	=> false
				,'sortable' 	=> false
				,'label_block' 	=> true
				,'description' 	=> esc_html__( 'Get all descendents of this category', 'themesky' )
				,'condition'	=> array( 'first_level' => '0' )
            )
        );
		
		$this->add_control(
            'ids'
            ,array(
                'label' 		=> esc_html__( 'Specific categories', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'taxonomy'
					,'name'		=> 'product_cat'
				)
				,'multiple' 	=> true
				,'label_block' 	=> true
            )
        );
		
		$this->add_control(
            'hide_empty'
            ,array(
                'label' 		=> esc_html__( 'Hide empty product categories', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '1'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_title'
            ,array(
                'label' 		=> esc_html__( 'Show product category title', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '1'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_product_count'
            ,array(
                'label' 		=> esc_html__( 'Show product count', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'text_color'
            ,array(
                'label'     	=> esc_html__( 'Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#000000'
				,'selectors'	=> array(
					'{{WRAPPER}} .products .product-category .meta-wrapper' => 'color: {{VALUE}}'
				)
            )
        );
		
		$this->add_control(
            'text_hover_color'
            ,array(
                'label'     	=> esc_html__( 'Text Hover Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#00B412'
				,'selectors'	=> array(
					'{{WRAPPER}} .products .product-category:hover .meta-wrapper' => 'color: {{VALUE}}'
				)
            )
        );
		$this->add_control(
            'background_color'
            ,array(
                'label'     	=> esc_html__( 'Background Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#ffffff'
				,'condition'	=> array( 'style' => array('category-style-2', 'category-style-vertical') )
				,'selectors'	=> array(
					'{{WRAPPER}} .products .product.product-category .product-wrapper' => 'background-color: {{VALUE}}'
				)
            )
        );
		
		$this->end_controls_section();
		
		$this->start_controls_section(
            'section_slider'
            ,array(
                'label' 	=> esc_html__( 'Slider', 'themesky' )
                ,'tab'   	=> Controls_Manager::TAB_CONTENT
            )
        );

		$this->add_control(
            'is_slider'
            ,array(
                'label' 		=> esc_html__( 'Show in a carousel slider', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );

		$this->add_control(
            'only_slider_mobile'
            ,array(
                'label' 		=> esc_html__( 'Only show slider on mobile', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> esc_html__( 'Show Grid on desktop and only enable Slider on mobile', 'themesky' )
            )
        );
		
		$this->add_control(
            'show_nav'
            ,array(
                'label' 		=> esc_html__( 'Show navigation button', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '1'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_dots'
            ,array(
                'label' 		=> esc_html__( 'Show dots navigation', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> esc_html__( 'If enabled, the navigation buttons will be removed', 'themesky' )
            )
        );
		
		$this->add_control(
            'auto_play'
            ,array(
                'label' 		=> esc_html__( 'Auto play', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$default = array(
			'lazy_load'					=> 0
			,'title'					=> ''
			,'style'					=> 'style-default'
			,'is_slider'				=> 0
			,'only_slider_mobile'		=> 0
			,'per_page' 				=> 9
			,'columns' 					=> 9
			,'first_level' 				=> 0
			,'parent' 					=> ''
			,'child_of' 				=> 0
			,'ids'	 					=> ''
			,'hide_empty'				=> 1
			,'show_title'				=> 1
			,'show_product_count'		=> 0
			,'text_color'				=> '#000000'
			,'text_hover_color'			=> '#00B412'
			,'background_color'			=> '#ffffff'
			,'view_shop_button_text'	=> ''
			,'show_nav' 				=> 1
			,'show_dots'				=> 0
			,'auto_play' 				=> 1
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
		
		if ( !class_exists('WooCommerce') ){
			return;
		}
		
		if( $this->lazy_load_placeholder( $settings, 'product-category' ) ){
			return;
		}

		if( $only_slider_mobile && !wp_is_mobile() ){
			$is_slider = false;
		}
		
		if( is_admin() && !wp_doing_ajax() ){ /* WooCommerce does not include hook below in Elementor editor */
			add_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
		}
		
		if( $first_level ){
			$parent = $child_of = 0;
		}
		
		$parent = is_array($parent) ? implode('', $parent) : $parent;
		$child_of = is_array($child_of) ? implode('', $child_of) : $child_of;

		$args = array(
			'taxonomy'	  => 'product_cat'
			,'orderby'    => 'name'
			,'order'      => 'ASC'
			,'hide_empty' => $hide_empty
			,'pad_counts' => true
			,'parent'     => $parent
			,'child_of'   => $child_of
			,'number'     => $limit
		);
		
		if( $ids ){
			$args['include'] = $ids;
			$args['orderby'] = 'include';
		}
		
		if( $style == 'category-style-vertical' ){
			$columns = 1;
		}
		
		$product_categories = get_terms( $args );
		
		$old_woocommerce_loop_columns = wc_get_loop_prop('columns');
		wc_set_loop_prop('columns', $columns);
		
		wc_set_loop_prop( 'is_shortcode', true );

		if( $show_dots ){
			$show_nav = 0;
		}
		
		if( count($product_categories) > 0 ):
			$classes = array();
			$classes[] = 'ts-product-category-wrapper ts-product ts-shortcode woocommerce';
			$classes[] = 'columns-' . $columns;
			$classes[] = $style;
			$classes[] = $is_slider?'ts-slider':'grid';
			if( $is_slider && $show_nav ){
				$classes[] = 'show-nav';
			}
			if( $view_shop_button_text ){
				$classes[] = 'show-button';
			}
			if( $show_dots ){
				$classes[] = 'show-dots';
			}
			
		
			$data_attr = array();
			if( $is_slider ){
				$data_attr[] = 'data-nav="'.$show_nav.'"';
				$data_attr[] = 'data-dots="'.$show_dots.'"';
				$data_attr[] = 'data-autoplay="'.$auto_play.'"';
				$data_attr[] = 'data-columns="'.$columns.'"';
			}
		?>
			<div class="<?php echo esc_attr(implode(' ', $classes)) ?>" <?php echo implode(' ', $data_attr); ?>>
			
				<?php if( $title ): ?>
				<header class="shortcode-heading-wrapper">
					<h2 class="shortcode-title">
						<?php echo esc_html($title); ?>
					</h2>
				</header>
				<?php endif; ?>
				
				<div class="content-wrapper <?php echo $is_slider?'loading':''; ?>">
					<?php 
					woocommerce_product_loop_start();
					foreach ( $product_categories as $category ) {
						wc_get_template( 'content-product-cat.php', array(
							'category' 					=> $category
							,'show_title' 				=> $show_title
							,'show_product_count' 		=> $show_product_count
							,'view_shop_button_text' 	=> $view_shop_button_text
						) );
					}
					woocommerce_product_loop_end();
					?>
				</div>
			</div>
		<?php
		endif;
		
		wc_set_loop_prop('columns', $old_woocommerce_loop_columns);
		
		wc_set_loop_prop( 'is_shortcode', false );
	}
	
	function category_icon( $category ){
		$icon_id = get_term_meta($category->term_id, 'icon_id', true);
		if( $icon_id ){
			echo wp_get_attachment_image( $icon_id );
		}
		else{
			echo wc_placeholder_img();
		}
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Product_Categories() );