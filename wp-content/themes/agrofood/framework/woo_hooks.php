<?php
/*************************************************
* WooCommerce Custom Hook                        *
**************************************************/

/*** Shop - Category ***/

/* Remove hook */
function agrofood_woocommerce_remove_shop_loop_default_hooks(){
	remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

	remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

	remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

	remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

	remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
	remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);
}
agrofood_woocommerce_remove_shop_loop_default_hooks();

add_action('load-post.php', 'agrofood_woocommerce_remove_shop_loop_default_hooks', 20); /* Fixed: Elementor editor - WooCommerce 8.4.0 */

/* Add new hook */
add_action('woocommerce_before_shop_loop_item_title', 'agrofood_template_loop_product_thumbnail', 10);
add_action('woocommerce_after_shop_loop_item_title', 'agrofood_template_loop_product_label', 1);

add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_brands', 5);
add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_product_sku', 10);
add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_categories', 25);
add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_product_title', 30);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 50);
add_action('woocommerce_after_shop_loop_item', 'agrofood_template_loop_short_description', 60);
add_action('woocommerce_after_shop_loop_item_2', 'agrofood_template_loop_add_to_cart', 40);
add_action('woocommerce_after_shop_loop_item_2', 'woocommerce_template_loop_price', 10);

add_action('woocommerce_before_shop_loop', 'agrofood_add_filter_button', 15);
add_action('woocommerce_before_shop_loop', 'agrofood_product_filter_by_brand', 20);
add_action('woocommerce_before_shop_loop', 'agrofood_product_on_sale_form', 50);
add_action('woocommerce_before_shop_loop', 'agrofood_product_per_page_form', 60);

add_filter('loop_shop_per_page', 'agrofood_change_products_per_page_shop'); 

add_filter('loop_shop_post_in', 'agrofood_show_only_products_on_sales');

add_action('woocommerce_after_shop_loop', 'agrofood_shop_load_more_html', 20);

add_filter('woocommerce_catalog_orderby', 'agrofood_woocommerce_catalog_orderby');

add_filter('woocommerce_get_stock_html', 'agrofood_empty_woocommerce_stock_html', 10, 2);

add_filter('woocommerce_before_output_product_categories', 'agrofood_before_output_product_categories');
add_filter('woocommerce_after_output_product_categories', 'agrofood_after_output_product_categories');

add_filter('woocommerce_pagination_args', 'agrofood_woocommerce_pagination_args');
function agrofood_woocommerce_pagination_args( $args ){
	$args['prev_text'] = esc_html__('Previous page', 'agrofood');
	$args['next_text'] = esc_html__('Next page', 'agrofood');
	return $args;
}

add_action('init', 'agrofood_check_product_lazy_load');
function agrofood_check_product_lazy_load(){
	if( wp_doing_ajax() || ( isset($_GET['action']) && $_GET['action'] == 'elementor' ) ){
		agrofood_change_theme_options('ts_prod_lazy_load', 0);
	}
}

function agrofood_template_loop_product_label(){
	global $product;
	$theme_options = agrofood_get_theme_options();
	?>
	<div class="product-label">
	<?php 
	if( $product->is_in_stock() ){
		/* New label */
		if( $theme_options['ts_product_show_new_label'] ){
			$now = current_time( 'timestamp', true );
			$post_date = get_post_time('U', true);
			$num_day = (int)( ( $now - $post_date ) / ( 3600*24 ) );
			$num_day_setting = absint( $theme_options['ts_product_show_new_label_time'] );
			if( $num_day <= $num_day_setting ){
				echo '<span class="new"><span>'.esc_html($theme_options['ts_product_new_label_text']).'</span></span>';
			}
		}
		
		/* Sale label */
		if( $product->is_on_sale() ){
			if( $theme_options['ts_show_sale_label_as'] != 'text' ){
				if( $product->get_type() == 'variable' ){
					$regular_price = $product->get_variation_regular_price('max');
					$sale_price = $product->get_variation_sale_price('min');
				}
				else{
					$regular_price = $product->get_regular_price();
					$sale_price = $product->get_price();
				}
				if( $regular_price ){
					if( $theme_options['ts_show_sale_label_as'] == 'number' ){
						$_off_price = round($regular_price - $sale_price, wc_get_price_decimals());
						$price_display = '-' . sprintf(get_woocommerce_price_format(), get_woocommerce_currency_symbol(), $_off_price);
						echo '<span class="onsale amount" data-original="'.$price_display.'"><span>'.$price_display.'</span></span>';
					}
					if( $theme_options['ts_show_sale_label_as'] == 'percent' ){
						echo '<span class="onsale percent"><span>-'.agrofood_calc_discount_percent($regular_price, $sale_price).'%</span></span>';
					}
				}
			}
			else{
				echo '<span class="onsale"><span>'.esc_html($theme_options['ts_product_sale_label_text']).'</span></span>';
			}
		}
		
		/* Hot label */
		if( $product->is_featured() ){
			echo '<span class="featured"><span>'.esc_html($theme_options['ts_product_feature_label_text']).'</span></span>';
		}
	}
	else{ /* Out of stock */
		echo '<span class="out-of-stock"><span>'.esc_html($theme_options['ts_product_out_of_stock_label_text']).'</span></span>';
	}
	?>
	</div>
	<?php
}

function agrofood_template_loop_product_thumbnail(){
	global $product;
	$lazy_load = agrofood_get_theme_options('ts_prod_lazy_load');
	$placeholder_img_src = agrofood_get_theme_options('ts_prod_placeholder_img')['url'];
	
	$prod_galleries = $product->get_gallery_image_ids();
	
	$image_size = apply_filters('agrofood_loop_product_thumbnail', 'woocommerce_thumbnail');
	
	$dimensions = wc_get_image_size( $image_size );
	
	$has_back_image = agrofood_get_theme_options('ts_effect_product');
	
	if( !is_array($prod_galleries) || ( is_array($prod_galleries) && count($prod_galleries) == 0 ) ){
		$has_back_image = false;
	}
	 
	if( wp_is_mobile() ){
		$has_back_image = false;
	}
	
	echo '<figure class="' . ($has_back_image?'has-back-image':'no-back-image') . '">';
		if( !$lazy_load ){
			echo woocommerce_get_product_thumbnail( $image_size );
			
			if( $has_back_image ){
				echo wp_get_attachment_image( $prod_galleries[0], $image_size, 0, array('class' => 'product-image-back') );
			}
		}
		else{
			$front_img_src = '';
			$alt = '';
			if( has_post_thumbnail( $product->get_id() ) ){
				$post_thumbnail_id = get_post_thumbnail_id($product->get_id());
				$image_obj = wp_get_attachment_image_src($post_thumbnail_id, $image_size, 0);
				if( isset($image_obj[0]) ){
					$front_img_src = $image_obj[0];
				}
				$alt = trim(strip_tags( get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) ));
			}
			else{
				$front_img_src = wc_placeholder_img_src();
			}
			
			echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($front_img_src).'" class="attachment-shop_catalog wp-post-image ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
		
			if( $has_back_image ){
				$back_img_src = '';
				$alt = '';
				$image_obj = wp_get_attachment_image_src($prod_galleries[0], $image_size, 0);
				if( isset($image_obj[0]) ){
					$back_img_src = $image_obj[0];
					$alt = trim(strip_tags( get_post_meta($prod_galleries[0], '_wp_attachment_image_alt', true) ));
				}
				else{
					$back_img_src = wc_placeholder_img_src();
				}
				
				echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($back_img_src).'" class="product-image-back ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
			}
		}
	echo '</figure>';
}

