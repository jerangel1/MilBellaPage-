<?php 
/*** Remove product hooks based on user's selection ***/
if( !function_exists('ts_remove_product_hooks') ){
	function ts_remove_product_hooks( $options = array() ){
		if( isset($options['show_label']) && !$options['show_label'] ){
			remove_action('woocommerce_after_shop_loop_item_title', 'agrofood_template_loop_product_label', 1);
		}
		if( isset($options['show_image']) && !$options['show_image'] ){
			remove_action('woocommerce_before_shop_loop_item_title', 'agrofood_template_loop_product_thumbnail', 10);
		}
		
		if( isset($options['show_brands']) && !$options['show_brands'] ){
			remove_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_brands', 5);
		}
		if( isset($options['show_categories']) && !$options['show_categories'] ){
			remove_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_categories', 25);
		}
		if( isset($options['show_sku']) && !$options['show_sku'] ){
			remove_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_product_sku', 10);
		}
		if( isset($options['show_title']) && !$options['show_title'] ){
			remove_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_product_title', 30);
		}
		if( isset($options['show_price']) && !$options['show_price'] ){
			remove_action('woocommerce_after_shop_loop_item_2', 'woocommerce_template_loop_price', 10);
		}
		if( isset($options['show_rating']) && !$options['show_rating'] ){
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 50);
		}
		if( isset($options['show_short_desc']) && !$options['show_short_desc'] ){
			remove_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_short_description', 60);
		}
		if( isset($options['show_add_to_cart']) && !$options['show_add_to_cart'] ){
			remove_action('woocommerce_after_shop_loop_item_2', 'agrofood_template_loop_add_to_cart', 40);
			remove_action('woocommerce_after_shop_loop_item_title', 'agrofood_template_loop_add_to_cart', 10004 );
		}
		if( isset($options['show_color_swatch']) && $options['show_color_swatch'] && function_exists('agrofood_template_loop_product_variable_color') ){
			add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_product_variable_color', 60);
			if( isset($options['number_color_swatch']) ){
				$number_color_swatch = absint($options['number_color_swatch']);
				add_filter('agrofood_loop_product_variable_color_number', function() use ($number_color_swatch){
					return $number_color_swatch;
				});
			}
		}

		wc_set_loop_prop( 'is_shortcode', true );
	}
}

/*** Remove product hooks to default ***/
if( !function_exists('ts_restore_product_hooks') ){
	function ts_restore_product_hooks(){
		add_action('woocommerce_after_shop_loop_item_title', 'agrofood_template_loop_product_label', 1);
		add_action('woocommerce_before_shop_loop_item_title', 'agrofood_template_loop_product_thumbnail', 10);
		
		add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_brands', 5);
		add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_categories', 25);
		add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_product_sku', 10);
		add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_product_title', 30);
		add_action('woocommerce_after_shop_loop_item_2', 'woocommerce_template_loop_price', 10);
		add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 50);
		add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_short_description', 60);
		add_action('woocommerce_after_shop_loop_item_2', 'agrofood_template_loop_add_to_cart', 40); 
		if( function_exists('agrofood_get_theme_options') && agrofood_get_theme_options('ts_product_hover_style') == 'hover-vertical-style' ){
			add_action('woocommerce_after_shop_loop_item_title', 'agrofood_template_loop_add_to_cart', 10004);
		}
		remove_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_product_variable_color', 60);
		remove_all_filters('agrofood_loop_product_variable_color_number');
		
		wc_set_loop_prop( 'is_shortcode', false );
	}
}

/*** Change product query args ***/
function ts_filter_product_by_product_type( &$args = array(), $product_type = 'recent' ){
	switch( $product_type ){
		case 'sale':
			$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		break;
		case 'featured':
			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
				'operator' => 'IN',
			);
		break;
		case 'best_selling':
			$args['meta_key'] 	= 'total_sales';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'desc';
		break;
		case 'top_rated':
			$args['meta_key'] 	= '_wc_average_rating';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'desc';
		break;
		case 'mixed_order':
			$args['orderby'] 	= 'rand';
		break;
		default: /* Recent */
			$args['orderby'] 	= 'date';
			$args['order'] 		= 'desc';
		break;
	}
}

/*** Get dicounted product ids ***/
function ts_get_product_deals_transient(){
	$key = 'all';
	if( defined('ICL_LANGUAGE_CODE') ){
		$key .= '-' . ICL_LANGUAGE_CODE;
	}
	$transient = get_transient('ts_product_deals_ids');
	if( $transient && isset($transient[$key]) && is_array($transient[$key]) ){
		return $transient[$key];
	}
	return false;
}

function ts_set_product_deals_transient( $value = array() ){
	$key = 'all';
	if( defined('ICL_LANGUAGE_CODE') ){
		$key .= '-' . ICL_LANGUAGE_CODE;
	}
	$transient = get_transient('ts_product_deals_ids');
	if( is_array($transient) ){
		$transient[$key] = $value;
	}
	else{
		$transient = array( $key => $value );
	}
	set_transient( 'ts_product_deals_ids', $transient, MONTH_IN_SECONDS );
}

