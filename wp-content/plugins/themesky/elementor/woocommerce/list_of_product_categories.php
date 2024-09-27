<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_List_Of_Product_Categories extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-list-of-product-categories';
    }
	
	public function get_title(){
        return esc_html__( 'TS List Of Product Categories', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'woocommerce-elements' );
    }
	
	public function get_icon(){
		return 'eicon-editor-list-ul';
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
            'style'
            ,array(
                'label' 		=> esc_html__( 'Style', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'style-default'
				,'options'		=> array(
									'style-default' 			=> esc_html__('Style Default', 'themesky')
									,'style-horizontal' 		=> esc_html__('Style Horizontal', 'themesky')
								)		
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'title'
            ,array(
                'label'     	=> esc_html__( 'Title', 'themesky' )
                ,'type'     	=> Controls_Manager::TEXT
				,'default'  	=> ''
            )
        );
		
		$this->add_control(
            'limit'
            ,array(
                'label'     	=> esc_html__( 'Limit', 'themesky' )
                ,'type'     	=> Controls_Manager::NUMBER
				,'default'  	=> 12
				,'min'      	=> 1
            )
        );
		
		$this->add_control(
            'columns'
            ,array(
                'label' 		=> esc_html__( 'Columns', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '2'
				,'options'		=> array(
									'1'		=> '1'
									,'2'	=> '2'
									,'3'	=> '3'
									,'4'	=> '4'
								)			
                ,'description' 	=> ''
				,'condition'		=> array( 'style' => 'style-default' )
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
				,'description' 	=> esc_html__( 'Get children of this category', 'themesky' )
            )
        );
		
		$this->add_control(
            'direct_child'
            ,array(
                'label' 		=> esc_html__( 'Direct Children', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '1'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> esc_html__( 'Get direct children of Parent or all children', 'themesky' )
            )
        );
		
		$this->add_control(
            'include_parent'
            ,array(
                'label' 		=> esc_html__( 'Include parent', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '1'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> esc_html__( 'Show parent category at the first of list', 'themesky' )
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
            'text_color'
            ,array(
                'label'     	=> esc_html__( 'Text Color', 'themesky' )
                ,'type'     	=> Controls_Manager::COLOR
				,'default'  	=> '#000000'
				,'selectors'	=> array(
					'{{WRAPPER}} .list-categories ul li a, {{WRAPPER}} .heading-title' => 'color: {{VALUE}}'
				)
            )
        );		

		$this->add_control(
            'show_shop_more_button'
            ,array(
                'label' 		=> esc_html__( 'Show shop more button', 'themesky' )
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
			'shop_more_button_link'
			,array(	
				'label'		 		=> esc_html__( 'Shop more button link', 'themesky' )
				,'type'				=> Controls_Manager::URL
				,'default'			=> array( 'url'	=> '', 'is_external' => true, 'nofollow' => true )
				,'show_external' 	=> true
				,'condition'		=> array( 'show_shop_more_button' => '1' )
			)
		);
		
		$this->add_control(
            'shop_more_button_text'
            ,array(
                'label' 		=> esc_html__( 'Shop more button label', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> 'Shop more'		
                ,'description' 	=> ''
				,'condition'	=> array( 'show_shop_more_button' => '1' )
            )
        );
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$default = array(
			'title' 						=> ''
			,'style'						=> 'style-default'
			,'limit'						=> 12
			,'columns'						=> 2
			,'parent'						=> array()
			,'direct_child'					=> 1
			,'include_parent'				=> 1
			,'ids'							=> array()
			,'hide_empty'					=> 1
			,'text_color'					=> '#000000'
			,'show_shop_more_button'		=> 0
			,'shop_more_button_link'		=> array( 'url' => '', 'is_external' => true, 'nofollow' => true )
			,'shop_more_button_text' 		=> 'Shop more'
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
		
		if( !class_exists('WooCommerce') ){
			return;
		}

		$link_attr = $this->generate_link_attributes( $shop_more_button_link );
		
		if( is_array($parent) ){
			$parent = implode( '', $parent );
		}
		
		if( $parent && $include_parent ){
			$limit = absint($limit) - 1;
		}
		
		$args = array(
			'taxonomy'		=> 'product_cat'
			,'hide_empty'	=> $hide_empty
			,'number'		=> $limit
		);
		
		if( $parent ){
			if( $direct_child ){
				$args['parent'] = $parent;
			}
			else{
				$args['child_of'] = $parent;
			}
		}
		
		if( $ids ){
			$args['include'] = $ids;
			$args['orderby'] = 'include';
		}
		
		$list_categories = get_terms( $args );
		
		if( !is_array($list_categories) || empty($list_categories) ){
			return;
		}
		
		$classes = array( 'ts-list-of-product-categories-wrapper' );
		$classes[] = 'columns-' . $columns;
		$classes[] = $style;
		if( $show_shop_more_button ){
			$classes[] = 'has-shop-more-button';
		}
		else{
			$classes[] = 'no-shop-more-button';
		}

		?>
		<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>">
			<?php if( $title ): ?>		
			<h3 class="heading-title">
				<?php echo esc_html($title) ?>
			</h3>
			<?php endif; ?>
			
			<div class="list-categories">
				<ul>
					<?php 
					if( $parent && $include_parent ){
						$parent_obj = get_term($parent, 'product_cat');
						if( isset($parent_obj->name) ){
					?>
						<li><a href="<?php echo get_term_link($parent_obj, 'product_cat'); ?>"><?php echo esc_html($parent_obj->name); ?></a></li>
					<?php
						}
					}
					?>
					
					<?php foreach( $list_categories as $category ){ ?>
					<li><a href="<?php echo get_term_link($category, 'product_cat'); ?>"><?php echo esc_html($category->name); ?></a></li>
					<?php } ?>
					<?php if( $show_shop_more_button ){ ?>
					<li> 
						<div class="shop-more">
							<a class="button button-text shop-more-button" <?php echo implode( ' ', $link_attr ); ?>><?php echo esc_html($shop_more_button_text) ?></a>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php
	}
}

$widgets_manager->register( new TS_Elementor_Widget_List_Of_Product_Categories() );