function agrofood_template_loop_product_variable_color(){
	global $product;
	if( $product->get_type() == 'variable' ){
		$attribute_color = wc_attribute_taxonomy_name( 'color' ); // pa_color
		$attribute_color_name = wc_variation_attribute_name( $attribute_color ); // attribute_pa_color
		
		$color_terms = wc_get_product_terms( $product->get_id(), $attribute_color, array( 'fields' => 'all' ) );
		if( empty($color_terms) || is_wp_error($color_terms) ){
			return;
		}
		$color_term_ids = wp_list_pluck( $color_terms, 'term_id' );
		$color_term_slugs = wp_list_pluck( $color_terms, 'slug' );
		
		$color_html = array();
		$price_html = array();
		
		$added_colors = array();
		$count = 0;
		$number = apply_filters('agrofood_loop_product_variable_color_number', 3);
		
		$children = $product->get_children();
		if( is_array($children) && count($children) > 0 ){
			foreach( $children as $children_id ){
				$variation_attributes = wc_get_product_variation_attributes( $children_id );
				foreach( $variation_attributes as $attribute_name => $attribute_value ){
					if( $attribute_name == $attribute_color_name ){
						if( in_array($attribute_value, $added_colors) ){
							break;
						}
						
						$term_id = 0;
						$found_slug = array_search($attribute_value, $color_term_slugs);
						if( $found_slug !== false ){
							$term_id = $color_term_ids[ $found_slug ];
						}
						
						if( $term_id !== false && absint( $term_id ) > 0 ){
							$thumbnail_id = get_post_meta( $children_id, '_thumbnail_id', true );
							if( $thumbnail_id ){
								$image_src = wp_get_attachment_image_src($thumbnail_id, 'woocommerce_thumbnail');
								if( $image_src ){
									$thumbnail = $image_src[0];
								}
								else{
									$thumbnail = wc_placeholder_img_src();
								}
							}
							else{
								$thumbnail = wc_placeholder_img_src();
							}
							
							$color_datas = get_term_meta( $term_id, 'ts_product_color_config', true );
							if( $color_datas ){
								$color_datas = unserialize( $color_datas );	
							}else{
								$color_datas = array('ts_color_color' => '#ffffff', 'ts_color_image' => 0);
							}
							$color_datas['ts_color_image'] = absint($color_datas['ts_color_image']);
							if( $color_datas['ts_color_image'] ){
								$color_html[] = '<div class="color-image" data-thumb="'.$thumbnail.'" data-term_id="'.$term_id.'"><span>'.wp_get_attachment_image( $color_datas['ts_color_image'], 'ts_prod_color_thumb', true, array('alt' => $attribute_value) ).'</span></div>';
							}
							else{
								$color_html[] = '<div class="color" data-thumb="'.$thumbnail.'" data-term_id="'.$term_id.'"><span style="background-color: '.$color_datas['ts_color_color'].'"></span></div>';
							}
							$variation = wc_get_product( $children_id );
							$price_html[] = '<span data-term_id="'.$term_id.'">' . $variation->get_price_html() . '</span>';
							$count++;
						}
						
						$added_colors[] = $attribute_value;
						break;
					}
				}
				
				if( $count == $number ){
					break;
				}
			}
		}
		
		if( $color_html ){
			echo '<div class="color-swatch">'. implode('', $color_html) . '</div>';
			echo '<span class="variable-prices hidden">' . implode('', $price_html) . '</span>';
		}
	}
}

function agrofood_template_loop_product_title(){
	global $product;
	echo '<h3 class="heading-title product-name">';
	echo '<a href="' . esc_url($product->get_permalink()) . '">' . esc_html($product->get_title()) . '</a>';
	echo '</h3>';
}

function agrofood_template_loop_add_to_cart(){
	if( agrofood_get_theme_options('ts_enable_catalog_mode') ){
		return;
	}
	
	echo '<div class="loop-add-to-cart">';
	woocommerce_template_loop_add_to_cart();
	echo '</div>';
}

function agrofood_template_loop_product_sku(){
	global $product;
	echo '<div class="product-sku">' . esc_html($product->get_sku()) . '</div>';
}

function agrofood_template_loop_short_description(){
	global $product;
	if( !$product->get_short_description() ){
		return;
	}
	
	$allowed_html = array(
		'ul' => array(
			'class' => array()
		)
		,'ol' => array(
			'class' => array()
		)
		,'li'=> array(
			'class' => array()
		)
	);
	
	$limit_words = (int) agrofood_get_theme_options('ts_prod_cat_desc_words');
	?>
		<div class="short-description">
			<?php agrofood_the_excerpt_max_words($limit_words, '', $allowed_html, '', true); ?>
		</div>
	<?php
	
}

function agrofood_template_loop_brands(){
	global $product;
	if( taxonomy_exists('ts_product_brand') ){
		echo get_the_term_list($product->get_id(), 'ts_product_brand', '<div class="product-brands">', ', ', '</div>');
	}
}

function agrofood_template_loop_categories(){
	global $product;
	$categories_label = esc_html__('Categories: ', 'agrofood');
	echo wc_get_product_category_list($product->get_id(), ', ', '<div class="product-categories"><span>'.$categories_label.'</span>', '</div>');
}

function agrofood_change_products_per_page_shop(){
    if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( isset($_GET['per_page']) && absint($_GET['per_page']) > 0 ){
			return absint($_GET['per_page']);
		}
		$per_page = absint( agrofood_get_theme_options('ts_prod_cat_per_page') );
        if( $per_page ){
            return $per_page;
        }
    }
}

function agrofood_product_per_page_form(){
	if( !agrofood_get_theme_options('ts_prod_cat_per_page_dropdown') ){
		return;
	}
	if( function_exists('woocommerce_products_will_display') && !woocommerce_products_will_display() ){
		return;
	}
	
	$per_page = absint( agrofood_get_theme_options('ts_prod_cat_per_page') );
	if( !$per_page ){
		return;
	}
	
	$options = array();
	for( $i = 1; $i <= 4; $i++ ){
		$options[] = $per_page * $i;
	}
	$selected = isset($_GET['per_page'])?absint($_GET['per_page']):$per_page;
	
	$action = '';
	$cat 	= get_queried_object();
	if( isset( $cat->term_id ) && isset( $cat->taxonomy ) ){
		$action = get_term_link( $cat->term_id, $cat->taxonomy );
	}
	else{
		$action = wc_get_page_permalink('shop');
	}
?>
	<form method="get" action="<?php echo esc_url($action) ?>" class="product-per-page-form">
		<span><?php esc_html_e('Show', 'agrofood'); ?></span>
		<select name="per_page" class="perpage">
			<?php foreach( $options as $option ): ?>
			<option value="<?php echo esc_attr($option) ?>" <?php selected($selected, $option) ?>><?php echo esc_html($option) ?></option>
			<?php endforeach; ?>
		</select>
		<ul class="perpage">
			<li>
				<span class="perpage-current">
					<span><?php esc_html_e('Show', 'agrofood'); ?></span>
					<span><?php echo esc_html($selected) ?></span>
				</span>
				<ul class="dropdown">
					<?php foreach( $options as $option ): ?>
					<li>
						<a href="#" data-perpage="<?php echo esc_attr($option) ?>" class="<?php echo esc_attr($option == $selected?'current':''); ?>">
							<span><?php echo esc_html($option) ?></span>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</li>
		</ul>
		<?php wc_query_string_form_fields( null, array( 'per_page', 'submit', 'paged', 'product-page' ) ); ?>
	</form>
<?php
}

function agrofood_show_only_products_on_sales( $array ){
	if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( isset($_GET['onsale']) && 'yes' == $_GET['onsale'] ){
			return array_merge($array, wc_get_product_ids_on_sale());
		}
	}
	return $array;
}