add_action('wc_after_products_starting_sales', 'ts_delete_product_deals_transient');
add_action('wc_after_products_ending_sales', 'ts_delete_product_deals_transient');
add_action('woocommerce_delete_product_transients', 'ts_delete_product_deals_transient');
function ts_delete_product_deals_transient(){
	set_transient( 'ts_product_deals_ids', false, MONTH_IN_SECONDS );
}

function ts_get_product_deals_ids(){
	$product_ids = ts_get_product_deals_transient();
	if( !is_array($product_ids) ){
		global $post;
		$product_ids = array();
		$args = array(
			'post_type'				=> array('product', 'product_variation')
			,'post_status' 			=> 'publish'
			,'posts_per_page' 		=> -1
			,'meta_query' => array(
				array(
					'key'		=> '_sale_price_dates_to'
					,'value'	=> current_time( 'timestamp', true )
					,'compare'	=> '>'
					,'type'		=> 'numeric'
				)
				,array(
					'key'		=> '_sale_price_dates_from'
					,'value'	=> current_time( 'timestamp', true )
					,'compare'	=> '<'
					,'type'		=> 'numeric'
				)
			)
			,'tax_query'			=> array()
		);
		
		$products = new WP_Query( $args );
		
		if( $products->have_posts() ){
			while( $products->have_posts() ){
				$products->the_post();
				if( $post->post_type == 'product' ){
					$product_ids[] = $post->ID;
				}
				else{ /* Variation product */
					$product_ids[] = $post->post_parent;
				}
			}
		}
		$product_ids = array_unique($product_ids);
		ts_set_product_deals_transient($product_ids);
		wp_reset_postdata();
	}
	
	return $product_ids;
}

/*** Product Counter ***/
if( !function_exists('ts_template_loop_time_deals') ){
	function ts_template_loop_time_deals(){
		global $product;
		$date_to = '';
		$date_from = '';
		if( $product->get_type() == 'variable' ){
			$children = $product->get_children();
			if( is_array($children) && count($children) > 0 ){
				foreach( $children as $children_id ){
					$date_to = get_post_meta($children_id, '_sale_price_dates_to', true);
					$date_from = get_post_meta($children_id, '_sale_price_dates_from', true);
					if( $date_to != '' ){
						break;
					}
				}
			}
		}
		else{
			$date_to = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
			$date_from = get_post_meta($product->get_id(), '_sale_price_dates_from', true);
		}
		
		$current_time = current_time('timestamp', true);
		
		if( $date_to == '' || $date_from == '' || $date_from > $current_time || $date_to < $current_time ){
			return;
		}
		
		$seconds = $date_to - $current_time;
		
		ts_countdown( array( 'seconds' => $seconds ) );
	}
}

/*** Product Availability Bar ***/
if( !function_exists('ts_product_availability_bar') ){
	function ts_product_availability_bar(){
		global $product;
		$total_sales = $product->get_total_sales();
		$stock_quantity = $product->get_stock_quantity();
		if( $stock_quantity ){
			$total = $total_sales + $stock_quantity;
			$percent = $stock_quantity * 100 / $total;
		?>
		<div class="availability-bar">
			<div class="progress-bar">
				<span style="width:<?php echo number_format($percent, 2) ?>%"></span>
			</div>
			<span class="available"><?php esc_html_e('Available:', 'themesky') ?> <span><?php echo esc_html($stock_quantity) ?></span></span>
			<span class="sold"><?php esc_html_e('Already Sold:', 'themesky') ?> <span><?php echo esc_html($total_sales) ?><span></span>
		</div>
		<?php
		}
	}
}

