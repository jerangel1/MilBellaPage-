<?php
use Elementor\Controls_Manager;

class TS_Elementor_Widget_Blogs extends TS_Elementor_Widget_Base{
	public function get_name(){
        return 'ts-blogs';
    }
	
	public function get_title(){
        return esc_html__( 'TS Blogs', 'themesky' );
    }
	
	public function get_categories(){
        return array( 'ts-elements', 'general' );
    }
	
	public function get_icon(){
		return 'eicon-posts-grid';
	}
	
	public function get_script_depends(){
		if( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ){
			return array('isotope');
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
		
		$this->add_lazy_load_controls( array( 'thumb-height' => 330 ) );
		
		$this->add_title_and_style_controls();
		
		$this->add_control(
            'layout'
            ,array(
                'label' 		=> esc_html__( 'Layout', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'grid'
				,'options'		=> array(
									'grid'			=> esc_html__( 'Grid', 'themesky' )
									,'slider'		=> esc_html__( 'Slider', 'themesky' )
									,'masonry'		=> esc_html__( 'Masonry', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'columns'
            ,array(
                'label' 		=> esc_html__( 'Columns', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '3'
				,'options'		=> array(
									'1'			=> '1'
									,'2'		=> '2'
									,'3'		=> '3'
								)			
                ,'description' 	=> esc_html__( 'Number of Columns', 'themesky' )
				,'condition' 	=> array( 'layout' => array('grid', 'slider', 'masonry') )
            )
        );
		
		$this->add_control(
            'limit'
            ,array(
                'label'     	=> esc_html__( 'Limit', 'themesky' )
                ,'type'     	=> Controls_Manager::NUMBER
				,'default'  	=> 6
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
					,'name'		=> 'category'
				)
				,'multiple' 	=> true
				,'sortable' 	=> false
				,'label_block' 	=> true
            )
        );
		
		$this->add_control(
            'text_align'
            ,array(
                'label' 		=> esc_html__( 'Text Align', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> 'text-center'
				,'options'		=> array(
									'text-left'			=> esc_html__( 'Left', 'themesky' )
									,'text-center'		=> esc_html__( 'Center', 'themesky' )
									,'text-right'		=> esc_html__( 'Right', 'themesky' )
								)		
                ,'description' 	=> ''
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
                'label' 		=> esc_html__( 'Show post title', 'themesky' )
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
            'show_thumbnail'
            ,array(
                'label' 		=> esc_html__( 'Show thumbnail', 'themesky' )
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
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
            )
        );
		
		$this->add_control(
            'show_tags'
            ,array(
                'label' 		=> esc_html__( 'Show tags', 'themesky' )
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
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '1'
				,'options'		=> array(
								'0'		=> esc_html__( 'No', 'themesky' )
								,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description'	=> ''
            )
        );
		
		$this->add_control(
            'show_comment'
            ,array(
                'label' 		=> esc_html__( 'Show comment', 'themesky' )
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
            'show_excerpt'
            ,array(
                'label' 		=> esc_html__( 'Show excerpt', 'themesky' )
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
            'excerpt_words'
            ,array(
                'label'     => esc_html__( 'Number of words in excerpt', 'themesky' )
                ,'type'     => Controls_Manager::NUMBER
				,'default'  => 14
				,'min'      => 1
				,'condition'=> array( 'show_excerpt' => '1' )
            )
        );
		
		$this->add_control(
            'show_readmore'
            ,array(
                'label' 		=> esc_html__( 'Show read more button', 'themesky' )
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
            'show_load_more'
            ,array(
                'label' 		=> esc_html__( 'Show load more button', 'themesky' )
                ,'type' 		=> Controls_Manager::SELECT
                ,'default' 		=> '0'
				,'options'		=> array(
									'0'		=> esc_html__( 'No', 'themesky' )
									,'1'	=> esc_html__( 'Yes', 'themesky' )
								)			
                ,'description' 	=> ''
				,'condition' 	=> array( 'layout' => array('grid', 'masonry') )
            )
        );
		
		$this->add_control(
            'load_more_text'
            ,array(
                'label' 		=> esc_html__( 'Load more button text', 'themesky' )
                ,'type' 		=> Controls_Manager::TEXT
                ,'default' 		=> 'Load more'		
                ,'description' 	=> ''
                ,'condition' 	=> array( 'layout' => array('grid', 'masonry') )
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
				,'condition' 	=> array( 'layout' => 'slider' )
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
				,'condition' 	=> array( 'layout' => 'slider' )
            )
        );
		
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$default = array(
			'lazy_load'			=> 0
			,'title'			=> ''
			,'layout'			=> 'grid'
			,'columns'			=> 3
			,'categories'		=> array()
			,'limit'			=> 6
			,'text_align'		=> 'text-center'
			,'orderby'			=> 'none'
			,'order'			=> 'DESC'
			,'show_title'		=> 1
			,'show_thumbnail'	=> 1
			,'show_categories'	=> 0
			,'show_tags'		=> 1
			,'show_author'		=> 0
			,'show_date'		=> 1
			,'show_comment'		=> 0
			,'show_excerpt'		=> 0
			,'show_readmore'	=> 0
			,'excerpt_words'	=> 14
			,'show_nav'			=> 1
			,'auto_play'		=> 0
			,'show_load_more'	=> 0
			,'load_more_text'	=> 'Load more'
		);
		
		$settings = wp_parse_args( $settings, $default );
		
		extract( $settings );
		
		if( !is_numeric($excerpt_words) ){
			$excerpt_words = 20;
		}
		
		$is_slider = 0;
		$is_masonry = 0;
		if( $layout == 'slider' ){
			$is_slider = 1;
		}
		if( $layout == 'masonry' ){
			wp_enqueue_script( 'isotope' );
			$is_masonry = 1;
		}
		
		if( $this->lazy_load_placeholder( $settings, 'blog' ) ){
			return;
		}
		
		$columns = absint($columns);
		if( !in_array($columns, array(1, 2, 3)) ){
			$columns = 3;
		}
		
		$args = array(
			'post_type' 			=> 'post'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts' 	=> 1
			,'posts_per_page'		=> $limit
			,'orderby'				=> $orderby
			,'order'				=> $order
			,'tax_query'			=> array()
		);
		
		if( is_array($categories) && count($categories) > 0 ){
			$args['tax_query'][] = array(
										'taxonomy' 	=> 'category'
										,'terms' 	=> $categories
										,'field' 	=> 'term_id'
										,'include_children' => false
									);
		}
		
		global $post;
		$posts = new WP_Query($args);
		
		if( $posts->have_posts() ):
			if( $posts->post_count <= 1 ){
				$is_slider = 0;
			}
			if( $is_slider || $posts->max_num_pages == 1 ){
				$show_load_more = 0;
			}
			
			$classes = array();
			$classes[] = 'ts-blogs-wrapper ts-shortcode ts-blogs';
			$classes[] = 'columns-' . $columns;
			$classes[] = 'style-' . $layout;
			$classes[] = $text_align;
			if( $is_slider ){
				$classes[] = 'ts-slider loading';
				if( $show_nav ){
					$classes[] = 'show-nav';
				}
			}
			if( $is_masonry ){
				$classes[] = 'ts-masonry loading';
			}
			
			$data_attr = array();
			if( $is_slider ){
				$data_attr[] = 'data-nav="'.esc_attr($show_nav).'"';
				$data_attr[] = 'data-autoplay="'.esc_attr($auto_play).'"';
				$data_attr[] = 'data-columns="'.absint($columns).'"';
			}
			
			if( is_array($categories) ){
				$categories = implode(',', $categories);
			}
			
			$atts = compact('layout', 'columns', 'categories', 'limit', 'orderby', 'order'
							,'show_title', 'show_thumbnail', 'show_author', 'show_categories', 'show_tags'
							,'show_date', 'show_comment', 'show_excerpt', 'show_readmore', 'excerpt_words'
							,'is_slider', 'show_nav', 'auto_play', 'is_masonry', 'show_load_more');
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>" <?php echo implode(' ', $data_attr); ?>>
			
				<?php if( $title ): ?>
				<header class="shortcode-heading-wrapper">
					<h2 class="shortcode-title">
						<?php echo esc_html($title); ?>
					</h2>
				</header>
				<?php endif; ?>
				
				<div class="content-wrapper">
					<div class="blogs items">
						<?php ts_get_blog_items_content($atts, $posts); ?>
					</div>
					<?php if( $show_load_more ): ?>
					<div class="load-more-wrapper">
						<a href="#" class="load-more button" data-total_pages="<?php echo $posts->max_num_pages; ?>" data-paged="2"><?php echo esc_html($load_more_text) ?></a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();
	}
}

$widgets_manager->register( new TS_Elementor_Widget_Blogs() );