function agrofood_product_on_sale_form(){
	if( !agrofood_get_theme_options('ts_prod_cat_onsale_checkbox') ){
		return;
	}
	if( function_exists('woocommerce_products_will_display') && !woocommerce_products_will_display() ){
		return;
	}
	
	$checked = isset($_GET['onsale']) && 'yes' == $_GET['onsale'] ? true : false;
	
	$action = '';
	$cat 	= get_queried_object();
	if( isset( $cat->term_id ) && isset( $cat->taxonomy ) ){
		$action = get_term_link( $cat->term_id, $cat->taxonomy );
	}
	else{
		$action = wc_get_page_permalink('shop');
	}
	?>
	<form method="get" action="<?php echo esc_url($action); ?>" class="product-on-sale-form <?php echo esc_attr( $checked?'checked':'' ); ?>">
		<label>
			<input type="checkbox" name="onsale" value="yes" <?php echo esc_attr( $checked?'checked':'' ); ?> />
			<?php esc_html_e('Show only products on sale', 'agrofood'); ?>
		</label>
		<?php wc_query_string_form_fields( null, array( 'onsale', 'submit', 'paged', 'product-page' ) ); ?>
	</form>
	<?php
}

function agrofood_woocommerce_catalog_orderby( $orderby ){
	if( isset($orderby['menu_order']) ){
		$orderby['menu_order'] = __('Default', 'agrofood');
	}
	if( isset($orderby['popularity']) ){
		$orderby['popularity'] = __('Popularity', 'agrofood');
	}
	if( isset($orderby['rating']) ){
		$orderby['rating'] = __('Average rating', 'agrofood');
	}
	if( isset($orderby['date']) ){
		$orderby['date'] = __('Latest', 'agrofood');
	}
	if( isset($orderby['price']) ){
		$orderby['price'] = __('Price: low to high', 'agrofood');
	}
	if( isset($orderby['price-desc']) ){
		$orderby['price-desc'] = __('Price: high to low', 'agrofood');
	}
	return $orderby;
}

function agrofood_is_active_filter_area(){
	return is_active_sidebar('filter-widget-area') && agrofood_get_theme_options('ts_filter_widget_area') && woocommerce_products_will_display();
}

function agrofood_show_filter_area_by_default(){
	return !wp_is_mobile() && agrofood_get_theme_options('ts_show_filter_widget_area_by_default');
}

function agrofood_product_filter_by_brand(){
	if( class_exists('TS_Product_Filter_By_Brand_Widget') && agrofood_get_theme_options('ts_show_filter_by_brands') ){
		$values = array(
			'title'					=> ''
			,'query_type'			=> 'and'
			,'display_style'	    => 'dropdown'
			,'show_post_count'		=> 0
			,'hide_empty'			=> 1
			,'based_on_selection'	=> 0
			,'orderby'				=> 'name'
			,'order'				=> 'asc'
			,'is_top_archive'	    => 1
		);
		
		the_widget( 'TS_Product_Filter_By_Brand_Widget', $values );
	}
}

function agrofood_add_filter_button(){
	if( agrofood_is_active_filter_area() ){
		$show_by_default = agrofood_show_filter_area_by_default();
	?>
		<div class="filter-widget-area-button">
			<a href="#" class="<?php echo esc_attr( $show_by_default?'active':'' ); ?>"><?php esc_html_e('Show filters', 'agrofood') ?></a>
		</div>
		
		<div id="ts-filter-widget-area" class="ts-floating-sidebar <?php echo esc_attr( $show_by_default?'active':'' ); ?>">
			<div class="overlay"></div>
			<div class="ts-sidebar-content">
				<span class="close"></span>
				<aside class="filter-widget-area">
					<?php dynamic_sidebar( 'filter-widget-area' ); ?>
				</aside>
			</div>
		</div>
		<?php
	}
}

function agrofood_shop_load_more_html(){
	if( wc_get_loop_prop( 'total_pages' ) == 1 || !woocommerce_products_will_display() ){
		return;
	}
	$loading_type = agrofood_get_theme_options('ts_prod_cat_loading_type');
	if( in_array($loading_type, array('infinity-scroll', 'load-more-button')) ){
		$total = wc_get_loop_prop( 'total' );
		$per_page = wc_get_loop_prop( 'per_page' );
		$current = wc_get_loop_prop( 'current_page' );
		$showing = min($current * $per_page, $total);
	?>
	<div class="ts-shop-result-count">
		<?php 
		if( $showing < $total ){
			printf( esc_html__('You\'re viewed %s of %s products', 'agrofood'), $showing, $total );
		}
		else{
			printf( esc_html__('You\'re viewed all %s products', 'agrofood'), $total );
		}
		?>
	</div>
	<div class="ts-shop-load-more">
		<a class="load-more button"><?php esc_html_e('Load more', 'agrofood'); ?></a>
	</div>
	<?php
	}
}

function agrofood_empty_woocommerce_stock_html( $html, $product ){
	if( $product->get_type() == 'simple' ){
		return '';
	}
	return $html;
}

function agrofood_before_output_product_categories(){
	return '<div class="list-categories">';
}

function agrofood_after_output_product_categories(){
	return '</div>';
}
/*** End Shop - Category ***/

/*** Single Product ***/

/* Remove hook */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
if( function_exists('YITH_WFBT_Frontend') ){
	remove_action('woocommerce_after_single_product_summary', array(YITH_WFBT_Frontend(), 'add_bought_together_form'), 1);
}

/* Add hook */
add_action('woocommerce_before_single_product_summary', 'agrofood_before_single_product_brand_information', 0);

add_action('woocommerce_before_single_product_summary', 'agrofood_before_single_product_summary_images', 2);

add_action('woocommerce_after_single_product_summary', 'agrofood_after_single_product_summary_images', 0);
add_action('woocommerce_after_single_product_summary', 'agrofood_product_ads_banner', 2);
add_action('woocommerce_after_single_product_summary', 'agrofood_single_product_delivery_note', 3);
if( function_exists('YITH_WFBT_Frontend') ){
	add_action('woocommerce_after_single_product_summary', array(YITH_WFBT_Frontend(), 'add_bought_together_form'), 4);
}
add_action('woocommerce_after_single_product_summary', 'agrofood_after_add_bought_together_form', 5);
add_action('woocommerce_after_single_product_summary', 'agrofood_template_products_in_category_tabs', 6);

add_action('woocommerce_product_thumbnails', 'agrofood_template_loop_product_label', 99);
add_action('woocommerce_product_thumbnails', 'agrofood_template_single_product_video_360_buttons', 99);

add_action('woocommerce_single_product_summary', 'agrofood_template_single_navigation', 1);
add_action('woocommerce_single_product_summary', 'agrofood_template_loop_brands', 1);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 11);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 12);
add_action('woocommerce_single_product_summary', 'agrofood_template_single_countdown', 19);
add_action('woocommerce_single_product_summary', 'agrofood_before_single_product_summary_column_2', 18);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
add_action('woocommerce_single_product_summary', 'agrofood_template_single_variation_price', 21);
add_action('woocommerce_before_add_to_cart_quantity', 'agrofood_template_single_availability', 10);
add_action('woocommerce_single_product_summary', 'agrofood_single_product_buttons_sharing_start', 31);
add_action('woocommerce_single_product_summary', 'agrofood_single_product_buttons_end', 41);
add_action('woocommerce_single_product_summary', 'agrofood_single_product_buttons_sharing_end', 71);
add_action('woocommerce_single_product_summary', 'agrofood_after_single_product_summary_column_2', 72);
add_action('woocommerce_single_product_summary', 'agrofood_template_single_meta', 73);

add_action('woocommerce_after_single_product_summary', 'agrofood_product_newsletter', 13);
add_action('woocommerce_after_single_product_summary', 'agrofood_product_instagram', 14);
add_action('woocommerce_after_single_product_summary', 'agrofood_new_arrival_products', 19);