if( !function_exists('ts_countdown') ){
	function ts_countdown( $atts = array() ){
		$defaults = array(
				'text_color_style'	=> 'text-default'
				,'text_align'		=> 'text-left'
				,'seconds'			=> 0
			);
			
		$atts = wp_parse_args( $atts, $defaults );	
		
		extract( $atts );
		
		if( $seconds <= 0 ){
			return;
		}
		
		$delta = $seconds;
		
		$time_day = 60 * 60 * 24;
		$time_hour = 60 * 60;
		$time_minute = 60;
		
		$day = floor( $delta / $time_day );
		$delta -= $day * $time_day;
		
		$hour = floor( $delta / $time_hour );
		$delta -= $hour * $time_hour;
		
		$minute = floor( $delta / $time_minute );
		$delta -= $minute * $time_minute;
		
		if( $delta > 0 ){
			$second = $delta;
		}
		else{
			$second = 0;
		}
		
		$day = zeroise($day, 2);
		$hour = zeroise($hour, 2);
		$minute = zeroise($minute, 2);
		$second = zeroise($second, 2);
		
		$classes = array();
		$classes[] = $text_color_style;
		$classes[] = $text_align;
		
		?>
		<div class="ts-countdown <?php echo esc_attr( implode(' ', $classes) ); ?>">
			<div class="counter-wrapper days-<?php echo strlen($day); ?>">
				<div class="days <?php echo $day == '00' ? 'hidden' : ''; ?>" data-days="<?php echo esc_attr($day); ?>" >
					<div class="number-wrapper">
						<span class="number"><?php echo wp_kses( preg_replace("/(.)/", "<span>$1</span>", $day ), array('span'=>array()) ); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php echo esc_html( _x('Days', 'Countdown Timer', 'themesky') ); ?>
					</div>
				</div>
				
				<?php if( $day != '00' ){ ?>
				<span class="separate">:</span>
				<?php } ?>
				
				<div class="hours" data-hours="<?php echo esc_attr($hour); ?>">
					<div class="number-wrapper" >
						<span class="number"><?php echo wp_kses( preg_replace("/(.)/", "<span>$1</span>", $hour ), array('span'=>array()) ); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php echo esc_html( _x('Hours', 'Countdown Timer', 'themesky') ); ?>
					</div>
				</div>
				
				<span class="separate">:</span>
				 
				<div class="minutes" data-minutes="<?php echo esc_attr($minute); ?>" >
					<div class="number-wrapper">
						<span class="number"><?php echo wp_kses( preg_replace("/(.)/", "<span>$1</span>", $minute ), array('span'=>array()) ); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php echo esc_html( _x('Mins', 'Countdown Timer', 'themesky') ); ?>
					</div>
				</div>
				
				<span class="separate">:</span>
				
				<div class="seconds" data-seconds="<?php echo esc_attr($second); ?>" >
					<div class="number-wrapper">
						<span class="number"><?php echo wp_kses( preg_replace("/(.)/", "<span>$1</span>", $second ), array('span'=>array()) ); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php echo esc_html( _x('Secs', 'Countdown Timer', 'themesky') ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

/*** Header Social Icons ***/
if( !function_exists('ts_header_social_icons') ){
	function ts_header_social_icons(){
		if( function_exists('agrofood_get_theme_options') && agrofood_get_theme_options('ts_enable_header_social_icons') ){
			ob_start();
			include plugin_dir_path( __FILE__ ) . 'templates/header-social-icons.php';
			$icons_html = ob_get_clean();
			echo apply_filters('ts_header_social_icons_html', $icons_html);
		}
	}
}

/*** Product - Blog Social Sharing ***/
if( !function_exists('ts_use_sharethis') ){
	function ts_use_sharethis(){
		if( !function_exists('agrofood_get_theme_options') ){
			return false;
		}
		$theme_options = agrofood_get_theme_options();
		$sharethis_key = '';
		if( is_singular('post') || is_singular('ts_portfolio') ){
			if( $theme_options['ts_blog_details_sharing_sharethis'] && $theme_options['ts_blog_details_sharing_sharethis_key'] ){
				$sharethis_key = $theme_options['ts_blog_details_sharing_sharethis_key'];
			}
		}
		if( is_singular('product') ){
			if( $theme_options['ts_prod_sharing_sharethis'] && $theme_options['ts_prod_sharing_sharethis_key'] ){
				$sharethis_key = $theme_options['ts_prod_sharing_sharethis_key'];
			}
		}
		return $sharethis_key;
	}
}

if( !function_exists('ts_template_social_sharing') ){
	function ts_template_social_sharing(){
		if( ts_use_sharethis() ){
			echo '<div class="ts-social-sharing">';
				echo '<span class="icon"></span><span>'.esc_html__('Share', 'themesky').'</span><span class="symbol">:</span>';
				echo '<div class="sharethis-inline-share-buttons"></div>';
			echo '</div>';
		}
		else{
			ob_start();
			include plugin_dir_path( __FILE__ ) . 'templates/social-sharing.php';
			$icons_html = ob_get_clean();
			echo apply_filters('ts_social_sharing_html', $icons_html);
		}
	}
}

add_action('wp_head', 'ts_add_sharethis_script');
if( !function_exists('ts_add_sharethis_script') ){
	function ts_add_sharethis_script(){
		$sharethis_key = ts_use_sharethis();
		if( $sharethis_key ){
		?>
		<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=<?php echo esc_attr($sharethis_key) ?>&product=inline-share-buttons' async='async'></script>
		<?php
		}
	}
}

if( !function_exists('ts_get_portfolio_filter_bar') ){
	function ts_get_portfolio_filter_bar( $posts ) {
		$terms = array();
		foreach( $posts->posts as $p ){
			$post_terms = wp_get_post_terms($p->ID, 'ts_portfolio_cat');
			if( is_array($post_terms) ){
				foreach( $post_terms as $term ){
					$terms[$term->slug] = $term->name;
				}
			}
		}
		
		if( !empty($terms) ){
			?>
			<ul class="filter-bar">
				<li data-filter="*" class="current"><?php esc_html_e('All', 'themesky'); ?></li>
				<?php
				foreach( $terms as $slug => $name ){
				?>
				<li data-filter="<?php echo '.'.$slug; ?>"><?php echo esc_attr($name) ?></li>
				<?php
				}
				?>
			</ul>
			<?php
		}
	}
}
