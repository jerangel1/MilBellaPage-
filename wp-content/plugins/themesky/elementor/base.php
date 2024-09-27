<?php
use Elementor\Controls_Manager;

abstract class TS_Elementor_Widget_Base extends Elementor\Widget_Base{
	public function get_name(){
        return 'ts-base';
    }
	
	public function get_title(){
        return esc_html__( 'ThemeSky Base', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements' );
    }
	
	/* key|value,key|value => return array */
	public function parse_link_custom_attributes( $custom_attributes ){
		if( !$custom_attributes ){
			return array();
		}
		
		$attributes = array();
		
		$custom_attributes = str_replace(' ', '', $custom_attributes);
		
		$custom_attributes = explode(',', $custom_attributes);
		foreach( $custom_attributes as $custom_attribute ){
			$attr = explode('|', $custom_attribute);
			if( count($attr) == 2 ){
				$attributes[] = $attr;
			}
		}
		
		return $attributes;
	}
	
	public function generate_link_attributes( $link ){
		if( !$link ){
			return array();
		}

		$link_attr = array();
		
		if( $link['url'] ){
			$link_attr[] = 'href="' . esc_url($link['url']) . '"';
			$link_attr[] = $link['is_external'] ? 'target="_blank"' : '';
			$link_attr[] = $link['nofollow'] ? 'rel="nofollow"' : '';
			
			if( !empty($link['custom_attributes']) ){
				$link_custom_attributes = $this->parse_link_custom_attributes( $link['custom_attributes'] );
				foreach( $link_custom_attributes as $attr ){
					$link_attr[] = $attr[0] . '="' . esc_attr($attr[1]) . '"';
				}
			}
		}
		
		return $link_attr;
	}
	
	public function get_custom_taxonomy_options( $tax = '' ){
		if( !$tax ){
			return;
		}
		
		$terms = get_terms( array(
				'taxonomy'		=> $tax
				,'hide_empty'	=> false
				,'fields'		=> 'id=>name'
			) );
			
		return is_array($terms) ? $terms : array();
	}
	
	public function get_custom_post_options( $post_type = 'post' ){
		$args = array(
				'post_type'				=> $post_type
				,'post_status'			=> 'publish'
				,'posts_per_page'		=> -1
			);
			
		$posts = array();
		
		$query_obj = new WP_Query($args);
		if( $query_obj->have_posts() ){
			foreach( $query_obj->posts as $p ){
				$posts[$p->ID] = $p->post_title;
			}
		}
		
		return $posts;
	}
	
	public function add_lazy_load_controls( $args = array() ){
		$this->add_control(
            'lazy_load'
            ,array(
                'label' 		=> esc_html__( 'Lazy Load', 'themesky' )
                ,'type' 		=> Controls_Manager::SWITCHER
                ,'default' 		=> '0'
				,'return_value' => '1'			
                ,'description' 	=> esc_html__( 'Show placeholder and only load content when users scroll down', 'themesky' )
            )
        );
		
		$this->add_responsive_control(
			'lazy_load_thumb_height'
			,array(
				'label' 		=> isset( $args['thumb-label'] ) ? $args['thumb-label'] : esc_html__( 'Lazy Load - Thumbnail Height', 'themesky' )
				,'type' 		=> Controls_Manager::NUMBER
				,'default'		=> isset( $args['thumb-height'] ) ? $args['thumb-height'] : 300
				,'selectors' 	=> array(
					'{{WRAPPER}} .ts-elementor-lazy-load' => '--lazy-thumb-height: {{VALUE}}px'
				)
				,'separator'	=> 'after'
				,'condition' 	=> array( 'lazy_load' => '1' )
			)
		);
	}
	
	public function add_title_and_style_controls(){
		$this->add_control(
            'title'
            ,array(
                'label' 		=> esc_html__( 'Title', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> ''		
                ,'description' 	=> ''
            )
        );
	}
	
	public function add_product_meta_controls(){
		$this->add_control(
            'show_image'
            ,array(
                'label' 		=> esc_html__( 'Show product image', 'themesky' )
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
                'label' 		=> esc_html__( 'Show product name', 'themesky' )
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
            'show_sku'
            ,array(
                'label' 		=> esc_html__( 'Show product SKU', 'themesky' )
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
            'show_price'
            ,array(
                'label' 		=> esc_html__( 'Show product price', 'themesky' )
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
            'show_short_desc'
            ,array(
                'label' 		=> esc_html__( 'Show product short description', 'themesky' )
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
            'show_rating'
            ,array(
                'label' 		=> esc_html__( 'Show product rating', 'themesky' )
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
            'show_label'
            ,array(
                'label' 		=> esc_html__( 'Show product label', 'themesky' )
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
            'show_categories'
            ,array(
                'label' 		=> esc_html__( 'Show product categories', 'themesky' )
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
            'show_brands'
            ,array(
                'label' 		=> esc_html__( 'Show product brands', 'themesky' )
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
            'show_add_to_cart'
            ,array(
                'label' 		=> esc_html__( 'Show add to cart button', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '1'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
	}
	
	public function add_product_color_swatch_controls(){
		$this->add_control(
            'show_color_swatch'
            ,array(
                'label' 		=> esc_html__( 'Show color swatches', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> esc_html__( 'Show the color attribute of variations. The slug of the color attribute has to be "color"', 'themesky' )
            )
        );
		
		$this->add_control(
            'number_color_swatch'
            ,array(
                'label' 		=> esc_html__( 'Number of color swatches', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '3'
				,'options'		=> array(
									'2'		=> '2'
									,'3'	=> '3'
									,'4'	=> '4'
									,'5'	=> '5'
									,'6'	=> '6'
								)			
                ,'description' 	=> ''
                ,'condition' 	=> array( 'show_color_swatch' => '1' )
            )
        );
	}
	
	public function lazy_load_placeholder( $settings = array(), $type = 'product' ){
		if( !empty($settings['lazy_load']) && !wp_doing_ajax() && !( \Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode() ) ){
			$global_classes = array();
			
			$global_classes[] = 'type-' . $type;
			$global_classes[] = isset($settings['title_style']) ? $settings['title_style'] : '';
			
			if( $type == 'product-tabs' && isset($settings['style']) ){
				$global_classes[] = $settings['style'];
			}
			?>
			<div class="ts-elementor-lazy-load <?php echo esc_attr( implode(' ', $global_classes) ); ?>">
			<?php
				$title 				= isset($settings['title']) ? $settings['title'] : '';
				
				$is_slider 			= !empty($settings['is_slider']) || $type == 'product-brand' || ( isset( $settings['layout'] ) && $settings['layout'] == 'slider' );
				$only_slider_mobile = !empty($settings['only_slider_mobile']);
				if( $only_slider_mobile && !wp_is_mobile() ){
					$is_slider = false;
				}
				
				$columns 	= isset($settings['columns']) ? absint( $settings['columns'] ) : 5;
				$rows 		= isset($settings['rows']) && !wp_is_mobile() ? absint( $settings['rows'] ) : 1;
				$limit 		= isset($settings['limit']) ? absint( $settings['limit'] ) : 5;
				
				if( $is_slider ){
					$count = min( $columns * $rows, $limit );
				}
				else{
					$count = min( $limit, $columns * 2 ); /* show max 2 rows */
				}
				
				$classes = array();
				$classes[] = 'columns-' . $columns;
				if( $is_slider ){
					$classes[] = 'is-slider';
				}
				
				if( ( $type == 'testimonial' || $type == 'product' || $type == 'product-category' ) && isset($settings['style']) ){
					$classes[] = $settings['style'];
				}
				
				if( $title ){
				?>
				<div class="placeholder-widget-title"></div>
				<?php
				}
				
				if( $type == 'product-tabs' ){
				?>
				<div class="placeholder-tabs">
					<div class="placeholder-tab-item"></div>
					<div class="placeholder-tab-item"></div>
				</div>
				<?php
				
					if( isset($settings['style']) && $settings['style'] == 'style-tabs-vertical-banner' && !empty($settings['banners']) ){
					?>
						<div class="placeholder-banner"></div>
					<?php
					}
				}
				?>
				
				<div class="placeholder-items <?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="--lazy-cols: <?php echo esc_attr( $columns ); ?>">
				<?php for( $i = 1; $i <= $count; $i++ ){ ?>
					<div class="placeholder-item">
						<div class="placeholder-thumb"></div>
						<?php if( $type != 'logo' && $type != 'product-brand' ){ ?>
							<div class="placeholder-title"></div>
							<?php if( $type != 'product-category' ){ ?>
								<div class="placeholder-subtitle"></div>
							<?php } ?>
						<?php } ?>
					</div>
				<?php } ?>
				</div>
			</div>
			<?php
			
			return true;
		}
		return false;
	}
}