if( function_exists('ts_template_social_sharing') ){
	add_action('woocommerce_share', 'ts_template_social_sharing', 10);
}

add_filter('woocommerce_grouped_product_columns', 'agrofood_woocommerce_grouped_product_columns');

add_filter('woocommerce_output_related_products_args', 'agrofood_output_related_products_args_filter');

add_filter('woocommerce_single_product_image_gallery_classes', 'agrofood_add_classes_to_single_product_thumbnail');
add_filter('woocommerce_gallery_thumbnail_size', 'agrofood_product_gallery_thumbnail_size');

add_filter('woocommerce_dropdown_variation_attribute_options_args', 'agrofood_variation_attribute_options_args');
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'agrofood_variation_attribute_options_html', 10, 2);

if( !is_admin() ){ /* Fix for WooCommerce Tab Manager plugin */
	add_filter( 'woocommerce_product_tabs', 'agrofood_product_remove_tabs', 999 );
	add_filter( 'woocommerce_product_tabs', 'agrofood_add_product_custom_tab', 90 );
}

function agrofood_calc_discount_percent($regular_price, $sale_price){
	return ( 1 - round($sale_price / $regular_price, 2) ) * 100;
}

add_action('wp_ajax_agrofood_load_product_video', 'agrofood_load_product_video_callback' );
add_action('wp_ajax_nopriv_agrofood_load_product_video', 'agrofood_load_product_video_callback' );
/*** End Product ***/

function agrofood_before_single_product_summary_images(){
	echo '<div class="product-images-summary">';
}

function agrofood_after_single_product_summary_images(){
	echo '</div>';
}

function agrofood_before_single_product_brand_information(){
	echo '<div class="product-top-section">';
}

function agrofood_after_add_bought_together_form(){
	echo '</div>';
}

function agrofood_single_product_delivery_note(){
	$delivery_note = agrofood_get_theme_options('ts_prod_delivery_note');

	if( $delivery_note ){
	?>
		<div class="ts-delivery-note">
			<span>
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M5.22497 16.3669C6.10402 16.3669 6.81663 15.6543 6.81663 14.7753C6.81663 13.8962 6.10402 13.1836 5.22497 13.1836C4.34591 13.1836 3.6333 13.8962 3.6333 14.7753C3.6333 15.6543 4.34591 16.3669 5.22497 16.3669Z" stroke="#FF6D22" stroke-miterlimit="10"/>
				<path d="M14.7748 16.3669C15.6538 16.3669 16.3664 15.6543 16.3664 14.7753C16.3664 13.8962 15.6538 13.1836 14.7748 13.1836C13.8957 13.1836 13.1831 13.8962 13.1831 14.7753C13.1831 15.6543 13.8957 16.3669 14.7748 16.3669Z" stroke="#FF6D22" stroke-miterlimit="10"/>
				<path d="M3.63333 14.7745H1.25V3.63281H15.5667V6.81615L17.1583 9.99948L18.75 10.8911V14.7745H16.3667" stroke="#FF6D22" stroke-miterlimit="10"/>
				<path d="M13.1836 14.7754H6.81689" stroke="#FF6D22" stroke-miterlimit="10"/>
				<path d="M17.1583 9.99974H12.3833V6.81641H15.5666" stroke="#FF6D22" stroke-miterlimit="10"/>
				</svg>
				<?php echo esc_html( $delivery_note ); ?>
			</span>
		</div>
	<?php
	}
}

function agrofood_single_product_brand_information(){
	if ( !class_exists('WooCommerce') ){
		return;
	}
	
	global $product;	

	if( taxonomy_exists('ts_product_brand') ){
		$terms = get_the_terms( $product->get_id(), 'ts_product_brand' );	
		$image_size = apply_filters('agrofood_single_product_brand_thumbnail', 'woocommerce_thumbnail');
				
		if( isset( $terms[0] ) && !is_wp_error($terms) ){
		$thumbnail_id = absint(get_term_meta( $terms[0]->term_id, 'thumbnail_id', true ));
		$facebook_url = get_term_meta( $terms[0]->term_id, 'facebook_url', true );
		$twitter_url = get_term_meta( $terms[0]->term_id, 'twitter_url', true );
		$instagram_url = get_term_meta( $terms[0]->term_id, 'instagram_url', true );
		$youtube_url = get_term_meta( $terms[0]->term_id, 'youtube_url', true );
		$pinterest_url = get_term_meta( $terms[0]->term_id, 'pinterest_url', true );
		$linkedin_url = get_term_meta( $terms[0]->term_id, 'linkedin_url', true );
		$custom_social_url = get_term_meta( $terms[0]->term_id, 'custom_url', true );
		$custom_social_icon = get_term_meta( $terms[0]->term_id, 'custom_url_class', true );
	?>
		<div class="ts-product-brand-info">
			<div class="brand-info-wrapper">
				<?php
				if( $thumbnail_id ){
					echo wp_get_attachment_image($thumbnail_id, $image_size, false, array( 'class' => 'brand-logo' ));
				}
				?>
				<div class="brand-info">
					<?php if( $terms[0]->name ){ ?>
						<h3 class="brand-name"><?php echo esc_html( $terms[0]->name ); ?></h3>
					<?php } ?>
					<?php if( $terms[0]->description ){ ?>
						<div class="description"><?php echo esc_html( $terms[0]->description ); ?></div>
					<?php }
						
						do_action('agrofood_after_single_product_brand_info');
					?>

					<?php if( $facebook_url || $twitter_url || $instagram_url || $youtube_url || $pinterest_url || $linkedin_url || $custom_social_url ): ?>
					<div class="social-profile">
						<ul>  
							<?php if( $facebook_url ): ?>
								<li class="facebook">
									<a href="<?php echo esc_url($facebook_url); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
								</li>
							<?php endif; ?>
							
							<?php if( $twitter_url ): ?>
								<li class="twitter">
									<a href="<?php echo esc_url($twitter_url); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
								</li>
							<?php endif; ?>
							
							<?php if( $instagram_url ): ?>
								<li class="instagram">
									<a href="<?php echo esc_url($instagram_url); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
								</li>
							<?php endif; ?>
							
							<?php if( $youtube_url ): ?>
								<li class="youtube">
									<a href="<?php echo esc_url($youtube_url); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
								</li>
							<?php endif; ?>
							
							<?php if( $pinterest_url ): ?>
								<li class="pinterest">
									<a href="<?php echo esc_url($pinterest_url); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
								</li>
							<?php endif; ?>
							
							<?php if( $linkedin_url ): ?>
								<li class="linkedin">
									<a href="<?php echo esc_url($linkedin_url); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
								</li>
							<?php endif; ?>
							
							<?php if( $custom_social_url ): ?>
								<li class="custom">
									<a href="<?php echo esc_url($custom_social_url); ?>" target="_blank"><i class="<?php echo esc_attr( $custom_social_icon ); ?>"></i>
									</a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="product_list_widget cart_list">
				<?php 
					// Tax query 
					$tax_query = WC()->query->get_tax_query();
					$tax_query[] =  array(
						'taxonomy' => 'ts_product_brand',
						'field'    => 'id',
						'terms'    => array( $terms[0]->term_id ),
						'operator' => 'IN',
					);

					$args = array(
						'post_type'			=> 'product'
						,'post_status'		=> 'publish'
						,'posts_per_page'	=> 3
						,'order'			=> 'desc'
						,'post__not_in'		=> array( $product->get_id() )
						,'meta_query' 		=> WC()->query->get_meta_query()
						,'tax_query'		=> $tax_query
					);

					$products = new WP_Query( $args );
					?>
					<div class="woocommerce main-products style-column-list">
					<?php
						woocommerce_product_loop_start();
						if( $products->have_posts() ){
							while( $products->have_posts() ){
								$products->the_post();

								wc_get_template_part( 'content', 'product' );
							}
						}
						woocommerce_product_loop_end();
					?>
					</div>
					<?php
					wp_reset_postdata();
				?>
			</div>
			<div class="show-all">
				<a href="<?php echo esc_url( get_term_link( $terms[0]->term_id, 'ts_product_brand' ) ); ?>" class="button-text"><?php echo esc_html__( 'Show all from this brand', 'agrofood' ); ?></a>
			</div>
		</div>
	<?php
		}
	}
}

