<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Portfolios extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-portfolios';
    }
	
	public function get_title(){
        return esc_html__( 'TS Portfolios', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'general' );
    }
	
	public function get_icon(){
		return 'eicon-gallery-masonry';
	}
	
	public function get_script_depends(){
		if( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ){
			return array('isotope', 'justified-gallery');
		}
		return array();
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
			'layouts'
			,array(
				'label'	=> esc_html__( 'Layouts', 'themesky' )
				,'type'			=> Controls_Manager::SELECT
				,'default'		=> 'masonry'
				,'options'		=> array(
									'masonry' 				=> esc_html__( 'Masonry', 'themesky' )
									,'justified_gallery' 	=> esc_html__( 'Justified Gallery', 'themesky' )
									,'slider'				=> esc_html__( 'Slider', 'themesky' ) 
								)
				,'description'	=>	''
			)
		);
		
		$this->add_control(
            'columns'
            ,array(
                'label' 		=> esc_html__( 'Columns', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '3'
				,'options'		=> array(
									'2'		=> '2'
									,'3'	=> '3'
									,'4'	=> '4'
								)			
                ,'description' 	=> ''
            	,'condition'	=> array(
					'layouts'	=> 'masonry'
				)
			)
        );

		$this->add_control(
			'last_row'
			,array(
				'label'			=> esc_html__( 'Last row', 'themesky' )
				,'type'			=> Controls_Manager::SELECT
				,'default'		=> 'justify'
				,'options'		=> array(
					'left'			=> esc_html__( 'Align left', 'themesky' )
					,'center'		=> esc_html__( 'Align center', 'themesky' )
					,'right'		=> esc_html__( 'Align right', 'themesky' )
					,'justify'		=> esc_html__( 'Justify', 'themesky' )
					,'hide'			=> esc_html__( 'Hide', 'themesky' )
				)
				,'condition'	=> array(
					'layouts'	=>	'justified_gallery'
				)
			)
		);

		$this->add_control(
			'height'
			,array(
				'label'			=> esc_html__( 'Row Height', 'themesky' )
				,'type'			=> Controls_Manager::SLIDER
				,'range'		=> array(
								'px' => array(
									'min'	=> 50
									,'max'	=> 500
								)
				)
				,'default'		=> array(
					'size'	=>	480 
				)
				,'description'	=> esc_html__( 'The preferred rows height in pixel', 'themesky' )
				,'condition'	=> array(
					'layouts'	=> 'justified_gallery'
				)
				,'required' 	=> true
			)
		);

		$this->add_control(
			'margin'
			,array(
				'label'			=> esc_html__( 'Margins', 'themesky' )
				,'type'			=> Controls_Manager::SLIDER
				,'range'		=> array(
					'px'		=>	array(
						'min'	=> 0
						,'max'	=> 100
					)
				)
				,'default'		=> array(
					'size'		=> 0
				)
				,'min'			=> 0
				,'description'	=> esc_html__( 'Decide the margins between the images', 'themesky' )
				,'condition'	=> array(
					'layouts'	=> 'justified_gallery'
				)
				,'required'		=> true
			)
		);

		$this->add_control(
            'title'
            ,array(
                'label' 		=> esc_html__( 'Title', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> ''		
                ,'description' 	=> ''
				,'condition'	=> array(
					'layouts'	=> 'slider'
				)
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
				,'condition'	=> array(
					'layouts'	=> 'slider'
				)
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
				,'condition'	=> array(
					'layouts'	=> 'slider'
				)
            )
        );
		
		
		$this->add_control(
            'limit'
            ,array(
                'label'     	=> esc_html__( 'Limit', 'themesky' )
                ,'type'     	=> Controls_Manager::NUMBER
				,'default'  	=> 9
				,'min'      	=> 1
				,'description' 	=> esc_html__( 'Number of Posts', 'themesky' )
            )
        );
		
		$this->add_control(
            'categories'
            ,array(
                'label' 		=> esc_html__( 'Categories', 'themesky' )
                ,'type' 		=> 'ts_autocomplete'
                ,'default' 		=> array()
				,'options'		=> array()
				,'autocomplete'	=> array(
					'type'		=> 'taxonomy'
					,'name'		=> 'ts_portfolio_cat'
				)
				,'multiple' 	=> true
				,'sortable' 	=> false
				,'label_block' 	=> true
            )
        );
		
		$this->add_control(
            'orderby'
            ,array(
                'label' 		=> esc_html__( 'Order by', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'none'
				,'options'		=> array(
									'none'		=> esc_html__( 'None', 'themesky' )
									,'ID'		=> esc_html__( 'ID', 'themesky' )
									,'date'		=> esc_html__( 'Date', 'themesky' )
									,'name'		=> esc_html__( 'Name', 'themesky' )
									,'title'	=> esc_html__( 'Title', 'themesky' )
								)		
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'order'
            ,array(
                'label' 		=> esc_html__( 'Order', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'DESC'
				,'options'		=> array(
									'DESC'		=> esc_html__( 'Descending', 'themesky' )
									,'ASC'		=> esc_html__( 'Ascending', 'themesky' )
								)		
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_title'
            ,array(
                'label' 		=> esc_html__( 'Show portfolio title', 'themesky' )
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
			'show_author'
			,array(
				'label' 		=> esc_html__( 'Show author', 'themesky' )
				,'type'			=> Controls_Manager::SELECT
				,'default'		=> '1'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)
				,'description'	=> ''
			)
		);
		
		$this->add_control(
            'show_date'
            ,array(
                'label' 		=> esc_html__( 'Show date', 'themesky' )
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
                'label' 		=> esc_html__( 'Show categories', 'themesky' )
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
            'show_like_icon'
            ,array(
                'label' 		=> esc_html__( 'Show like icon', 'themesky' )
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
            'original_image'
            ,array(
                'label' 		=> esc_html__( 'Original image', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> esc_html__( 'Use original image instead of thumbnail', 'themesky' )
            )
        );
		
		$this->add_control(
            'show_filter_bar'
            ,array(
                'label' 		=> esc_html__( 'Show filter bar', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '1'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
				,'condition'	=> array(
					'layouts!'	=> 'slider'
				)
            )
        );
		
		$this->add_control(
			'show_load_more'
			,array(
				'label'			=> esc_html__( 'Load more', 'themesky' )
				,'type'			=> Controls_Manager::SELECT
				,'default'		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'Hide', 'themesky' )
									,'1' 	=> esc_html__( 'Button', 'themesky' )
									,'2'	=> esc_html__( 'Pagination', 'themesky' )
								)
				,'description'	=> ''
				,'condition'	=> array(
					'layouts!'	=> 'slider'
				)
			)
		);
		
		$this->add_control(
            'load_more_text'
            ,array(
                'label' 		=> esc_html__( 'Load more button text', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> 'Load more'		
                ,'description' 	=> ''
				,'condition'	=> array(
									'show_load_more'	=> '1'
								)
            )
        );
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$default = array(
			'title'				=> ''
			,'title_style'		=> 'title-default'
			,'layouts'			=> 'masonry'
			,'columns'			=> 3
			,'last_row'			=> 'justify'
			,'height'			=> array( 'size' => 200 )
			,'margin'			=> array( 'size' => 0 )
			,'limit'			=> 9
			,'categories'		=> array()
			,'orderby'			=> 'none'
			,'order'			=> 'DESC'
			,'show_filter_bar'	=> 1
			,'show_load_more'	=> 1
			,'load_more_text'	=> 'Load more'
			,'show_title'		=> 1
			,'show_author'		=> 1
			,'show_date'		=> 1
			,'show_categories'	=> 1
			,'show_like_icon'	=> 0
			,'original_image'	=> 0
			,'show_nav'			=> 1
			,'auto_play'		=> 0
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
	
		if( $layouts == 'masonry' ){
			wp_enqueue_script( 'isotope' );
		}
		else if( $layouts == 'slider' ){
			$show_filter_bar = 0;
			$show_load_more = 0;
		}
		else{
			wp_enqueue_script( 'justified-gallery' );
		} 
		
		$args = array(
			'post_type'				=> 'ts_portfolio'
			,'posts_per_page'		=> $limit
			,'post_status'			=> 'publish'
			,'orderby'				=> $orderby
			,'order'				=> $order
		);
		
		if( is_array($categories) && count($categories) > 0 ){
			$args['tax_query']	= array(
						array(
							'taxonomy'	=> 'ts_portfolio_cat'
							,'field'	=> 'term_id'
							,'terms'	=> $categories
						)
					);
		}
		
		global $post, $wp_query, $ts_portfolios;
	
		$classes = array( 'ts-portfolio-wrapper ts-shortcode loading' );

		if ( $layouts == 'masonry' ) {
			$classes[] 	= 'ts-masonry';
			$classes[]  = 'columns-' . $columns;
		} 
		else if( $layouts == 'slider' ){
			$classes[] = 'ts-slider';
			$classes[] = $title_style;
			if( $show_nav ){
				$classes[] = 'show-nav';
			}
		}
		else{
			$classes[]	= 'ts-justified-gallery';
		}

		if( $show_load_more == '1' ){
			$classes[]	= 'has-button-load-more';
		}
		elseif( $show_load_more == '2' ){
			$classes[]	= 'has-pagination';
		} 
		else{
			$classes[]	= 'no-load-more';
		}
		
		$data_attr = array();
		if( $layouts == 'justified_gallery' ){
			$data_attr[] = 'data-lastrow="'.esc_attr( $last_row ).'"';
			$data_attr[] = 'data-height="'.esc_attr( $height['size'] ).'"';
			$data_attr[] = 'data-margin="'.esc_attr( $margin['size'] ).'"';
			$data_attr[] = 'data-layouts="justified_gallery"';
		}
		else if( $layouts == 'slider' ){
			$data_attr[] = 'data-nav="'.esc_attr($show_nav).'"';
			$data_attr[] = 'data-autoplay="'.esc_attr($auto_play).'"';
			$data_attr[] = 'data-columns="'.absint($columns).'"';
		}
		else{
			$data_attr[] = 'data-layouts="masonry"';
		}

		$data_attr[] = 'data-loadmore="'. esc_attr( $show_load_more ) .'"';
		
		$posts = new WP_Query( $args );
		if( $posts->have_posts() ){
			if( $posts->max_num_pages == 1 ){
				$show_load_more = 0;
			}
			
			if( is_array($categories) ){
				$categories = implode(',', $categories);
			}
			
			$atts = compact('columns', 'limit', 'show_load_more', 'categories', 'orderby', 'order', 'show_filter_bar', 'show_title', 'show_author', 'show_date', 'show_categories', 'show_like_icon', 'original_image', 'show_nav', 'auto_play');
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>" <?php echo implode(' ', $data_attr); ?>>
			
			<?php if( $layouts == 'slider' ){ ?>
				<header class="shortcode-heading-wrapper">
					<h2 class="shortcode-title">
						<?php echo esc_html($title); ?>
					</h2>
				</header>
			<?php } 
				/* Get filter bar */
				if( $show_filter_bar && $show_load_more != 2 ){
					ts_get_portfolio_filter_bar( $posts );
				}
			?>
				<div class="portfolio-wrapper-content">
					<?php
						ts_get_portfolio_items_content($atts, $posts); 
					?>
				</div>
				
				<?php if( $show_load_more  == '1' ){ ?>
				<div class="load-more-wrapper">
					<a href="#" class="load-more button" data-total_pages="<?php echo $posts->max_num_pages; ?>" data-paged="2"><?php echo esc_html($load_more_text) ?></a>
				</div>
				<?php } ?>
			</div>
			<?php
		wp_reset_postdata();
		}
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Portfolios() );