function agrofood_template_products_in_category_tabs(){
	if ( !class_exists('WooCommerce') ){
		return;
	}

	if( agrofood_get_theme_options('ts_prod_category_top') ){	
		$args = array(
			'title'					=> agrofood_get_theme_options('ts_prod_category_title_top')
			,'parent_cat'			=> agrofood_get_theme_options('ts_prod_parent_category_top')
			,'columns'				=> agrofood_get_theme_options('ts_prod_category_columns_top')
			,'limit'				=> agrofood_get_theme_options('ts_prod_category_limit_top')
			,'tab_heading_columns'	=> agrofood_get_theme_options('ts_prod_category_heading_columns_top')
			,'img_bg'				=> agrofood_get_theme_options('ts_prod_category_image_top')['id']
		);

		agrofood_products_in_category_tabs( $args );
	}
	
	if( agrofood_get_theme_options('ts_prod_category_bottom') ){
		$args = array(
			'title'					=> agrofood_get_theme_options('ts_prod_category_title_bottom')
			,'parent_cat'			=> agrofood_get_theme_options('ts_prod_parent_category_bottom')
			,'columns'				=> agrofood_get_theme_options('ts_prod_category_columns_bottom')
			,'limit'				=> agrofood_get_theme_options('ts_prod_category_limit_bottom')
			,'tab_heading_columns'	=> agrofood_get_theme_options('ts_prod_category_heading_columns_bottom')
			,'img_bg'				=> agrofood_get_theme_options('ts_prod_category_image_bottom')['id']
		);

		agrofood_products_in_category_tabs( $args );
	}

	if( agrofood_get_theme_options('ts_prod_category_bottom') || agrofood_get_theme_options('ts_prod_category_top') ){
		agrofood_remove_hooks_from_shop_loop();
	}
}

function agrofood_template_single_product_video_360_buttons(){
	if( !is_singular('product') ){
		return;
	}
	
	global $product;
	$video_url = get_post_meta($product->get_id(), 'ts_prod_video_url', true);
	if( $video_url ){
		echo '<a class="ts-product-video-button" href="#" data-product_id="'.$product->get_id().'">'.esc_html__('Video', 'agrofood').'</a>';
		add_action('wp_footer', 'agrofood_add_product_video_popup_modal', 999);
	}
	
	$gallery_360 = get_post_meta($product->get_id(), 'ts_prod_360_gallery', true);
	if( $gallery_360 ){
		$galleries = array_map('trim', explode(',', $gallery_360));
		$image_array = array();
		foreach($galleries as $gallery ){
			$image_src = wp_get_attachment_image_url($gallery, 'woocommerce_single');
			if( $image_src ){
				$image_array[] = "'" . $image_src . "'";
			}
		}
		wp_enqueue_script('threesixty');
		wp_add_inline_script('threesixty', 'var _ts_product_360_image_array = ['.implode(',', $image_array).'];');
		
		echo '<a class="ts-product-360-button" href="#">'.esc_html__('360', 'agrofood').'</a>';
		add_action('wp_footer', 'agrofood_add_product_360_popup_modal', 999);
	}
}

function agrofood_add_product_video_popup_modal(){
	?>
	<div id="ts-product-video-modal" class="ts-popup-modal">
		<div class="overlay"></div>
		<div class="product-video-container popup-container">
			<span class="close"><?php esc_html_e('Close ', 'agrofood'); ?></span>
			<div class="product-video-content"></div>
		</div>
	</div>
	<?php
}

function agrofood_add_product_360_popup_modal(){
	?>
	<div id="ts-product-360-modal" class="ts-popup-modal">
		<div class="overlay"></div>
		<span class="close"><?php esc_html_e('Close ', 'agrofood'); ?></span>
		<div class="product-360-container popup-container">
			<div class="product-360-content"><?php agrofood_load_product_360(); ?></div>
		</div>
	</div>
	<?php
}

function agrofood_add_classes_to_single_product_thumbnail( $classes ){
	global $product;
	$video_url = get_post_meta($product->get_id(), 'ts_prod_video_url', true);
	if( $video_url ){
		$classes[] = 'has-video';
	}
	$gallery_360 = get_post_meta($product->get_id(), 'ts_prod_360_gallery', true);
	if( $gallery_360 ){
		$classes[] = 'has-360-gallery';
	}
	
	return $classes;
}

function agrofood_product_gallery_thumbnail_size(){
	return 'woocommerce_thumbnail';
}

/* Single Product Video - Register ajax */
function agrofood_load_product_video_callback(){
	if( empty($_POST['product_id']) ){
		die( esc_html__('Invalid Product', 'agrofood') );
	}
	
	$prod_id = absint($_POST['product_id']);

	if( $prod_id <= 0 ){
		die( esc_html__('Invalid Product', 'agrofood') );
	}
	
	$video_url = get_post_meta($prod_id, 'ts_prod_video_url', true);
	ob_start();
	if( !empty($video_url) ){
		echo do_shortcode('[ts_video src='.esc_url($video_url).']');
	}
	die( ob_get_clean() );
}

function agrofood_load_product_360(){
	?>
	<div class="threesixty ts-product-360">
		<div class="spinner">
			<span>0%</span>
		</div>
		<ol class="threesixty_images"></ol>
	</div>
	<?php
}

function agrofood_template_single_countdown(){
	if( agrofood_get_theme_options('ts_prod_count_down') && function_exists('ts_template_loop_time_deals') ){
		ts_template_loop_time_deals();
	}
}

function agrofood_template_single_navigation(){
	if( !agrofood_get_theme_options('ts_prod_next_prev_navigation') ){
		return;
	}
	$prev_post = get_adjacent_post(false, '', true, 'product_cat');
	$next_post = get_adjacent_post(false, '', false, 'product_cat');
	?>
	<div class="single-navigation">
	<?php 
		if( $prev_post ){
			$post_id = $prev_post->ID;
			$product = wc_get_product($post_id);
			?>
			<a href="<?php echo esc_url(get_permalink($post_id)); ?>" rel="prev">
				<div class="product-info prev-product-info">
					<?php echo wp_kses( $product->get_image(), 'agrofood_product_image' ); ?>
				</div>
				<span class="prev-title"><?php esc_html_e('Prev product', 'agrofood'); ?></span>
			</a>
			<?php
		}
		
		if( $next_post ){
			$post_id = $next_post->ID;
			$product = wc_get_product($post_id);
			?>
			<a href="<?php echo esc_url(get_permalink($post_id)); ?>" rel="next">
				<div class="product-info next-product-info">
					<?php echo wp_kses( $product->get_image(), 'agrofood_product_image' ); ?>
				</div>
				<span class="next-title"><?php esc_html_e('Next product', 'agrofood'); ?></span>
			</a>
			<?php
		}
	?>
	</div>
	<?php
}

function agrofood_before_single_product_summary_column_2(){
	if( agrofood_get_theme_options('ts_prod_layout_style') == 'product-style-1' ){
		echo '<div class="summary-column-2">';
	}
}

function agrofood_after_single_product_summary_column_2(){
	if( agrofood_get_theme_options('ts_prod_layout_style') == 'product-style-1' ){
		agrofood_single_product_delivery_note();	
		echo '</div>';
	}
}

function agrofood_template_single_variation_price(){
	if( agrofood_get_theme_options('ts_prod_price') ){
		echo '<div class="ts-variation-price hidden"></div>';
	}
}

function agrofood_variation_attribute_options_args( $args ){
	if( !agrofood_get_theme_options('ts_prod_attr_dropdown') ){
		$args['class'] = 'hidden';
	}
	return $args;
}

function agrofood_get_color_variation_thumbnails(){
	global $product;
	$color_variation_thumbnails = array();
	
	$attribute_name = wc_attribute_taxonomy_name( 'color' );
	$variation_attribute_name = wc_variation_attribute_name( $attribute_name );
	
	$children = $product->get_children();
	if( is_array($children) && count($children) > 0 ){
		foreach( $children as $children_id ){
			$variation_attributes = wc_get_product_variation_attributes( $children_id );
			foreach( $variation_attributes as $attr_name => $attr_value ){
				if( $attr_name == $variation_attribute_name ){
					if( !$attr_value ){ /* Any */
						break;
					}
					if( in_array( $attr_value, array_keys($color_variation_thumbnails) ) ){
						break;
					}
					
					$thumbnail_id = get_post_meta( $children_id, '_thumbnail_id', true );
					if( $thumbnail_id ){
						$thumbnail = wp_get_attachment_image($thumbnail_id, 'woocommerce_thumbnail');
					}
					else{
						$thumbnail = wc_placeholder_img();
					}
					
					$color_variation_thumbnails[$attr_value] = $thumbnail;
					
					break;
				}
			}
		}
	}
	
	return $color_variation_thumbnails;
}

function agrofood_variation_attribute_options_html( $html, $args ){
	$theme_options = agrofood_get_theme_options();
	
	if( $theme_options['ts_prod_attr_dropdown'] ){
		return $html;
	}
	
	global $product;
	
	$attr_color_text = $theme_options['ts_prod_attr_color_text'];
	$use_variation_thumbnail = $theme_options['ts_prod_attr_color_variation_thumbnail'];
	
	$options = $args['options'];
	$attribute_name = $args['attribute'];
	
	ob_start();
	
	if( is_array( $options ) ){
	?>
		<div class="ts-product-attribute">
		<?php 
		$selected_key = 'attribute_' . sanitize_title( $attribute_name );
		
		$selected_value = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $product->get_variation_default_attribute( $attribute_name );
		
		// Get terms if this is a taxonomy - ordered
		if( taxonomy_exists( $attribute_name ) ){
			
			$class = 'option';
			$is_attr_color = false;
			$attribute_color = wc_sanitize_taxonomy_name( 'color' );
			if( $attribute_name == wc_attribute_taxonomy_name( $attribute_color ) ){
				if( !$attr_color_text ){
					$is_attr_color = true;
					$class .= ' color';
					
					if( $use_variation_thumbnail ){
						$color_variation_thumbnails = agrofood_get_color_variation_thumbnails();
					}
				}
				else{
					$class .= ' text';
				}
			}
			$terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'all' ) );

			foreach ( $terms as $term ) {
				if ( ! in_array( $term->slug, $options ) ) {
					continue;
				}
				$term_name = apply_filters( 'woocommerce_variation_option_name', $term->name );
				
				if( $is_attr_color && !$use_variation_thumbnail ){
					$datas = get_term_meta( $term->term_id, 'ts_product_color_config', true );
					if( $datas ){
						$datas = unserialize( $datas );	
					}else{
						$datas = array(
									'ts_color_color' 				=> "#ffffff"
									,'ts_color_image' 				=> 0
								);
					}
				}
				
				$selected_class = sanitize_title( $selected_value ) == sanitize_title( $term->slug ) ? 'selected' : '';
				
				echo '<div data-value="' . esc_attr( $term->slug ) . '" class="'. $class .' '. $selected_class .'">';
				
				if( $is_attr_color ){
					if( $use_variation_thumbnail ){
						if( isset($color_variation_thumbnails[$term->slug]) ){
							echo '<a href="#">' . $color_variation_thumbnails[$term->slug] . '<span class="ts-tooltip button-tooltip">' . $term_name . '</span></a>';
						}
					}
					else{
						if( absint($datas['ts_color_image']) > 0 ){
							echo '<a href="#">' . wp_get_attachment_image( absint($datas['ts_color_image']), 'ts_prod_color_thumb', true, array('title' => $term_name, 'alt' => $term_name) ) . '<span class="ts-tooltip button-tooltip">' . $term_name . '</span></a>';
						}
						else{
							echo '<a href="#" style="background-color:' . $datas['ts_color_color'] . '"><span class="ts-tooltip button-tooltip">' . $term_name . '</span></a>';
						}
					}
				}
				else{
					echo '<a href="#">' . $term_name . '</a>';
				}
				
				echo '</div>';
			}

		} else {
			foreach( $options as $option ){
				$class = 'option';
				$class .= sanitize_title( $selected_value ) == sanitize_title( $option ) ? ' selected' : '';
				echo '<div data-value="' . esc_attr( $option ) . '" class="' . $class . '"><a href="#">' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</a></div>';
			}
		}
		?>
	</div>
	<?php
	}
	
	return ob_get_clean() . $html;
}

function agrofood_template_single_sku(){
	global $product;
	if( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ){
		echo '<div class="sku-wrapper product_meta"><span>' . esc_html__( 'SKU', 'agrofood' ) . '</span><span class="sku">' . (( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'agrofood' )) . '</span></div>';
	}
}

function agrofood_template_single_availability(){
	global $product;
	$theme_options = agrofood_get_theme_options();

	$product_stock = $product->get_availability();
	$availability_text = empty($product_stock['availability'])?esc_html__('In stock', 'agrofood'):esc_attr($product_stock['availability']);
	?>
		<div class="availability stock <?php echo esc_attr($product_stock['class']); ?>" data-original="<?php echo esc_attr($availability_text) ?>" data-class="<?php echo esc_attr($product_stock['class']) ?>">	
		<span><?php esc_html_e('Quantity', 'agrofood'); ?></span>
		<?php if( apply_filters('agrofood_show_product_availability', true ) ){ ?>
			<span class="availability-text"><?php echo esc_html($availability_text); ?></span>
		<?php } ?>
		</div>
	<?php
}

function agrofood_template_single_meta(){
	global $product;
	$theme_options = agrofood_get_theme_options();
	
	echo '<div class="meta-content">';
		do_action( 'woocommerce_product_meta_start' );
		if( $theme_options['ts_prod_cat'] ){
			echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="cats-link"><span>' . esc_html__( 'Categories', 'agrofood' ) . '</span><span class="cat-links">', '</span></div>' );
		}
		if( $theme_options['ts_prod_tag'] ){
			echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tags-link"><span>' . esc_html__( 'Tags', 'agrofood' ) . '</span><span class="tag-links">', '</span></div>' );	
		}
		if( $theme_options['ts_prod_sku'] ){
			agrofood_template_single_sku();
		}
		do_action( 'woocommerce_product_meta_end' );
	echo '</div>';
}

/************************************* 
* Group single product buttons sharing 
* Start div 31
* Wishlist 31
* Compare 35
* Ask about product 40
* Close div buttons 41
* Sharing 70
* Close div 71
*************************************/
function agrofood_single_product_buttons_sharing_start(){
	?>
	<div class="single-product-buttons-sharing">
		<div class="single-product-buttons">
	<?php
}

function agrofood_single_product_buttons_end(){
	?>
	</div>
	<?php
}

function agrofood_single_product_buttons_sharing_end(){
	?>
	</div>
	<?php
}

function agrofood_mysql_version_greater_8(){
	if( function_exists('wc_get_server_database_version') ){
		$database_version = wc_get_server_database_version();
		$number = isset($database_version['number']) ? $database_version['number'] : '';
		if( $number ){
			if( version_compare( $number, '8.0.0', '>=' ) ){
				return true;
			}
		}
	}
	return false;
}

/*** Product tab ***/
function agrofood_product_remove_tabs( $tabs = array() ){
	if( !agrofood_get_theme_options('ts_prod_tabs') ){
		return array();
	}
	if( agrofood_get_theme_options('ts_prod_separate_reviews_tab') ){
		unset( $tabs['reviews'] );
	}
	return $tabs;
}

function agrofood_add_product_custom_tab( $tabs = array() ){
	global $post;
	$theme_options = agrofood_get_theme_options();
	$override_custom_tab = get_post_meta( $post->ID, 'ts_prod_custom_tab', true );
	
	if( $theme_options['ts_prod_custom_tab'] || $override_custom_tab ){
		if( $override_custom_tab ){
			$custom_tab_title = get_post_meta( $post->ID, 'ts_prod_custom_tab_title', true );
			$custom_tab_content = get_post_meta( $post->ID, 'ts_prod_custom_tab_content', true );
		}
		else{
			$custom_tab_title = $theme_options['ts_prod_custom_tab_title'];
			$custom_tab_content = $theme_options['ts_prod_custom_tab_content'];
		}

		if( $custom_tab_title && $theme_options['ts_prod_tabs_show_content_default'] ){
			add_filter('agrofood_woocommerce_custom_tab_heading', function($arg) use ($custom_tab_title) { 
				return $custom_tab_title; 
			});
		}

		if( $custom_tab_content ){
			add_filter('agrofood_woocommerce_custom_tab_content', function($arg) use ($custom_tab_content) {
				return $custom_tab_content;
			});
		}

		if( $custom_tab_title || $custom_tab_content ){
			$tabs['ts_custom'] = array(
				'title'    	=> esc_html( $custom_tab_title )
				,'priority' => 25
				,'callback' => 'agrofood_product_custom_tab_content'
			);
		}
	}

	return $tabs;
}

function agrofood_product_custom_tab_content(){
	global $post;

	$custom_tab_heading = apply_filters( 'agrofood_woocommerce_custom_tab_heading', '' );
	$custom_tab_content = apply_filters( 'agrofood_woocommerce_custom_tab_content', '' );

	if( $custom_tab_heading ){
		echo '<h2>'. esc_html( $custom_tab_heading ) .'</h2>';
	}
	if( $custom_tab_content ){
		echo do_shortcode( stripslashes( wp_specialchars_decode( $custom_tab_content ) ) );
	}
}

/* Ads Banner */
function agrofood_product_ads_banner(){
	if( agrofood_get_theme_options('ts_prod_ads_banner') ){
		echo '<div class="ads-banner">';
		echo do_shortcode( stripslashes( wp_specialchars_decode( agrofood_get_theme_options('ts_prod_ads_banner_content') ) ) );
		echo '</div>';
	}
}

/* Newsletter */
function agrofood_product_newsletter(){
	$theme_options = agrofood_get_theme_options();

	if( $theme_options['ts_prod_newsletter'] && $theme_options['ts_prod_newsletter_forms'] ){ ?>
	<div class="ts-mailchimp-subscription-shortcode text-center text-default">
		<div class="widget-container mailchimp-subscription">
			<?php if( $theme_options['ts_prod_newsletter_title'] ){ ?>
			<div class="widget-title-wrapper">
				<h3 class="widget-title heading-title">
				<?php echo esc_html( $theme_options['ts_prod_newsletter_title'] ); ?>
				</h3>
			</div>
			<?php } ?>
			<div class="subscribe-widget">
				<?php
					echo do_shortcode('[mc4wp_form id="'.$theme_options['ts_prod_newsletter_forms'].'"]');
				?>
			</div>
		</div>
	</div>
	<?php }
}

/* Instagram */
function agrofood_product_instagram(){
	if( !class_exists('TS_Instagram') || !agrofood_get_theme_options('ts_prod_instagram') ){
		return;
	}

	$title = agrofood_get_theme_options('ts_prod_instagram_title');
	$access_token = agrofood_get_theme_options('ts_prod_instagram_access_token');
	$number = 9;
	$column = 9;
	$target = '_self';

	$instagramObj = new TS_Instagram();

	$instagramObj->set_base_access_token( $access_token );
	$instagramObj->set_number( $number );

	$media_array = array();
	
	if( $instagramObj->base_access_token ){ 
		$instagramObj->maybe_clean_token();
		$refresh_result = $instagramObj->maybe_refresh_token();
		if( is_wp_error($refresh_result) ){
			echo esc_html( $refresh_result->get_error_message() );
			$instagramObj->base_access_token = ''; // dont get data
		}
	}
	
	if( $instagramObj->base_access_token ){
		$media_array = $instagramObj->get_data_with_token();
		if( is_wp_error( $media_array ) ){
			echo esc_html( $media_array->get_error_message() );
		}
	}

	if( !is_wp_error( $media_array ) && !empty( $media_array ) ){
		ob_start();
		
		$classes = array();
		$data_attr = array();

		$classes[] = 'ts-instagram-wrapper items';
		$classes[] = 'columns-' . $column;
		$classes[] = 'ts-slider loading';
		
		$data_attr[] = 'data-nav="1"';
		$data_attr[] = 'data-autoplay="0"';
		$data_attr[] = 'data-columns="'.absint($column).'"';
	
		?>

		<div class="ts-instagram-shortcode">
			<?php 
			if( $title ){ ?>
			<h5><?php echo esc_html( $title ); ?></h5>
			<?php } ?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo implode(' ', $data_attr); ?>>
				<?php foreach( $media_array as $index => $item ){
					$item_class = '';
					if( $index % $column == 0 ){
						$item_class = 'first';
					}
					elseif( $index % $column == ($column - 1) ){
						$item_class = 'last';
					}
				?>
				<div class="item <?php echo esc_attr($item_class); ?>">
					<a href="<?php echo esc_url( $item['permalink'] ) ?>" target="<?php echo esc_attr( $target ) ?>">
						<img src="<?php echo esc_url( $item['media_url'] ) ?>" alt="<?php echo esc_attr( $item['caption'] ) ?>" title="<?php echo esc_attr( $item['caption'] ) ?>" />
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php
		echo ob_get_clean();
	}
}

/* Related Products */
function agrofood_output_related_products_args_filter( $args ){
	$args['posts_per_page'] = 9;
	$args['columns'] = 8;
	return $args;
}

/* New Arrival Products */
function agrofood_new_arrival_products( $heading = '', $args = array() ){

	if( !class_exists('WooCommerce') ){
		return;
	}

	if( is_singular('product') && !agrofood_get_theme_options('ts_prod_new_arrivals') ){
		return;
	}
	
	$default = array(
		'post_type'				=> 'product'
		,'post_status' 			=> 'publish'
		,'posts_per_page' 		=> apply_filters('agrofood_new_arrival_products_limit', 9)
		,'orderby' 				=> 'date'
		,'order' 				=> 'desc'
		,'meta_query' 			=> WC()->query->get_meta_query()
		,'tax_query' 			=> WC()->query->get_tax_query()
	);

	$default['tax_query'][] = array(		
		'taxonomy' => 'product_visibility'
		,'field'    => 'name'
		,'terms'    => 'featured'
		,'operator' => 'IN'
	);

	if( $heading == '' ){
		$heading = __('Featured products', 'agrofood');
	}

	$args = wp_parse_args( $args, $default );

	$products = new WP_Query( $args );
	
	if( $products->have_posts() ){
	?>
	<section class="woocommerce related products new-arrivals">
		<h2><?php echo esc_html( $heading ); ?></h2>
		<?php
		woocommerce_product_loop_start();
		while( $products->have_posts() ){
			$products->the_post();
			wc_get_template_part( 'content', 'product' );
		}
		woocommerce_product_loop_end();
		?>
	</section>
	<?php
	}
	
	wp_reset_postdata();
}

/* Change grouped product columns */
function agrofood_woocommerce_grouped_product_columns( $columns ){
	$columns = array('label', 'price', 'quantity');
	return $columns;
}

/*** General hook ***/

/*************************************************************
* Custom group button on product (quickshop, wishlist, compare) 
* Begin tag: 	10000
* Wishlist: 	10001
* Compare:   	10002
* Quickshop:  	10003
* Add To Cart: 	10004
* End tag:   	10005
**************************************************************/
function agrofood_product_group_button_start(){	
	echo '<div class="product-group-button">';
}

function agrofood_product_group_button_end(){
	echo '</div>';
}

add_action('init', 'agrofood_wrap_product_group_button', 20);
function agrofood_wrap_product_group_button(){
	add_action('woocommerce_after_shop_loop_item_title', 'agrofood_product_group_button_start', 10000);
	add_action('woocommerce_after_shop_loop_item_title', 'agrofood_product_group_button_end', 10005);
	
	if( agrofood_get_theme_options('ts_product_hover_style') == 'hover-vertical-style' ){
		add_action('woocommerce_after_shop_loop_item_title', 'agrofood_template_loop_add_to_cart', 10004);
	}
}

/* Wishlist */
if( class_exists('YITH_WCWL') ){
	function agrofood_add_wishlist_button_to_product_list(){
		echo '<div class="button-in wishlist">';
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		echo '</div>';
	}
	
	if( 'yes' == get_option( 'yith_wcwl_show_on_loop', 'no' ) ){
		add_action( 'woocommerce_after_shop_loop_item_title', 'agrofood_add_wishlist_button_to_product_list', 10001 );
	
		add_filter( 'yith_wcwl_loop_positions', '__return_empty_array' ); /* Remove button which added by plugin */
	}
	
	add_filter('yith_wcwl_add_to_wishlist_params', 'agrofood_yith_wcwl_add_to_wishlist_params');
	function agrofood_yith_wcwl_add_to_wishlist_params( $additional_params ){
		if( isset($additional_params['container_classes']) && $additional_params['exists'] ){
			$additional_params['container_classes'] .= ' added';
		}
		$additional_params['label'] = '<span class="ts-tooltip button-tooltip" data-title="'.esc_attr__('Add to wishlist', 'agrofood').'">' . esc_html__('Wishlist', 'agrofood') . '</span>';
		return $additional_params;
	}
	
	add_filter('yith_wcwl_browse_wishlist_label', 'agrofood_yith_wcwl_browse_wishlist_label', 10, 2);
	function agrofood_yith_wcwl_browse_wishlist_label( $text = '', $product_id = 0 ){
		if( $product_id ){
			return '<span class="ts-tooltip button-tooltip" data-title="'.esc_attr__('Add to wishlist', 'agrofood').'">' . esc_html__('Wishlist', 'agrofood') . '</span>';
		}
		return $text;
	}
}

/* Compare */
if( class_exists('YITH_Woocompare') ){
	add_action('init', 'agrofood_yith_compare_handle', 30);
	function agrofood_yith_compare_handle(){
		global $yith_woocompare;
		$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
		if( $yith_woocompare->is_frontend() || $is_ajax ){
			if( get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ){
				if( $is_ajax ){
					if( defined('YITH_WOOCOMPARE_DIR') && !class_exists('YITH_Woocompare_Frontend') ){
						$compare_frontend_class = YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php';
						if( file_exists($compare_frontend_class) ){
							require_once $compare_frontend_class;
						}
						$yith_woocompare->obj = new YITH_Woocompare_Frontend();
					}
				}
				remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );

				add_action( 'woocommerce_after_shop_loop_item_title', 'agrofood_add_compare_button_to_product_list', 10002 );
			}
			
			add_filter( 'option_yith_woocompare_button_text', 'agrofood_compare_button_text_filter', 99 );
		}
	}
	
	function agrofood_add_compare_button_to_product_list(){
		global $yith_woocompare, $product;
		echo '<div class="button-in compare">';
		echo '<a class="compare" href="'.$yith_woocompare->obj->add_product_url( $product->get_id() ).'" data-product_id="'.$product->get_id().'">'.get_option('yith_woocompare_button_text').'</a>';
		echo '</div>';
	}
	
	function agrofood_compare_button_text_filter( $button_text ){
		return '<span class="ts-tooltip button-tooltip" data-title="'.esc_attr__('Add to compare', 'agrofood').'">'.esc_html($button_text).'</span>';
	}
}

/*************************************************************
* Group button on product meta (add to cart, wishlist, compare) 
* Begin tag: 30
* Add to cart: 40
* Compare: 60
* quicklist: 50
* End tag: 70
*************************************************************/
add_action('woocommerce_after_shop_loop_item_2', 'agrofood_product_group_button_meta_start', 30);
add_action('woocommerce_after_shop_loop_item_2', 'agrofood_product_group_button_meta_end', 70);
function agrofood_product_group_button_meta_start(){
	echo '<div class="product-group-button-meta">';
}
function agrofood_product_group_button_meta_end(){
	echo '</div>';
}
/*** End General hook ***/

/*** Quantity Input hooks ***/
add_action('woocommerce_before_quantity_input_field', 'agrofood_before_quantity_input_field', 1);
function agrofood_before_quantity_input_field(){
	?>
	<div class="number-button">
		<input type="button" value="-" class="minus" />
	<?php
}

add_action('woocommerce_after_quantity_input_field', 'agrofood_after_quantity_input_field', 99);
function agrofood_after_quantity_input_field(){
	?>
		<input type="button" value="+" class="plus" />
	</div>
	<?php
}

/*** Cart - Checkout hooks ***/
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 10 );

add_action('woocommerce_cart_actions', 'agrofood_empty_cart_button');
function agrofood_empty_cart_button(){
?>
	<button type="submit" class="button empty-cart-button" name="ts_empty_cart" value="<?php esc_attr_e('Empty cart', 'agrofood'); ?>"><?php esc_html_e('Empty cart', 'agrofood'); ?></button>
<?php
}

add_action('init', 'agrofood_empty_woocommerce_cart');
function agrofood_empty_woocommerce_cart(){
	if( isset($_POST['ts_empty_cart']) ){
		WC()->cart->empty_cart();
	}
}

add_action('woocommerce_before_checkout_form', 'agrofood_before_checkout_form_start', 1);
add_action('woocommerce_before_checkout_form', 'agrofood_before_checkout_form_end', 999);
function agrofood_before_checkout_form_start(){
	echo '<div class="checkout-login-coupon-wrapper">';
}
function agrofood_before_checkout_form_end(){
	echo '</div>';
}

remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
add_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 20);

remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
add_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 1000);

if( !( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) ){
	add_action('woocommerce_before_checkout_form', function(){
		echo '<div class="checkout-login-wrapper">';
	}, 9);
	add_action('woocommerce_before_checkout_form', function(){
		echo '</div>';
	}, 11);
}

if( function_exists('wc_coupons_enabled') && wc_coupons_enabled() ){
	add_action('woocommerce_before_checkout_form', function(){
		echo '<div class="checkout-coupon-wrapper">';
	}, 19);
	add_action('woocommerce_before_checkout_form', function(){
		echo '</div>';
	}, 21);
}
?>