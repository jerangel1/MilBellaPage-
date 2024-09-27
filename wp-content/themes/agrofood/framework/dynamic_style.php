<?php
if( !isset($data) ){
	$data = agrofood_get_theme_options();
}

update_option('ts_load_dynamic_style', 0);

$default_options = array(
				'ts_enable_rtl'					=> 0
				,'ts_layout_fullwidth'			=> 0
				,'ts_enable_search'				=> 1
				,'ts_search_style' 				=> 'search-default'
				,'ts_logo_width'				=> "190"
				,'ts_device_logo_width'			=> "160"
				,'ts_custom_font_ttf'			=> array( 'url' => '' )
		);
		
foreach( $default_options as $option_name => $value ){
	if( isset($data[$option_name]) ){
		$default_options[$option_name] = $data[$option_name];
	}
}

extract($default_options);
		
$default_colors = array(
				'ts_primary_color'											=> '#00B412'
				,'ts_text_color_in_bg_primary'								=> '#ffffff'
				,'ts_primary_light_color'									=> '#ECFDEE'
				,'ts_secondary_color'										=> '#00B412'
				,'ts_text_color_in_bg_secondary'							=> '#ffffff'
				,'ts_secondary_light_color'									=> '#ECFDEE'
				,'ts_main_content_background_color'							=> '#ffffff'
				,'ts_text_color'											=> '#000000'
				,'ts_text_light_color'										=> '#ffffff'
				,'ts_text_gray_color'										=> '#808080'
				,'ts_heading_color'											=> '#000000'
				,'ts_link_color'											=> '#00B412'
				,'ts_link_color_hover'										=> '#00B412'
				,'ts_blockquote_color'										=> '#000000'
				,'ts_blockquote_background_color'							=> '#FFF6EC'
				,'ts_tag_color'												=> '#000000'
				,'ts_tag_background_color'									=> '#ffffff'
				,'ts_tag_border_color'										=> '#e5dada'
				,'ts_border_color'											=> '#e5e5e5'
				,'ts_input_text_color'										=> '#000000'
				,'ts_input_background_color'								=> '#f2f2f2'
				,'ts_button_text_color'										=> '#ffffff'
				,'ts_button_background_color'								=> '#00B412'
				,'ts_breadcrumb_background_color'							=> '#ffffff'
				,'ts_breadcrumb_text_color'									=> '#000000'
				,'ts_breadcrumb_link_color'									=> '#808080'
				,'ts_notice_text_color'										=> '#ffffff'
				,'ts_notice_background_color'								=> '#FF6D22'
				,'ts_notice_border_color'									=> '#FF6D22'
				,'ts_header_text_color'										=> '#000000'
				,'ts_header_text_gray_color'								=> '#808080'
				,'ts_header_background_color'								=> '#ffffff'
				,'ts_header_border_color'									=> '#e5e5e5'
				,'ts_header_icon_color'										=> '#000000'
				,'ts_header_icon_count_bg_color'							=> '#00B412'
				,'ts_header_icon_count_color'								=> '#ffffff'
				,'ts_header_social_icon_color'								=> '#000000'
				,'ts_header_search_color'									=> '#000000'
				,'ts_header_search_background_color'						=> '#F0F0F0'
				,'ts_header_search_placeholder_color'						=> '#4d4d4d'
				,'ts_footer_text_color'										=> '#000000'
				,'ts_footer_background_color'								=> '#f7f7f7'
				,'ts_footer_border_color'									=> '#e6e6e6'
				,'ts_products_wrapper_background'							=> '#f7f7f7'
				,'ts_products_background'									=> '#ffffff'
				,'ts_products_text_color'									=> '#000000'
				,'ts_product_price_color'									=> '#000000'
				,'ts_product_del_price_color'								=> '#999999'
				,'ts_product_sale_price_color'								=> '#00B412'
				,'ts_product_detail_summary_border_color'					=> '#f0f2f5'
				,'ts_rating_color'											=> '#cccccc'
				,'ts_rating_fill_color'										=> '#FF6D22'
				,'ts_product_button_thumbnail_text_color'					=> '#000000'
				,'ts_product_button_thumbnail_background_color'				=> '#ffffff'
				,'ts_product_button_thumbnail_text_hover'					=> '#FE7934'
				,'ts_product_sale_label_text_color'							=> '#ffffff'
				,'ts_product_sale_label_background_color'					=> '#00B412'
				,'ts_product_new_label_text_color'							=> '#ffffff'
				,'ts_product_new_label_background_color'					=> '#FE7934'
				,'ts_product_feature_label_text_color'						=> '#ffffff'
				,'ts_product_feature_label_background_color'				=> '#CB1800'
				,'ts_product_outstock_label_text_color'						=> '#ffffff'
				,'ts_product_outstock_label_background_color'				=> '#9a9a9a'
				,'ts_product_group_button_fixed_background_color'			=> '#ffffff'
				,'ts_product_group_button_fixed_color'						=> '#000000'
				,'ts_product_group_button_fixed_border_color'				=> '#d9d9d9'
				,'ts_menu_mobile_background_color'							=> '#ffffff'
				,'ts_menu_mobile_text_color'								=> '#000000'				
);

$data = apply_filters('agrofood_custom_style_data', $data);

foreach( $default_colors as $option_name => $default_color ){
	if( isset($data[$option_name]['rgba']) ){
		$default_colors[$option_name] = $data[$option_name]['rgba'];
	}
	else if( isset($data[$option_name]['color']) ){
		$default_colors[$option_name] = $data[$option_name]['color'];
	}
}

extract( $default_colors );

/* Parse font option. Ex: if option name is ts_body_font, we will have variables below:
* ts_body_font (font-family)
* ts_body_font_weight
* ts_body_font_style
* ts_body_font_size
* ts_body_font_line_height
* ts_body_font_letter_spacing
*/
$font_option_names = array(
							'ts_body_font',
							'ts_body_font_medium',
							'ts_body_font_black',
							'ts_heading_font',
							'ts_menu_font',
							'ts_sub_menu_font',
							);
$font_size_option_names = array( 
							'ts_h1_font', 
							'ts_h2_font', 
							'ts_h3_font', 
							'ts_h4_font', 
							'ts_h5_font', 
							'ts_h6_font',
							'ts_product_font',
							'ts_button_font',
							'ts_input_font',
							'ts_h1_ipad_font', 
							'ts_h2_ipad_font', 
							'ts_h3_ipad_font', 
							'ts_h4_ipad_font',
							'ts_h5_ipad_font',
							'ts_h6_ipad_font',
							'ts_menu_ipad_font',
							'ts_button_ipad_font',
							'ts_input_ipad_font',
							);
$font_option_names = array_merge($font_option_names, $font_size_option_names);
foreach( $font_option_names as $option_name ){
	$default = array(
		$option_name 						=> 'inherit'
		,$option_name . '_weight' 			=> 'normal'
		,$option_name . '_style' 			=> 'normal'
		,$option_name . '_size' 			=> 'inherit'
		,$option_name . '_line_height' 		=> 'inherit'
		,$option_name . '_letter_spacing' 	=> 'inherit'
	);
	if( is_array($data[$option_name]) ){
		if( !empty($data[$option_name]['font-family']) ){
			$default[$option_name] = $data[$option_name]['font-family'];
		}
		if( !empty($data[$option_name]['font-weight']) ){
			$default[$option_name . '_weight'] = $data[$option_name]['font-weight'];
		}
		if( !empty($data[$option_name]['font-style']) ){
			$default[$option_name . '_style'] = $data[$option_name]['font-style'];
		}
		if( !empty($data[$option_name]['font-size']) ){
			$default[$option_name . '_size'] = $data[$option_name]['font-size'];
		}
		if( !empty($data[$option_name]['line-height']) ){
			$default[$option_name . '_line_height'] = $data[$option_name]['line-height'];
		}
		if( !empty($data[$option_name]['letter-spacing']) ){
			$default[$option_name . '_letter_spacing'] = $data[$option_name]['letter-spacing'];
		}
	}
	extract( $default );
}

/* Custom Font */
if( isset($ts_custom_font_ttf) && $ts_custom_font_ttf['url'] ):
?>
@font-face {
	font-family: 'CustomFont';
	src:url('<?php echo esc_url($ts_custom_font_ttf['url']); ?>') format('truetype');
	font-weight: normal;
	font-style: normal;
}
<?php endif; ?>	
	
	/*
		I. CUSTOM FONT FAMILY
		II. CUSTOM FONT SIZE
		III. CUSTOM COLOR
	*/
	header .logo img,
	header .logo-header img{
		width: <?php echo absint($ts_logo_width); ?>px;
	}
	@media only screen and (max-width: 1279px){
		header .logo img,
		header .logo-header img{
			width: <?php echo absint($ts_device_logo_width); ?>px;
		}
	}
	
	/*--------------------------------------------------------
		I. CUSTOM FONT FAMILY
	---------------------------------------------------------*/
	html,
	body,
	label,
	input,
	textarea,
	keygen,
	select,
	button,
	body .font-body,
	.ts-header nav.main-menu > ul.menu > li.font-body > a, 
	.ts-header nav.main-menu > ul > li.font-body > a,
	.price del, 
	.product-price del, 
	.woocommerce div.product p.price del, 
	.woocommerce div.product span.price del,
	.woocommerce div.product .yith-wfbt-section .yith-wfbt-form .price del,
	ul.product_list_widget li .price del,
	.woocommerce ul.product_list_widget li .price del,
	.woocommerce .widget_shopping_cart .cart_list li .price del,
	.woocommerce.widget_shopping_cart .cart_list li .price del,
	.ts-tiny-cart-wrapper .dropdown-container ul.cart_list li .price,
	.category-name .count,
	.portfolio-info .cat-links a,
	.mobile-menu-wrapper .mobile-menu .product,
	.ts-header .menu-wrapper .vertical-menu-wrapper .product,
	.ts-header .menu-wrapper .vertical-menu-wrapper .product,
	.ts-header .menu-wrapper .vertical-menu-wrapper .product,
	.ts-header .menu-wrapper .ts-menu .product,
	.single-portfolio .meta-content .portfolio-info > span:last-child,
	.single-portfolio .meta-content .portfolio-info > a:last-child,
	.woocommerce div.product form.cart .variations label,
	.ts-testimonial-wrapper blockquote .author-role,
	.style-tabs-default .column-tabs ul.tabs li,
	.style-tabs-vertical .column-tabs ul.tabs li,
	.ts-product-in-product-type-tab-wrapper .column-tabs ul.tabs li,
	body table.compare-list,
	.ts-testimonial-wrapper.style-default blockquote,
	.ts-list-of-product-categories-wrapper.style-horizontal h3.heading-title,
	.ts-blogs article .entry-title,
	.list-posts article .entry-title,
	.button-text:not(.ts-banner):not(.elementor-widget-button),
	.elementor-widget-button.button-text .elementor-button,
	.ts-search-result-container .view-all-wrapper a,
	.woocommerce .woocommerce-error .button,
	.woocommerce .woocommerce-info .button,
	.woocommerce .woocommerce-message .button,
	.woocommerce-page .woocommerce-error .button,
	.woocommerce-page .woocommerce-info .button,
	.woocommerce-page .woocommerce-message .button{
		font-family: <?php echo esc_html($ts_body_font); ?>;
		font-style: <?php echo esc_html($ts_body_font_style); ?>;
		font-weight: <?php echo esc_html($ts_body_font_weight); ?>;
		letter-spacing: <?php echo esc_html($ts_body_font_letter_spacing); ?>;
	}
	.product-style-3 .brand-info-wrapper h3,
	.product-per-page-form ul.perpage .perpage-current > span:last-child,
	.woocommerce .woocommerce-ordering .orderby-current,
	.woocommerce .woocommerce-ordering .orderby li a.current,
	.product-per-page-form ul.perpage ul li a.current,
	.product-filter-by-brand-wrapper select,
	.product-filter-by-brand-wrapper select option[selected="selected"],
	body #ts-filter-widget-area .select2-container--default .select2-selection--single .select2-selection__rendered .select2-selection__placeholder, 
	.woocommerce-page.archive #left-sidebar .select2-container--default .select2-selection--single .select2-selection__rendered .select2-selection__placeholder, 
	.woocommerce-page.archive #right-sidebar .select2-container--default .select2-selection--single .select2-selection__rendered .select2-selection__placeholder,
	#tab-description .ul-style.list-inline li,
	.ts-active-filters .widget_layered_nav_filters ul li a,
	.woocommerce-widget-layered-nav ul.woocommerce-widget-layered-nav-list > li > a,
	.woocommerce-widget-layered-nav ul li.chosen > a,
	.ts-product-categories-widget-wrapper ul.product-categories > li > a,
	.ts-product-categories-widget-wrapper ul li.current > a,
	.widget_product_categories ul.product-categories > li > a,
	.widget_product_categories ul li.current-cat > a,
	.ts-product-attribute > div.option:not(.color) > a{
		font-family: <?php echo esc_html($ts_body_font_medium); ?>;
		font-style: <?php echo esc_html($ts_body_font_medium_style); ?>;
		font-weight: <?php echo esc_html($ts_body_font_medium_weight); ?>;
	}
	strong,
	h1,h2,h3,
	h4,h5,h6,
	.h1,.h2,.h3,
	.h4,.h5,.h6,
	table thead th,
	table th,
	.woocommerce table.shop_table th,
	.woocommerce table.shop_table tbody th,
	.woocommerce table.shop_table tfoot th,
	body .wp-block-calendar table th,
	body blockquote,
	.ts-store-notice,
	.ts-tiny-cart-wrapper .total > span.total-title,
	.widget_shopping_cart .total-title,
	.woocommerce .widget_shopping_cart .total strong, 
	.woocommerce.widget_shopping_cart .total strong,
	.elementor-widget-wp-widget-woocommerce_widget_cart .total strong,
	.shopping-cart-wrapper .cart-control .cart-total,
	.my-account-wrapper .ts-style-text .account-control > a,
	.ts-testimonial-wrapper.style-default blockquote strong,
	#group-icon-header .tab-mobile-menu li,
	.ts-blogs article .entry-title,
	.list-posts article .entry-title,
	.ts-store-notice a,
	div.product .summary .tags-link a,
	.hightlight,
	.category-name .heading-title,
	.column-tabs ul.tabs li,
	.entry-author .author a,
	.comments-area .add-comment .comments-count,
	.meta-bottom-2 .single-navigation,
	ul.blog-filter-bar li.current,
	.counter-wrapper > div,
	.ts-portfolio-wrapper .filter-bar li.current,
	.cart-collaterals .cart_totals > h2,
	.cart_list .subtotal,
	.ts-tiny-cart-wrapper .total, 
	.widget_shopping_cart .total-title, 
	.price, 
	.product-price, 
	.woocommerce div.product p.price, 
	.woocommerce div.product span.price,
	ul.product_list_widget li .price,
	.woocommerce ul.product_list_widget li .price,
	.woocommerce .widget_shopping_cart .cart_list li .price,
	.woocommerce.widget_shopping_cart .cart_list li .price,
	.yith-wfbt-section .total_price,
	.woocommerce .widget_shopping_cart .total, 
	.woocommerce.widget_shopping_cart .total, 
	.elementor-widget-wp-widget-woocommerce_widget_cart .total,
	.woocommerce table.shop_table.shop_table_responsive.cart tr.cart_item td.product-subtotal,
	body .wishlist_table.images_grid li .item-details table.item-details-table td.label, 
	body .wishlist_table.mobile li .item-details table.item-details-table td.label, 
	body .wishlist_table.mobile li table.additional-info td.label, 
	body .wishlist_table.modern_grid li .item-details table.item-details-table td.label,
	.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong,
	.ts-list-of-product-categories-wrapper.style-horizontal > .list-categories ul li,
	#main-content .woocommerce.columns-1 > .products .product .product-name,
	#main-content .woocommerce.columns-1 > .products .product .meta-wrapper-2 .price,
	.woocommerce div.product p.price,
	.woocommerce div.product span.price,
	.woocommerce div.product .yith-wfbt-section .yith-wfbt-form .price,
	.woocommerce div.product .yith-wfbt-section .yith-wfbt-form .price ins,
	.woocommerce div.product form.cart div.quantity .screen-reader-text,
	.woocommerce #reviews .comment-reply-title,
	.woocommerce-tabs #reviews > .woocommerce-product-rating .review-count,
	div.product .single-navigation > a > span,
	.woocommerce-orders-table__cell-order-number,
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	html body > h1,
	.more-less-buttons a,
	.button,
	a.button,
	button,
	.ts-button,
	input[type^="submit"],
	.shopping-cart p.buttons a,
	a.wp-block-button__link,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce-page a.button,
	.woocommerce-page button.button,
	.woocommerce-page input.button,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce-page a.button.alt,
	.woocommerce-page button.button.alt,
	.woocommerce-page input.button.alt,
	.woocommerce #respond input#submit, 
	.yith-woocompare-widget a.clear-all,
	.yith-woocompare-widget a.compare,
	.elementor-button-wrapper .elementor-button,
	.elementor-widget-wp-widget-yith-woocompare-widget a.clear-all,
	.elementor-widget-wp-widget-yith-woocompare-widget a.compare,
	div.product .summary .meta-content > div > span:first-child,
	div.product .summary .detail-meta-top > div > span:first-child,
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	div.button a,
	input[type="submit"].dokan-btn, 
	a.dokan-btn, 
	.dokan-btn,
	.wishlist_table .product-add-to-cart a,
	body .woocommerce table.compare-list .add-to-cart td a,
	.woocommerce .woocommerce-error .button,
	.woocommerce .woocommerce-info .button,
	.woocommerce .woocommerce-message .button,
	.woocommerce-page .woocommerce-error .button,
	.woocommerce-page .woocommerce-info .button,
	.woocommerce-page .woocommerce-message .button,
	.woocommerce .product .category-name .count,
	.ts-product-brand-wrapper .item .count,
	.woocommerce .cart-collaterals .amount,
	.woocommerce-shipping-fields h3#ship-to-different-address,
	.ts-product-video-button,
	.ts-product-360-button,
	.portfolio-info > span:first-child,
	.woocommerce > form > fieldset legend,
	#ts-search-result-container .view-all-wrapper,
	.woocommerce form table.shop_table tbody th,
	.woocommerce form table.shop_table tfoot td,
	.woocommerce form table.shop_table tfoot th,
	.woocommerce table.shop_table ul#shipping_method .amount,
	.column-tabs ul.tabs li.current,
	.ts-product-in-product-type-tab-wrapper .column-tabs ul.tabs li.current,
	.product-group-button .button-tooltip,
	.ts-product-attribute .button-tooltip,
	.availability .availability-text,
	.view-all-wrapper a,
	.ts-shortcode a.view-more,
	.ts-portfolio-wrapper .item-wrapper a.like,
	.portfolio-info .portfolio-like,
	.tags-link a,
	.wp-block-tag-cloud a,
	.tagcloud a,
	.woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-items li span.checkboxbutton.checked, 
	.widget-container.product-filter-by-brand ul > li.selected label, 
	.product-filter-by-availability ul li input[checked="checked"] + label, 
	.product-filter-by-price ul li.chosen label, 
	.woocommerce .widget_rating_filter ul li.chosen a, 
	.product-filter-by-color ul li.chosen a,
	.product_list_widget .product-label > span.onsale,
	.product_list_widget .product-label > span,
	.woocommerce .product-label > span.onsale,
	.woocommerce .product-label > span,
	.dropdown-container .theme-title span,
	.my-wishlist-wrapper .tini-wishlist .count-number, 
	.shopping-cart-wrapper .cart-control .cart-number,
	.ts-pagination ul li a, 
	.ts-pagination ul li span, 
	.pagination-wrap ul.pagination > li > a, 
	.pagination-wrap ul.pagination > li > span, 
	.dokan-pagination-container .dokan-pagination li a, 
	.dokan-pagination-container .dokan-pagination li span, 
	.woocommerce nav.woocommerce-pagination ul li a, 
	.woocommerce nav.woocommerce-pagination ul li span,
	.pagination-wrap ul.pagination > li > a.prev,
	.pagination-wrap ul.pagination > li > a.next,
	.dokan-pagination-container .dokan-pagination li:first-child a,
	.dokan-pagination-container .dokan-pagination li:last-child a,
	.woocommerce nav.woocommerce-pagination ul li a.next,
	.woocommerce nav.woocommerce-pagination ul li a.prev,
	.ts-pagination ul li a.prev,
	.ts-pagination ul li a.next{
		font-family: <?php echo esc_html($ts_heading_font); ?>;
		font-style: <?php echo esc_html($ts_heading_font_style); ?>;
		font-weight: <?php echo esc_html($ts_heading_font_weight); ?>;
	}
	.ts-banner .box-content .banner-text strong{
		font-family: <?php echo esc_html($ts_body_font_black); ?>;
		font-style: <?php echo esc_html($ts_body_font_black_style); ?>;
		font-weight: <?php echo esc_html($ts_body_font_black_weight); ?>;
	}
	.mobile-menu-wrapper .mobile-menu,
	.ts-header .menu-wrapper .vertical-menu-wrapper,
	.ts-header .normal-menu nav.vertical-menu ul.sub-menu > li,
	.ts-header .menu-wrapper .ts-menu{
		font-family: <?php echo esc_html($ts_menu_font); ?>;
		font-style: <?php echo esc_html($ts_menu_font_style); ?>;
		font-weight: <?php echo esc_html($ts_menu_font_weight); ?>;
	}
	.mobile-menu-wrapper .mobile-menu ul.sub-menu,
	.ts-header .menu-wrapper .vertical-menu-wrapper ul.sub-menu,
	.ts-header .menu-wrapper .ts-menu ul.sub-menu{
		font-family: <?php echo esc_html($ts_sub_menu_font); ?>;
		font-style: <?php echo esc_html($ts_sub_menu_font_style); ?>;
		font-weight: <?php echo esc_html($ts_sub_menu_font_weight); ?>;
	}
	.widget_nav_menu li[class*="agrofood-"],
	.widget_nav_menu li[class*="fa-"],
	.mobile-menu-wrapper .mobile-menu li[class*="agrofood-"],
	.ts-header nav.main-menu li[class*="agrofood-"],
	.mobile-menu-wrapper .mobile-menu li[class*="fa-"],
	.ts-header nav.main-menu li[class*="fa-"]{
		font-family: <?php echo esc_html($ts_menu_font); ?> !important;
	}
	.product-name,
	h3.product-name,
	.product-name h3{
		font-family: <?php echo esc_html($ts_product_font); ?>;
		font-style: <?php echo esc_html($ts_product_font_style); ?>;
		font-weight: <?php echo esc_html($ts_product_font_weight); ?>;
	}
	.yith-wfbt-item .product-name,
	.ts-tiny-cart-wrapper .cart_list li .product-name,
	.woocommerce .ts-tiny-cart-wrapper .product-name,
	.woocommerce table.shop_table td.product-name{
		font-style: <?php echo esc_html($ts_body_font_style); ?>;
		font-weight: <?php echo esc_html($ts_body_font_weight); ?>;
	}
	
	/*--------------------------------------------------------
		II. CUSTOM FONT SIZE
	---------------------------------------------------------*/
	html,
	body,
	html body > h1,
	.ts-testimonial-wrapper.style-default blockquote strong,
	.ts-sidebar .widget_text small + a,
	.woocommerce-shipping-fields h3#ship-to-different-address,
	.ts-blogs-widget-wrapper .post-title,
	.list-posts .entry-content .button-readmore,
	.ts-blogs .entry-content .button-readmore,
	.yith-wfbt-form .yith-wfbt-submit-block .button,
	.commentlist li.comment .comment-actions strong{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
		line-height: <?php echo esc_html($ts_body_font_line_height); ?>;
	}
	.list-posts,
	.ts-blogs,
	.single-post > .entry-content > .content-wrapper{
		font-size: <?php echo esc_html( absint($ts_body_font_size) + 1 ) . 'px'; ?>;
	}
	.ts-store-notice,
	.footer-container,
	.entry-meta-middle,
	.entry-meta-bottom,
	.elementor-text-editor .boxed,
	.shopping-cart-wrapper .cart-control .cart-total,
	.ts-header nav.main-menu > ul.menu > li.font-body > a, 
	.ts-header nav.main-menu > ul > li.font-body > a,
	.mobile-menu-wrapper nav ul li.font-body > a,
	.ts-testimonial-wrapper.style-default blockquote,
	.style-tabs-default .column-tabs ul.tabs li,
	.style-tabs-vertical .column-tabs ul.tabs li,
	.woocommerce ul.cart_list li .price, 
	.woocommerce ul.product_list_widget li .price,
	.woocommerce > form.checkout #order_review,
	#group-icon-header .tab-mobile-menu li,
	.wishlist_table.mobile,
	ul.blog-filter-bar li,
	.woocommerce-cart article .woocommerce .cart-collaterals, 
	.ts-mailchimp-subscription-shortcode .mc4wp-form .subscribe-email .terms-conditions label,
	#group-icon-header .tab-mobile-menu li,
	.woocommerce-checkout #order_review,
	.woocommerce #reviews #comments ol.commentlist li .comment-text .description{
		font-size: <?php echo esc_html( absint($ts_body_font_size) - 1 ) . 'px'; ?>;
	}
	.header-language, 
	.header-currency,
	.ts-language-switcher,
	.ts-currency-switcher,
	.comment-meta .author,
	.commentlist li.comment .comment-actions,
	.comments-area .add-comment,
	.meta-bottom-2 .single-navigation,
	.product-group-button .button-tooltip,
	.ts-product-attribute .button-tooltip,
	body table.compare-list,
	.ts-product.style-grid.has-shop-more-button .shop-more .button-text:not(.ts-banner):not(.elementor-widget-button),
	.woocommerce > .woocommerce-order .woocommerce-customer-details, 
	.woocommerce .woocommerce-MyAccount-content .woocommerce-customer-details,
	.ts-testimonial-wrapper blockquote .author-role .author,
	.woocommerce ul.cart_list li .product-categories, 
	.woocommerce ul.cart_list li .product-brands, 
	.woocommerce ul.product_list_widget li .product-categories,
	.woocommerce ul.product_list_widget li .product-brands,
	.ts-active-filters,
	.woocommerce #reviews > .woocommerce-product-rating,
	.woocommerce .before-loop-wrapper,
	.brand-info-wrapper,
	.product-style-3 .brand-info-wrapper h3,
	#ts-quickshop-modal .woocommerce-product-details__short-description,
	#ts-filter-widget-area .ts-sidebar-content,
	.ts-search-result-container .view-all-wrapper a,
	#left-sidebar,
	#right-sidebar{
		font-size: <?php echo esc_html( absint($ts_body_font_size) - 1 ) . 'px'; ?>;
	}
	.column-tabs .shop-more .button-text,
	.ts-product-brand-info .show-all a,
	.woocommerce .widget_price_filter .price_slider_amount .price_label > span,
	.woocommerce .widget_price_filter .price_slider_amount .button{
		font-size: <?php echo esc_html( absint($ts_body_font_size) - 1 ) . 'px'; ?> !important;
	}
	small,
	.font-small,
	.font-small li,
	.breadcrumb-title-wrapper .breadcrumbs,
	.header-top,
	.comment-meta,
	#comment-wrapper .heading-title small,
	.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
	.widget_recent_entries .post-date,
	.single-portfolio .meta-content,
	.woocommerce ul.order_details li,
	.product-style-3 .brand-info-wrapper .description,
	.woocommerce-privacy-policy-text,
	.elementor-widget-wp-widget-recent-posts .post-date,
	.dokan-store-wrap .commentlist li p strong[itemprop="author"],
	.dokan-store-wrap .commentlist li p em.verified,
	.dokan-store-wrap .commentlist li p time,
	.ts-testimonial-wrapper blockquote .author-role{
		font-size: <?php echo esc_html( absint($ts_body_font_size) - 1 ) . 'px'; ?>;
	}
	.header-contact-info > strong{
		font-size: <?php echo esc_html( absint($ts_body_font_size) + 1 ) . 'px'; ?>;
	}

	/*** Menu ***/
	.ts-header .menu-wrapper .vertical-menu-wrapper .vertical-menu-heading,
	.ts-header .menu-wrapper .ts-menu,
	.ts-megamenu-container .elementor-widget-container > h5{
		font-size: <?php echo esc_html($ts_menu_font_size); ?>;
		line-height: <?php echo esc_html($ts_menu_font_line_height); ?>;
	}
	.mobile-menu-wrapper .mobile-menu li,
	.ts-header nav.main-menu li{
		line-height: <?php echo esc_html($ts_menu_font_line_height); ?> !important;
	}
	.mobile-menu-wrapper .mobile-menu ul.sub-menu,
	.ts-header .menu-wrapper .vertical-menu-wrapper .vertical-menu,
	.ts-header .menu-wrapper .ts-menu ul.sub-menu{
		font-size: <?php echo esc_html($ts_sub_menu_font_size); ?>;
		line-height: <?php echo esc_html($ts_sub_menu_font_line_height); ?>;
	}
	.ts-header .menu-wrapper .vertical-menu-wrapper .vertical-menu > ul > li{
		font-size: <?php echo esc_html( absint($ts_sub_menu_font_size) + 1 ) . 'px'; ?>;
	}
	.mobile-menu-wrapper .mobile-menu ul.sub-menu li,
	.ts-header nav.main-menu ul.sub-menu li{
		line-height: <?php echo esc_html($ts_sub_menu_font_line_height); ?> !important;
	}

	/*** Product ***/
	.product-name,
	h3.product-name,
	.product-name h3,
	.product .price del,
	.woocommerce div.product div.summary,
	.ts-product.style-list .product .price,
	.ts-product.style-list .product .price del,
	.ts-product.style-list .product .price ins,
	.main-products.style-column-list .product .price,
	.main-products.style-column-list .product .price del,
	.main-products.style-column-list .product .price ins,
	.woocommerce div.product .ts-product-brand-info .price,
	.woocommerce div.product .ts-product-brand-info .price del,
	.woocommerce div.product .ts-product-brand-info .price ins,
	.yith-wfbt-section,
	.woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-items li label > *{
		font-size: <?php echo esc_html($ts_product_font_size); ?>;
		line-height: <?php echo esc_html($ts_product_font_line_height); ?>;
	}
	.yith-wfbt-section .total_price_label{
		font-size: <?php echo esc_html($ts_product_font_size); ?>;
	}
	.product.product-category .product-wrapper{
		font-size: <?php echo esc_html( absint($ts_product_font_size) + 1 ) . 'px'; ?>;
	}
	.product-brands, 
	.product-sku, 
	.product-categories,
	.short-description,
	.product .availability,
	.ts-product-video-button,
	.ts-product-360-button,
	.woocommerce .product .category-name .count,
	.products .product .meta-wrapper > .count-rating,
	.woocommerce div.product .summary .woocommerce-product-rating,
	.woocommerce div.product form.cart .variations,
	.woocommerce div.product form.cart .reset_variations,
	.woocommerce div.product form.cart .single_variation_wrap,
	.woocommerce div.product .single-product-buttons-sharing .single-product-buttons,
	.woocommerce div.product .single-product-buttons-sharing .single-product-buttons a.added,
	.woocommerce div.product .single-product-buttons-sharing .single-product-buttons .added a:after,
	.woocommerce div.product .single-product-buttons-sharing .single-product-buttons .ts-tooltip:before{
		font-size: <?php echo esc_html( absint($ts_product_font_size) - 1 ) . 'px'; ?>;
	}
	div.product .summary .meta-content,
	div.product .summary .detail-meta-top{
		font-size: <?php echo esc_html( absint($ts_product_font_size) - 1 ) . 'px'; ?>;
	}

	/*** Button/input ***/
	input,
	textarea,
	keygen,
	select,
	select option,
	.woocommerce form .form-row input.input-text,
	.woocommerce form .form-row textarea,
	.dokan-form-control,
	.more-less-buttons a,
	.woocommerce-columns > h3,
	.hidden-title-form input[type="text"],
	body .select2-container--default .select2-selection--single .select2-selection__rendered,
	body select.dokan-form-control{
		font-size: <?php echo esc_html($ts_input_font_size); ?>;
		line-height: <?php echo esc_html($ts_input_font_line_height); ?>;
	}
	.button-text:not(.ts-banner):not(.elementor-widget-button),
	.elementor-widget-button.button-text .elementor-button{
		font-size: <?php echo esc_html($ts_button_font_size); ?>;
	}
	.button,
	a.button,
	button,
	input[type^="submit"],
	.shopping-cart p.buttons a,
	a.wp-block-button__link,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce-page a.button,
	.woocommerce-page button.button,
	.woocommerce-page input.button,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce-page a.button.alt,
	.woocommerce-page button.button.alt,
	.woocommerce-page input.button.alt,
	#content button.button,
	.woocommerce #respond input#submit, 
	div.button a,
	input[type="submit"].dokan-btn, 
	a.dokan-btn, 
	.dokan-btn,
	.woocommerce .button.button-small,
	.button.button-small,
	.woocommerce .button.button-small.button-border,
	.button.button-small.button-border,
	.woocommerce-cart .cart-collaterals .shipping-calculator-form .button,
	.wishlist_table .product-add-to-cart a,
	body .woocommerce table.compare-list .add-to-cart td a,
	.elementor-button-wrapper .elementor-button,
	.elementor-widget-wp-widget-yith-woocompare-widget a.clear-all,
	.elementor-widget-wp-widget-yith-woocompare-widget a.compare{
		font-size: <?php echo esc_html($ts_button_font_size); ?>;
		line-height: <?php echo esc_html($ts_button_font_line_height); ?>;
	}
	.yith-woocompare-widget a.clear-all,
	.yith-woocompare-widget a.compare{
		line-height: <?php echo esc_html($ts_button_font_line_height); ?>;
	}
	.elementor-button-wrapper .elementor-button.elementor-size-xs{
		font-size: <?php echo esc_html( absint($ts_button_font_size) - 3 ) . 'px'; ?> !important;
	}
	.elementor-button-wrapper .elementor-button.elementor-size-xl{
		font-size: <?php echo esc_html( absint($ts_button_font_size) + 2 ) . 'px'; ?> !important;
	}
	#left-sidebar .widget-container a.button,
	#left-sidebar .widget-container button, 
	#left-sidebar .widget-container input[type^="submit"],
	#left-sidebar .yith-woocompare-widget a.clear-all,
	#left-sidebar .yith-woocompare-widget a.compare,
	#left-sidebar .widget-container .dokan-btn,
	#right-sidebar .widget-container a.button,
	#right-sidebar .widget-container button, 
	#right-sidebar .widget-container input[type^="submit"],
	#right-sidebar .yith-woocompare-widget a.clear-all,
	#right-sidebar .yith-woocompare-widget a.compare,
	#right-sidebar .widget-container .dokan-btn,
	#ts-filter-widget-area .widget-container a.button,
	#ts-filter-widget-area .widget-container button, 
	#ts-filter-widget-area .widget-container input[type^="submit"],
	#ts-filter-widget-area .yith-woocompare-widget a.clear-all,
	#ts-filter-widget-area .yith-woocompare-widget a.compare,
	#ts-filter-widget-area .widget-container .dokan-btn,
	#add_payment_method table.cart td.actions .coupon .input-text, 
	.woocommerce-cart table.cart td.actions .coupon .input-text, 
	.woocommerce-checkout table.cart td.actions .coupon .input-text,
	.woocommerce-cart .cart-collaterals .shipping-calculator-form .button,
	.woocommerce-cart table.cart td.actions .button{
		font-size: <?php echo esc_html( absint($ts_button_font_size) - 2 ) . 'px'; ?>;
	}

	/*** Heading ***/
	h1, .h1,
	.h1 .elementor-heading-title,
	article.single-portfolio .entry-content > .entry-title,
	.woocommerce div.product .summary p.price,
	.woocommerce div.product .summary span.price,
	.main-content-fullwidth #main-content.ts-col-24 article.single .entry-header .entry-title,
	.layout-fullwidth #main-content.ts-col-24 article.single .entry-header .entry-title{
		font-size: <?php echo esc_html($ts_h1_font_size); ?>;
		line-height: <?php echo esc_html($ts_h1_font_line_height); ?>;
	}
	h2, .h2,
	.h2 .elementor-heading-title,
	.breadcrumb-title-wrapper .page-title,
	.related-portfolios .shortcode-title,
	article.single .entry-header .entry-title, 
	.woocommerce div.product .summary .entry-title,
	.woocommerce .cross-sells > h2,
	.woocommerce .up-sells > h2, 
	.woocommerce .related > h2, 
	.woocommerce.related > h2, 
	.theme-title .heading-title, 
	.yith-wfbt-section .total_price,
	.woocommerce div.product > .ts-mailchimp-subscription-shortcode .widget-title,
	.style-tabs-vertical .column-tabs .heading-tab .heading-title,
	.ts-shortcode .shortcode-heading-wrapper .shortcode-title{
		font-size: <?php echo esc_html($ts_h2_font_size); ?>;
		line-height: <?php echo esc_html($ts_h2_font_line_height); ?>;
	}
	h3, .h3,
	.h3 .elementor-heading-title,
	.ts-blogs.columns-1 article .entry-title,
	.columns-1 .list-posts article .entry-title,
	.ts-blogs.columns-2 article .entry-title,
	.columns-2 .list-posts article .entry-title,
	.columns-0 .list-posts article:nth-child(1) .entry-title,
	.columns-0 .list-posts article:nth-child(2) .entry-title,
	.page-container:not(.columns-0):not(.columns-1):not(.columns-2):not(.columns-3) .list-posts article .entry-title,
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	.ts-portfolio-wrapper .portfolio-meta h4,
	.yith-wfbt-section > h3,
	.woocommerce-MyAccount-content form > h3,
	#customer_login h2,
	.woocommerce-order-details > h2,
	.woocommerce .cart-collaterals .order-total .amount,
	.dokan-dashboard h1.entry-title,
	.dokan-dashboard header.dokan-dashboard-header h1,
	#main-content .woocommerce.columns-1 > .products .product .meta-wrapper-2 .price{
		font-size: <?php echo esc_html($ts_h3_font_size); ?>;
		line-height: <?php echo esc_html($ts_h3_font_line_height); ?>;
	}
	h4, .h4,
	.h4 .elementor-heading-title,
	#main-content .woocommerce.columns-1 > .products .product .product-name,
	.widget-container .widget-title-wrapper,
	.widget-container .wp-block-group h2,
	.woocommerce .cart-collaterals .cart_totals > h2,
	.woocommerce-billing-fields > h3,
	.woocommerce > form.checkout #order_review_heading,
	.elementor-widget-image-box .elementor-image-box-title{
		font-size: <?php echo esc_html($ts_h4_font_size); ?>;
		line-height: <?php echo esc_html($ts_h4_font_line_height); ?>;
	}
	h5, .h5,
	.h5 .elementor-heading-title,
	.widget-container .widget-title,
	.comments-title .heading-title,
	.ts-search-by-category > h2,
	.dropdown-container .theme-title,
	#comment-wrapper .heading-title,
	.woocommerce #reviews #comments h2,
	#reviews .woocommerce-Reviews-title,
	.column-tabs ul.tabs li,
	.style-tabs-default .column-tabs .heading-tab .heading-title,
	#main-content.ts-col-24 .frequently-bought-together-vertical .yith-wfbt-section > h3,
	.ts-megamenu .elementor-widget .elementor-widget-container .banner-wrapper h5,
	.elementor-widget[data-widget_type*="wp-widget-"] h2.widgettitle,
	.ts-product.style-list .shortcode-heading-wrapper .shortcode-title{
		font-size: <?php echo esc_html($ts_h5_font_size); ?>;
		line-height: <?php echo esc_html($ts_h5_font_line_height); ?>;
	}
	h6, .h6,
	.h6 .elementor-heading-title,
	.ts-blogs article .entry-title,
	.list-posts article .entry-title,
	.filter-widget-area .widget-container .widget-title,
	.ts-megamenu .elementor-widget .elementor-widget-container h5,
	.footer-container .elementor-widget .elementor-widget-container h5,
	.footer-container .ts-list-of-product-categories-wrapper h3.heading-title,
	body .dokan-category-menu h3.widget-title, 
	body .dokan-widget-area .widget .widget-title,
	body .cart-empty.woocommerce-info,
	.ts-team-members h3,
	.commentlist li #comment-wrapper .heading-title,
	.woocommerce-account .addresses .title h3, 
	.woocommerce-account .addresses h2, 
	.woocommerce-customer-details .addresses h2,
	.ts-product-in-product-type-tab-wrapper .column-tabs ul.tabs li,
	.woocommerce .tabs-in-summary #reviews #comments .woocommerce-Reviews-title{
		font-size: <?php echo esc_html($ts_h6_font_size); ?>;
		line-height: <?php echo esc_html($ts_h6_font_line_height); ?>;
	}
	body:not(.woocommerce.archive) #left-sidebar .widget-container .widget-title-wrapper .widget-title, 
	body:not(.woocommerce.archive) #left-sidebar .widget-container .widget-title-wrapper .widgettitle, 
	body:not(.woocommerce.archive) #left-sidebar .widget-container .wp-block-group h2,
	body:not(.woocommerce.archive) #right-sidebar .widget-container .widget-title-wrapper .widget-title, 
	body:not(.woocommerce.archive) #right-sidebar .widget-container .widget-title-wrapper .widgettitle, 
	body:not(.woocommerce.archive) #right-sidebar .widget-container .wp-block-group h2,
	.brand-info-wrapper h3{
		font-size: <?php echo esc_html( absint($ts_h6_font_size) - 1 ) . 'px'; ?>;
	}

	/*** Responsive font size ***/
	@media only screen and (max-width: 1400px){
		#tab-description .ts-row .h1,
		.woocommerce div.product.product-style-3 .summary p.price{
			font-size: <?php echo esc_html($ts_h2_font_size); ?>;
			line-height: <?php echo esc_html($ts_h2_font_line_height); ?>;
		}
		.woocommerce div.product .summary p.price,
		.woocommerce div.product .summary span.price{
			font-size: <?php echo esc_html( absint($ts_h1_font_size) - 5 ) . 'px'; ?>
		}
		.yith-wfbt-section .total_price{
			font-size: <?php echo esc_html( absint($ts_h2_font_size) - 5 ) . 'px'; ?>
		}
	}
	@media only screen and (min-width: 1279px){
		.show-filter-top .product-filter-by-brand ul li label, 
		.show-filter-top .product-filter-by-availability ul li label, 
		.show-filter-top .product-filter-by-color ul li a{
			font-family: <?php echo esc_html($ts_body_font_medium); ?>;
			font-style: <?php echo esc_html($ts_body_font_medium_style); ?>;
			font-weight: <?php echo esc_html($ts_body_font_medium_weight); ?>;
		}
	}
	@media only screen and (max-width: 1279px){
		h1, .h1,
		.h1 .elementor-heading-title,
		article.single-portfolio .entry-content > .entry-title,
		.woocommerce div.product .summary p.price,
		.woocommerce div.product .summary span.price,
		.main-content-fullwidth #main-content.ts-col-24 article.single .entry-header .entry-title,
		.layout-fullwidth #main-content.ts-col-24 article.single .entry-header .entry-title{
			font-size: <?php echo esc_html($ts_h1_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h1_ipad_font_line_height); ?>;
		}
		h2, .h2,
		.h2 .elementor-heading-title,
		.breadcrumb-title-wrapper .page-title,
		.related-portfolios .shortcode-title,
		article.single .entry-header .entry-title, 
		.woocommerce div.product .summary .entry-title,
		.woocommerce .cross-sells > h2,
		.woocommerce .up-sells > h2, 
		.woocommerce .related > h2, 
		.woocommerce.related > h2, 
		.theme-title .heading-title, 
		.yith-wfbt-section .total_price,
		.woocommerce div.product > .ts-mailchimp-subscription-shortcode .widget-title,
		.ts-shortcode .shortcode-heading-wrapper .shortcode-title{
			font-size: <?php echo esc_html($ts_h2_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h2_ipad_font_line_height); ?>;
		}
		h3, .h3,
		.h3 .elementor-heading-title,
		.ts-blogs.columns-1 article .entry-title,
		.columns-1 .list-posts article .entry-title,
		.ts-blogs.columns-2 article .entry-title,
		.columns-2 .list-posts article .entry-title,
		.columns-0 .list-posts article:nth-child(1) .entry-title,
		.page-container:not(.columns-0):not(.columns-1):not(.columns-2):not(.columns-3) .list-posts article .entry-title,
		.woocommerce div.product .woocommerce-tabs ul.tabs li,
		#reviews .woocommerce-Reviews-title,
		.yith-wfbt-section > h3,
		.woocommerce-MyAccount-content form > h3,
		#customer_login h2,
		.woocommerce-order-details > h2,
		.woocommerce .cart-collaterals .order-total .amount,
		.dokan-dashboard h1.entry-title,
		.dokan-dashboard header.dokan-dashboard-header h1,
		.style-tabs-default .column-tabs .heading-tab .heading-title,
		.style-tabs-vertical .column-tabs .heading-tab .heading-title,
		#main-content .woocommerce.columns-1 > .products .product .meta-wrapper-2 .price{
			font-size: <?php echo esc_html($ts_h3_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h3_ipad_font_line_height); ?>;
		}
		h4, .h4,
		.h4 .elementor-heading-title,
		#main-content .woocommerce.columns-1 > .products .product .product-name,
		.widget-container .widget-title-wrapper,
		.widget-container .wp-block-group h2,
		.woocommerce .cart-collaterals .cart_totals > h2,
		.woocommerce-billing-fields > h3,
		.woocommerce > form.checkout #order_review_heading,
		.elementor-widget-image-box .elementor-image-box-title,
		.column-tabs ul.tabs li{
			font-size: <?php echo esc_html($ts_h4_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h4_ipad_font_line_height); ?>;
		}
		h5, .h5,
		.h5 .elementor-heading-title,
		.widget-container .widget-title,
		.comments-title .heading-title,
		.ts-search-by-category > h2,
		.dropdown-container .theme-title,
		#comment-wrapper .heading-title,
		.woocommerce #reviews #comments h2,
		#reviews .woocommerce-Reviews-title,
		#main-content.ts-col-24 .frequently-bought-together-vertical .yith-wfbt-section > h3,
		.elementor-widget[data-widget_type*="wp-widget-"] h2.widgettitle,
		.ts-portfolio-wrapper .portfolio-meta h4{
			font-size: <?php echo esc_html($ts_h5_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h5_ipad_font_line_height); ?>;
		}
		h6, .h6,
		.h6 .elementor-heading-title,
		.ts-blogs article .entry-title,
		.list-posts article .entry-title,
		.columns-0 .list-posts article:nth-child(2) .entry-title,
		.filter-widget-area .widget-container .widget-title,
		.ts-megamenu .elementor-widget .elementor-widget-container h5,
		.footer-container .elementor-widget .elementor-widget-container h5,
		.footer-container .ts-list-of-product-categories-wrapper h3.heading-title,
		body .dokan-category-menu h3.widget-title, 
		body .dokan-widget-area .widget .widget-title,
		body .cart-empty.woocommerce-info,
		.ts-team-members h3,
		.commentlist li #comment-wrapper .heading-title,
		.woocommerce-account .addresses .title h3, 
		.woocommerce-account .addresses h2, 
		.woocommerce-customer-details .addresses h2,
		body:not(.woocommerce.archive) #left-sidebar .widget-container .widget-title-wrapper .widget-title, 
		body:not(.woocommerce.archive) #left-sidebar .widget-container .widget-title-wrapper .widgettitle, 
		body:not(.woocommerce.archive) #left-sidebar .widget-container .wp-block-group h2,
		body:not(.woocommerce.archive) #right-sidebar .widget-container .widget-title-wrapper .widget-title, 
		body:not(.woocommerce.archive) #right-sidebar .widget-container .widget-title-wrapper .widgettitle,
		body:not(.woocommerce.archive) #right-sidebar .widget-container .wp-block-group h2,
		.ts-product-in-product-type-tab-wrapper .column-tabs ul.tabs li,
		.woocommerce .tabs-in-summary #reviews #comments .woocommerce-Reviews-title{
			font-size: <?php echo esc_html($ts_h6_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h6_ipad_font_line_height); ?>;
		}
		
		/*** Menu ***/
		.mobile-menu-wrapper .mobile-menu,
		.ts-header .menu-wrapper .vertical-menu-wrapper .vertical-menu-heading,  
		.ts-megamenu-container .elementor-widget-container > h5,
		.ts-header .menu-wrapper .ts-menu{
			font-size: <?php echo esc_html($ts_menu_ipad_font_size); ?>;
		}
		input,
		textarea,
		keygen,
		select,
		select option,
		body .select2-container,
		.woocommerce form .form-row input.input-text,
		.woocommerce form .form-row textarea,
		.dokan-form-control,
		.more-less-buttons a,
		#add_payment_method table.cart td.actions .coupon .input-text,
		.woocommerce-cart table.cart td.actions .coupon .input-text,
		.woocommerce-checkout table.cart td.actions .coupon .input-text,
		.woocommerce-columns > h3,
		.hidden-title-form input[type="text"]{
			font-size: <?php echo esc_html($ts_input_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_input_ipad_font_line_height); ?>;
		}
		.button-text:not(.ts-banner):not(.elementor-widget-button),
		.elementor-widget-button.button-text .elementor-button{
			font-size: <?php echo esc_html($ts_button_ipad_font_size); ?>;
		}
		.button,
		a.button,
		button,
		input[type^="submit"],
		.shopping-cart p.buttons a,
		a.wp-block-button__link,
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce-page a.button,
		.woocommerce-page button.button,
		.woocommerce-page input.button,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt,
		.woocommerce-page a.button.alt,
		.woocommerce-page button.button.alt,
		.woocommerce-page input.button.alt,
		#content button.button,
		.woocommerce #respond input#submit, 
		div.button a,
		input[type="submit"].dokan-btn, 
		a.dokan-btn, 
		.dokan-btn,
		.woocommerce .button.button-small,
		.button.button-small,
		.woocommerce .button.button-small.button-border,
		.button.button-small.button-border,
		.woocommerce-cart .cart-collaterals .shipping-calculator-form .button,
		.wishlist_table .product-add-to-cart a,
		body .woocommerce table.compare-list .add-to-cart td a,
		.elementor-button-wrapper .elementor-button,
		.elementor-widget-wp-widget-yith-woocompare-widget a.clear-all,
		.elementor-widget-wp-widget-yith-woocompare-widget a.compare{
			font-size: <?php echo esc_html($ts_button_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_button_ipad_font_line_height); ?>;
		}
		.elementor-button-wrapper .elementor-button.elementor-size-xs{
			font-size: <?php echo esc_html( absint($ts_button_ipad_font_size) - 3 ) . 'px'; ?> !important;
		}
		.elementor-button-wrapper .elementor-button.elementor-size-xl{
			font-size: <?php echo esc_html( absint($ts_button_ipad_font_size) + 2 ) . 'px'; ?>;
		}
		.entry-meta-middle,
		.entry-meta-bottom{
			font-size: <?php echo esc_html( absint($ts_body_font_size) - 2 ) . 'px'; ?>;
		}
	}
	@media only screen and (max-width: 767px){
		.columns-0 .list-posts article:nth-child(1) .entry-title{
			font-size: <?php echo esc_html($ts_h6_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h6_ipad_font_line_height); ?>;
		}
	}
	
	/*--------------------------------------------------------
		III. CUSTOM COLOR
	---------------------------------------------------------*/
	/*** Background Content Color ***/
	body #main,
	body.dokan-store #main:before,
	#cboxLoadedContent,
	.shopping-cart-wrapper .dropdown-container:before, 
	.my-account-wrapper .dropdown-container:before, 
	form.checkout div.create-account,
	.ts-popup-modal .popup-container,
	body #ts-search-result-container:before,
	#yith-wcwl-popup-message,

	.dataTables_wrapper,
	body > .compare-list,
	.single-navigation > div .product-info:before,
	.single-navigation .product-info:before,
	.archive.ajax-pagination .woocommerce > .products:after,
	.dropdown-container ul.cart_list li.loading:before,
	.thumbnail-wrapper .button-in.wishlist > a.loading:before,
	.meta-wrapper .button-in.wishlist > a.loading:before,
	.woocommerce a.button.loading:before,
	.woocommerce button.button.loading:before,
	.woocommerce input.button.loading:before,
	div.blockUI.blockOverlay:before,
	.woocommerce .blockUI.blockOverlay:before,
	div.product .single-navigation a .product-info,
	.ts-floating-sidebar .ts-sidebar-content,
	.mobile-menu-wrapper ul.sub-menu,
	.ts-team-members .team-info,
	.mobile-menu-wrapper li.active .ts-menu-drop-icon.active,
	.woocommerce .woocommerce-ordering .orderby ul:before,
	.product-per-page-form ul.perpage ul:before,
	#comments .wcpr-filter-container ul.wcpr-filter-button-ul,
	.single-post .entry-header-meta .entry-header-meta-content,
	.vertical-categories-wrapper .products .product-category,
	.archive.woocommerce .woocommerce .product-wrapper,
	.shopping-cart-wrapper .dropdown-container:before,
	.my-account-wrapper .dropdown-container:before,
	.wcml_currency_switcher > ul:before, 
	.wpml-ls-legacy-dropdown ul.wpml-ls-sub-menu:before,
	.wpml-ls-item-legacy-dropdown-click ul.wpml-ls-sub-menu:before{
		background-color: <?php echo esc_html($ts_main_content_background_color); ?>;
	}
	.ts-tiny-cart-wrapper .total{
		box-shadow: 0 -1px 0 <?php echo esc_html($ts_main_content_background_color); ?>;
	}
	.ts-tiny-cart-wrapper li div.blockUI.blockOverlay,
	.widget_shopping_cart li div.blockUI.blockOverlay, 
	.elementor-widget-wp-widget-woocommerce_widget_cart li div.blockUI.blockOverlay{
		background-color: <?php echo esc_html($ts_main_content_background_color); ?> !important;
	}
	.woocommerce div.product div.images .woocommerce-product-gallery__trigger,
	.portfolio-thumbnail > figure ~ a.like{
		background: <?php echo esc_html($ts_main_content_background_color); ?>;
		border-color: <?php echo esc_html($ts_main_content_background_color); ?>;
		color: <?php echo esc_html($ts_text_color); ?>;
	}
	<?php if( strpos($ts_main_content_background_color, 'rgba') !== false ): ?>
	.more-less-buttons > a.more-button:after {
		background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0,<?php echo esc_html(str_replace('1)', '0)', esc_html($ts_main_content_background_color))); ?>),to(<?php echo esc_html($ts_main_content_background_color); ?>));
		background-image: -o-linear-gradient(linear,left top,left bottom,color-stop(0,<?php echo esc_html(str_replace('1)', '0)', esc_html($ts_main_content_background_color))); ?>),to(<?php echo esc_html($ts_main_content_background_color); ?>));
		background-image: linear-gradient(to bottom,<?php echo esc_html(str_replace('1)', '0)', esc_html($ts_main_content_background_color))); ?> 0,<?php echo esc_html($ts_main_content_background_color); ?> 100%);
	}
	.ts-team-members .team-info{
		background-color: <?php echo esc_html(str_replace('1)', '0.9)', esc_html($ts_main_content_background_color))); ?>;
	}
	<?php endif; ?>
	blockquote{
		background: <?php echo esc_html($ts_blockquote_background_color); ?>;
		color: <?php echo esc_html($ts_blockquote_color); ?>;
	}

	/*** Body Text Color ***/
	body,	
	body table.compare-list,
	.comment-author-link a,
	.widget-container li > a,
	.widget_categories li > a,
	.widget_archive li > a,
	.wp-block-archives-list li > a,
	.header-middle .header-currency ul,
	.header-middle .wpml-ls-legacy-dropdown .wpml-ls-sub-menu, 
	.header-middle .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu,
	.header-top .header-currency ul,
	.header-top .wpml-ls-legacy-dropdown .wpml-ls-sub-menu, 
	.header-top .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu,
	body .header-top .dropdown-container,
	body .header-middle .dropdown-container,
	body .header-bottom .dropdown-container,
	footer#colophon .wcml_currency_switcher > ul, 
	footer#colophon .wpml-ls-legacy-dropdown ul.wpml-ls-sub-menu, 
	footer#colophon .wpml-ls-item-legacy-dropdown-click ul.wpml-ls-sub-menu,
	.ts-testimonial-wrapper blockquote .author-role .author,
	.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
	.my-account-wrapper .dropdown-container,
	.ul-style.primary-color li,
	.header-transparent.header-text-light .dropdown-container,
	body.header-transparent.header-text-light .wpml-ls-legacy-dropdown .wpml-ls-sub-menu, 
	body.header-transparent.header-text-light .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu, 
	.header-transparent.header-text-light .header-currency ul,
	.button-text:not(.ts-banner):not(.elementor-widget-button),
	.ts-product.style-grid.has-shop-more-button .shop-more .button-text,
	.ts-product.style-grid.has-shop-more-button .shop-more .button-text:hover,
	.elementor-widget-button.button-text .elementor-button,
	.elementor-widget-button.button-text .elementor-button:hover,
	.woocommerce .woocommerce-error .button,
	.woocommerce .woocommerce-info .button,
	.woocommerce .woocommerce-message .button,
	.woocommerce-page .woocommerce-error .button,
	.woocommerce-page .woocommerce-info .button,
	.woocommerce-page .woocommerce-message .button,
	.owl-nav > div:before,
	.ts-social-sharing li a,
	.woocommerce-info,
	.woocommerce .woocommerce-info,
	.alert.alert-success,
	div.wpcf7-mail-sent-ok,
	#yith-wcwl-popup-message,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce.yith-wfbt-section .yith-wfbt-images td > a,
	#ts-product-360-modal.ts-popup-modal .close,
	.more-less-buttons > a,
	.woocommerce-product-rating a,
	.woocommerce-product-rating a:hover,
	#reviews > .woocommerce-product-rating .review-count,
	.woocommerce-privacy-policy-text,
	.woocommerce > form.checkout a,
	body .hidden-title-form a,
	.ts-product-video-button,
	.ts-product-360-button,
	.dokan-store-wrap .commentlist li p time,
	.woocommerce div.product .single-product-buttons-sharing .single-product-buttons a{
		color: <?php echo esc_html($ts_text_color); ?>;
	}
	.owl-dot.active,
	.social-icons .list-icons .ts-tooltip{
		background: <?php echo esc_html($ts_text_color); ?>;
	}
	.social-icons .list-icons .ts-tooltip:before{
		border-top-color: <?php echo esc_html($ts_text_color); ?>;
	}
	.threesixty .nav_bar a{
		background: <?php echo esc_html($ts_text_color); ?>;
		border-color: <?php echo esc_html($ts_text_color); ?>;
		color: <?php echo esc_html($ts_text_light_color); ?>;
	}
	.threesixty .nav_bar a:hover{
		color: <?php echo esc_html($ts_text_color); ?>;
	}
	.thumbnail-wrapper .product-group-button > div{
		background-color: <?php echo esc_html($ts_product_button_thumbnail_background_color); ?>;
	}
	.product-group-button > div a:after,
	.product-group-button-meta > div.button-in a:before{
		color: <?php echo esc_html($ts_product_button_thumbnail_text_color); ?>;
	}
	.product-group-button-meta > div a.added:before, 
	.product-group-button-meta > div .added a:before, 
	.product-group-button > div a.added:after, 
	.product-group-button > div .added a:after, 
	.product_list_widget .button-in a:hover,
	.woocommerce .product_list_widget .button-in a:hover,
	.product_list_widget .button-in .added a:after,
	.product_list_widget .button-in a.added:after{
		color: <?php echo esc_html($ts_product_button_thumbnail_text_hover); ?>;
	}
	<?php if( strpos($ts_product_button_thumbnail_text_color, 'rgba') !== false ): ?>
		.product-group-button > div a.loading:after,
		.product-group-button-meta > div a.loading:after,
		.ts-product.style-list .product-group-button-meta > div.wishlist a.loading:before,
		.main-products.style-column-list .product-group-button-meta > div.wishlist a.loading:before{
			border-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_product_button_thumbnail_text_color))); ?>;
			border-top-color: <?php echo esc_html($ts_product_button_thumbnail_text_color); ?>;
		}
	<?php endif; ?>
	.tags-link a,
	.wp-block-tag-cloud a,
	.tagcloud a{
		background-color: <?php echo esc_html($ts_tag_background_color); ?>;
		border-color: <?php echo esc_html($ts_tag_border_color); ?>;
		color: <?php echo esc_html($ts_tag_color); ?>;
	}
	.tags-link a:hover,
	.wp-block-tag-cloud a:hover,
	.tagcloud a:hover{
		background-color: <?php echo esc_html($ts_primary_color); ?>;
		border-color: <?php echo esc_html($ts_primary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}
	.pagination-wrap ul.pagination > li > a.prev,
	.pagination-wrap ul.pagination > li > a.next,
	.dokan-pagination-container .dokan-pagination li:first-child a,
	.dokan-pagination-container .dokan-pagination li:last-child a,
	.woocommerce nav.woocommerce-pagination ul li a.next,
	.woocommerce nav.woocommerce-pagination ul li a.prev,
	.product-group-button .button-tooltip,
	.ts-pagination ul li a.prev,
	.ts-pagination ul li a.next{
		background-color: <?php echo esc_html($ts_primary_color); ?> !important;
		border-color: <?php echo esc_html($ts_primary_color); ?> !important;
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?> !important;
	}
	.product-group-button .button-tooltip:after{
		border-left-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.rtl .product-group-button .button-tooltip:after{
		border-right-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.ts-pagination ul li a:focus,
	.ts-pagination ul li a:hover,
	.ts-pagination ul li span.current,
	.pagination-wrap ul.pagination > li > a:hover,
	.pagination-wrap ul.pagination > li > span.current,
	.dokan-pagination-container .dokan-pagination li:hover a,
	.dokan-pagination-container .dokan-pagination li.active a,
	.woocommerce nav.woocommerce-pagination ul li a:focus, 
	.woocommerce nav.woocommerce-pagination ul li a:hover, 
	.woocommerce nav.woocommerce-pagination ul li span.current,
	.pagination-wrap ul.pagination > li > a.prev:hover,
	.pagination-wrap ul.pagination > li > a.next:hover,
	.dokan-pagination-container .dokan-pagination li:first-child a:hover,
	.dokan-pagination-container .dokan-pagination li:last-child a:hover,
	.woocommerce nav.woocommerce-pagination ul li a.next:hover,
	.woocommerce nav.woocommerce-pagination ul li a.prev:hover,
	.ts-pagination ul li a.prev:hover,
	.ts-pagination ul li a.next:hover{
		color: <?php echo esc_html($ts_primary_color); ?> !important;
		border-color: <?php echo esc_html($ts_primary_color); ?> !important;
	}
	.woocommerce a.remove,
	.ts-floating-sidebar .close, 
	.cart_list li a.remove,
	ul.products-list a.remove,
	table.shop_table .product-remove a,
	table.compare-list tr.remove td > a .remove,
	.woocommerce .woocommerce-widget-layered-nav-dropdown .woocommerce-widget-layered-nav-dropdown__submit{
		color: <?php echo esc_html($ts_text_color); ?> !important;
	}
	.entry-meta-middle,
	.entry-author .role,
	.widget-container .count,
	.ts-testimonial-wrapper blockquote .author-role,
	.woocommerce-review__published-date,
	.commentlist li .date-time, 
	.ts-search-result-container .description,
	.product-style-3 .brand-info-wrapper .description,
	.woocommerce-privacy-policy-text,
	div.product .summary .meta-content,
	.tagcloud .tag-link-count,
	.product-brands,
	.product-sku,
	.product-categories,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a,
	.woocommerce-MyAccount-content > form .form-row > span > em,
	.yith-wcwl-share .yith-wcwl-after-share-section,
	.widget_archive li,
	.wp-block-archives-list li,
	.widget_categories li,
	.elementor-widget-wp-widget-categories li,
	.product-filter-by-color ul li .count,
	ul.product_list_widget li .reviewer,
	.elementor-widget-wp-widget-recent-posts .post-date,
	#cancel-comment-reply-link,
	.meta-wrapper .short-description,
	.ts-product-brand-wrapper .item .count,
	.woocommerce .widget_rating_filter ul li a,
	.product-filter-by-brand li label .count,
	.my-account-wrapper .form-content > form > a.register,
	.comments-area .navigation .nav-previous + .nav-next:before,
	.commentlist li.comment .comment-actions a{
		color: <?php echo esc_html($ts_text_gray_color); ?>;
	}
	
	/*** Heading Text Color ***/
	h1,h2,h3,h4,h5,h6,
	.h1,.h2,.h3,.h4,.h5,.h6,
	dt,
	label ,
	p > label,
	fieldset div > label,
	blockquote,
	blockquote .author,
	table thead th,
	.wpcf7 p,
	.woocommerce > form > fieldset legend,
	.woocommerce table.shop_table th,
	html input:focus:invalid:focus, 
	html select:focus:invalid:focus,
	#yith-wcwl-popup-message,
	table#wp-calendar thead th,
	html body > h1,
	.woocommerce table.shop_attributes th,
	.column-tabs ul.tabs li,
	.ts-banner.text-under-image .box-content .description,
	.ts-banner.text-under-image .box-content h2,
	.ts-banner.text-under-image .box-content h6,
	.ts-banner.text-under-image.style-arrow .ts-banner-button a,
	body table.compare-list th,
	body table.compare-list tr.title th,
	body table.compare-list tr.image th,
	body table.compare-list tr.price th{
		color: <?php echo esc_html($ts_heading_color); ?>;
	}
	.column-tabs ul.tabs li:after{
		border-color: <?php echo esc_html($ts_heading_color); ?>;
	}
	
	/*** Primary color ***/
	.primary-color,
	.hightlight,
	.ul-style.primary-color li:before,
	.woocommerce-tabs .ul-style li:before,
	.short-description .ul-style li:before,
	.woocommerce-product-details__short-description .ul-style li:before,
	blockquote:before,
	.out-of-stock .availability-text,
	.woocommerce div.product form.cart .woocommerce-variation-availability p.stock.out-of-stock,
	.elementor-lightbox .dialog-lightbox-close-button:hover,
	.ts-store-notice .close:hover,
	body #cboxClose:hover:after,
	html body > h1 a.close:hover,
	body table.compare-list tr.remove td > a:hover,
	.elementor-lightbox .elementor-swiper-button:hover,
	.woocommerce-account .addresses .title .edit:hover:before,
	body .hidden-title-form a:hover,
	.ts-header a:hover,
	.product .meta-wrapper a:hover,
	.meta-bottom-2 a:hover,
	.filter-widget-area-button a:hover,
	.filter-widget-area-button a.active,
	.my-account-wrapper .dropdown-container a:hover,
	body .wpml-ls-legacy-dropdown a:hover, 
	body .wpml-ls-legacy-dropdown a:focus,
	body .wpml-ls-legacy-dropdown .wpml-ls-current-language:hover>a,
	body .wpml-ls-legacy-dropdown-click a:hover, 
	body .wpml-ls-legacy-dropdown-click a:focus, 
	body .wpml-ls-legacy-dropdown-click .wpml-ls-current-language:hover>a,
	.ts-search-result-container .view-all-wrapper a:hover,
	.widget_text a[href^="mailto"]:hover, 
	.widget_text a[href^="tel"]:hover,
	.woocommerce .ts-search-result-container ul.product_list_widget ul.ul-style li:before,
	.woocommerce.ts-search-result-container ul.product_list_widget ul.ul-style li:before,
	.woocommerce div.product .single-product-buttons-sharing .single-product-buttons a:hover{
		color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.ts-language-switcher a:hover, 
	.ts-currency-switcher a:hover,
	#ts-product-video-modal .close:hover,
	ul.products-list a.remove:hover,
	table.shop_table .product-remove a:hover,
	table.compare-list tr.remove td > a .remove:hover,
	.cart_list li a.remove:hover{
		color: <?php echo esc_html($ts_primary_color); ?> !important;
	}
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range:before{
		background: <?php echo esc_html($ts_primary_color); ?>;
	} 
	.ts-header .ts-menu ul li:hover:before, 
	.ts-header .ts-menu ul li:hover > a, 
	.ts-header .ts-menu ul li.current-menu-item:before, 
	.ts-header .ts-menu ul li.current-menu-item > a, 
	.ts-header .ts-menu ul li.current-menu-parent > a, 
	.ts-header .ts-menu ul li.current-menu-ancestor > a, 
	.ts-header .ts-menu ul li.current-product_cat-ancestor > a,
	.ts-header .ts-menu ul li.current-menu-item .ts-menu-drop-icon, 
	.ts-header .ts-menu ul li.current-menu-parent .ts-menu-drop-icon, 
	.ts-header .ts-menu ul li.current-menu-ancestor .ts-menu-drop-icon, 
	.ts-header .ts-menu ul .sub-menu li.current-menu-item > a, 
	.ts-header .ts-menu ul .sub-menu li.current-menu-parent > a, 
	.ts-header .ts-menu ul .sub-menu li.current-menu-ancestor > a, 
	.ts-header .ts-menu ul .sub-menu li.current-product_cat-ancestor > a,
	.ts-header .ts-menu ul .sub-menu li.current-menu-item .ts-menu-drop-icon, 
	.ts-header .ts-menu ul .sub-menu li.current-menu-parent .ts-menu-drop-icon, 
	.ts-header .ts-menu ul .sub-menu li.current-menu-ancestor .ts-menu-drop-icon,
	#group-icon-header .social-icons ul li a:hover,
	.ts-header .social-icons ul li a:hover,
	.ts-list-of-product-categories-wrapper .list-categories ul li a:hover,
	.footer-container .elementor-widget-wp-widget-nav_menu ul.menu li a:hover,
	.footer-container ul.nostyle li a:hover,
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .menu-wrapper nav > ul.menu > li > a .menu-label:before,
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .menu-wrapper nav > ul.menu > li.current-menu-item > a, 
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .menu-wrapper nav > ul.menu > li.current_page_parent > a, 
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .menu-wrapper nav > ul.menu > li.current-menu-parent > a, 
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .menu-wrapper nav > ul.menu > li.current_page_item > a, 
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .menu-wrapper nav > ul.menu > li.current-menu-ancestor > a, 
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .menu-wrapper nav > ul.menu > li.current-page-ancestor > a, 
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .menu-wrapper nav > ul.menu > li.current-product_cat-ancestor > a{
		color: <?php echo esc_html($ts_primary_color); ?> !important;
	}
	.ts-banner .box-content .sale-label,
	.add-to-cart-popup-content .heading .theme-title,
	.ts-portfolio-wrapper .item-wrapper a.like,
	.portfolio-info .portfolio-like{
		background: <?php echo esc_html($ts_primary_color); ?>;
		border-color: <?php echo esc_html($ts_primary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}
	#to-top a,
	.my-account-wrapper .ts-style-text .account-control > a:hover,
	.header-text-light .my-account-wrapper .ts-style-text .account-control > a:hover,
	.woocommerce-account .woocommerce-MyAccount-navigation li a:hover,
	.woocommerce-account .woocommerce-MyAccount-navigation li.is-active a{
		background-color: <?php echo esc_html($ts_primary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}
	.product-on-sale-form:hover label:before,
	.product-on-sale-form.checked label:before,
	.woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-items li span.checkboxbutton.checked,
	.widget-container.product-filter-by-brand ul > li label:hover:before,
	.widget-container.product-filter-by-brand ul > li.selected label:before,
	.product-filter-by-availability ul li label:hover:before,
	.product-filter-by-availability ul li input[checked="checked"] + label:before,
	.product-filter-by-price ul li label:hover:before,
	.product-filter-by-price ul li.chosen label:before,
	.woocommerce .widget_rating_filter ul li a:hover::before,
	.woocommerce .widget_rating_filter ul li.chosen a::before,
	.product-filter-by-color ul li a:hover:before,
	.product-filter-by-color ul li.chosen a:before{
		background: <?php echo esc_html($ts_primary_color); ?>;
		border-color: <?php echo esc_html($ts_primary_color); ?> !important;
	}
	.product-on-sale-form:hover label:after,
	.product-on-sale-form.checked label:after,
	.woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-items li span.checkboxbutton.checked:after,
	.widget-container.product-filter-by-brand ul > li label:hover:after,
	.widget-container.product-filter-by-brand ul > li.selected label:after,
	.product-filter-by-availability ul li label:hover:after,
	.product-filter-by-availability ul li input[checked="checked"] + label:after,
	.product-filter-by-price ul li label:hover:after,
	.product-filter-by-price ul li.chosen label:after,
	.woocommerce .widget_rating_filter ul li a:hover::after,
	.woocommerce .widget_rating_filter ul li.chosen a::after,
	.product-filter-by-color ul li a:hover:after,
	.product-filter-by-color ul li.chosen a:after{
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}
	.woocommerce div.product div.images .flex-control-thumbs li img.flex-active,
	.woocommerce div.product div.images .flex-control-thumbs li img:hover{
		border-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	#review_form .cr-upload-images-preview .cr-upload-images-pbar .cr-upload-images-pbarin, 
	.cr-upload-images-preview .cr-upload-images-pbarin{
		background-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	#review_form .cr-upload-images-preview .cr-upload-images-containers .cr-upload-images-delete, 
	.cr-upload-images-preview .cr-upload-images-containers .cr-upload-images-delete{
		background-color: <?php echo esc_html($ts_primary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}
	.list-posts article.sticky{
		border-top-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.summary-column-2 .ts-product-attribute > div.option:not(.color).selected > a,
	.summary-column-2 .ts-product-attribute > div.option:not(.color):hover > a,
	.ts-product-attribute > div.option:not(.color).selected > a,
	.ts-product-attribute > div.option:not(.color):hover > a{
		background: <?php echo esc_html($ts_primary_light_color); ?>;
		border-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	
	/*** Secondary color ***/
	.yith-wfbt-section .total_price,
	.availability .availability-text,
	.header-contact-info:before{
		color: <?php echo esc_html($ts_secondary_color); ?>;
	}
	.woocommerce.yith-wfbt-section:before{
		background-color: <?php echo esc_html($ts_secondary_light_color); ?>;
	}
	#group-icon-header .tab-mobile-menu li.active,
	.woocommerce.yith-wfbt-section .yith-wfbt-images td:not(:last-child) > a:after{
		background: <?php echo esc_html($ts_secondary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_secondary); ?>;
	}
	.ts-delivery-note > span,
	.woocommerce div.product div.summary .ts-delivery-note > span{
		border-color: <?php echo esc_html($ts_secondary_color); ?>;
	}
	.ts-delivery-note svg path{
		stroke: <?php echo esc_html($ts_secondary_color); ?>;
	}
	
	/*** Link Color ***/
	a,
	.elementor-widget-text-editor table a{
		color: <?php echo esc_html($ts_link_color); ?>;
	}
	a:hover,
	.elementor-widget-text-editor table a:hover,
	.product-brands a:hover,
	.product-categories a:hover,
	.portfolio-info .cat-links a:hover,
	.widget_categories > ul li > a:hover,
	.widget_archive li > a:hover,
	.widget_nav_menu li > a:hover,
	.widget_pages li > a:hover,
	.widget_meta li > a:hover,
	.widget_recent_comments li > a:hover,
	.widget_recent_entries li > a:hover,
	.widget_rss li > a:hover,
	ul.product_list_widget li a:hover, 
	.woocommerce ul.cart_list li a:hover, 
	.woocommerce ul.product_list_widget li a:hover,
	.ts-product-brand-info .social-profile li a:hover,
	.ts-header .menu-wrapper .vertical-menu-wrapper ul.sub-menu a:hover,
	.ts-header .menu-wrapper .ts-menu ul.sub-menu a:hover,
	.vertical-categories-wrapper .products .product-category .heading-title a:hover,
	.woocommerce-product-rating .woocommerce-review-link:hover,
	.woocommerce div.product .summary .woocommerce-product-rating .woocommerce-review-link:hover,
	.widget_categories > ul li.current-cat > a,
	.woocommerce div.product .summary .product-brands a:hover,
	.woocommerce div.product .summary .cat-links a:hover,
	.woocommerce div.product .summary .tag-links a:hover,
	.ts-product-category-wrapper .product:not(.product-category) .category-name a:hover,
	.woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-items a:hover,
	.elementor-widget[data-widget_type*="wp-widget-"] ul li a:hover,
	.comments-area .add-comment > a:hover,
	.commentlist li.comment .comment-actions a:hover,
	.woocommerce .woocommerce-ordering ul li a:hover, 
	.product-per-page-form ul.perpage ul li a:hover{
		color: <?php echo esc_html($ts_link_color_hover); ?>;
	}
	.item-wrapper .portfolio-meta a:hover{
		color: <?php echo esc_html($ts_link_color_hover); ?> !important;
	}
	
	/*** Button/Input Color ***/
	.button,
	a.button,
	button,
	input[type^="submit"],
	.shopping-cart p.buttons a,
	a.wp-block-button__link,
	.is-style-outline>.wp-block-button__link:not(.has-text-color):hover, .wp-block-button__link.is-style-outline:not(.has-text-color):hover,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce-page a.button,
	.woocommerce-page button.button,
	.woocommerce-page input.button,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce-page a.button.alt,
	.woocommerce-page button.button.alt,
	.woocommerce-page input.button.alt,
	#content button.button,
	.wp-block-search .wp-block-search__button,
	.woocommerce #respond input#submit, 
	div.button a,
	input[type="submit"].dokan-btn, 
	a.dokan-btn, 
	.dokan-btn,
	.dokan-btn.dokan-store-list-filter-button,
	.dokan-btn.dokan-store-list-filter-button:hover,
	.elementor-button-wrapper .elementor-button,
	.wishlist_table .product-add-to-cart a,
	body .woocommerce table.compare-list .add-to-cart td a,
	.yith-woocompare-widget a.clear-all,
	.elementor-widget-wp-widget-yith-woocompare-widget a.clear-all,
	.woocommerce-cart table.cart td.actions > .button:hover,
	div.wpcf7 input[type^="submit"],
	.woocommerce a.button.disabled,
	.woocommerce a.button.disabled:hover,
	.woocommerce a.button:disabled,
	.woocommerce a.button:disabled[disabled], 
	.woocommerce a.button:disabled[disabled]:hover, 
	.woocommerce button.button.disabled, 
	.woocommerce button.button:disabled,
	.woocommerce button.button:disabled[disabled], 
	.woocommerce input.button.disabled, 
	.woocommerce input.button:disabled, 
	.woocommerce input.button:disabled[disabled],
	.woocommerce #respond input#submit.alt.disabled,
	.woocommerce #respond input#submit.alt.disabled:hover,
	.woocommerce #respond input#submit.alt:disabled,
	.woocommerce #respond input#submit.alt:disabled:hover,
	.woocommerce #respond input#submit.alt:disabled[disabled],
	.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
	.woocommerce a.button.alt.disabled, 
	.woocommerce a.button.alt.disabled:hover,
	.woocommerce a.button.alt:disabled, 
	.woocommerce a.button.alt:disabled:hover,
	.woocommerce a.button.alt:disabled[disabled], 
	.woocommerce a.button.alt:disabled[disabled]:hover, 
	.woocommerce button.button.alt.disabled, 
	.woocommerce button.button.alt.disabled:hover, 
	.woocommerce button.button.alt:disabled, 
	.woocommerce button.button.alt:disabled:hover, 
	.woocommerce button.button.alt:disabled[disabled], 
	.woocommerce button.button.alt:disabled[disabled]:hover, 
	.woocommerce input.button.alt.disabled, 
	.woocommerce input.button.alt.disabled:hover, 
	.woocommerce input.button.alt:disabled, 
	.woocommerce input.button.alt:disabled:hover, 
	.woocommerce input.button.alt:disabled[disabled], 
	.woocommerce input.button.alt:disabled[disabled]:hover{
		background: <?php echo esc_html($ts_button_background_color); ?>;
		border-color: <?php echo esc_html($ts_button_background_color); ?>;
		color: <?php echo esc_html($ts_button_text_color); ?>;
	}
	div.wpcf7 input[type^="submit"]:hover,
	.button:hover,
	a.button:hover,
	button:hover,
	input[type^="submit"]:hover,
	.shopping-cart p.buttons a:hover,
	.woocommerce a.button:hover,
	.woocommerce button.button:hover,
	.woocommerce input.button:hover,
	.woocommerce-page a.button:hover,
	.woocommerce-page button.button:hover,
	.woocommerce-page input.button:hover,
	.woocommerce a.button.alt:hover,
	.woocommerce button.button.alt:hover,
	.woocommerce input.button.alt:hover,
	.woocommerce-page a.button.alt:hover,
	.woocommerce-page button.button.alt:hover,
	.woocommerce-page input.button.alt:hover,
	#content button.button:hover,
	.wp-block-search .wp-block-search__button:hover,
	.woocommerce #respond input#submit:hover, 
	div.button a:hover,
	input[type="submit"].dokan-btn:hover, 
	a.dokan-btn:hover, 
	.dokan-btn:hover,
	.wishlist_table .product-add-to-cart a:hover,
	a.wp-block-button__link:hover,
	.is-style-outline>.wp-block-button__link:not(.has-text-color), .wp-block-button__link.is-style-outline:not(.has-text-color),
	.elementor-button-wrapper .elementor-button:hover,
	body .woocommerce table.compare-list .add-to-cart td a:hover,
	.woocommerce-cart table.cart td.actions > .button,
	.yith-woocompare-widget a.clear-all:hover,
	.elementor-widget-wp-widget-yith-woocompare-widget a.clear-all:hover{
		color: <?php echo esc_html($ts_button_background_color); ?>;
		border-color: <?php echo esc_html($ts_button_background_color); ?>;
	}
	.button-primary,
	.button.button-primary,
	#content button.button.button-primary,
	.shop-more a.button,
	.woocommerce-page button.button.button-primary,
	.yith-wfbt-form .yith-wfbt-submit-block .button,
	form.track_order input[type^="submit"], 
	form.track_order button[type^="submit"],
	.woocommerce-MyAccount-content form button[type^="submit"],
	.woocommerce form.woocommerce-ResetPassword.lost_reset_password button[type^="submit"],
	.load-more-wrapper .button,
	.ts-shop-load-more .button,
	.woocommerce .ts-shop-load-more .button,
	.woocommerce-cart .return-to-shop a.button,
	.widget_shopping_cart .buttons a.checkout:hover,
	.woocommerce #customer_login form.login .button, 
	.woocommerce #customer_login form.register .button,
	.yith-woocompare-widget a.compare,
	.elementor-widget-wp-widget-yith-woocompare-widget a.compare,
	.elementor-widget-wp-widget-woocommerce_widget_cart .buttons a.checkout,
	#add_payment_method .wc-proceed-to-checkout a.checkout-button,
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
	.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
	.dropdown-footer > a.button.checkout-button:hover{
		background: <?php echo esc_html($ts_primary_color); ?>;
		border-color: <?php echo esc_html($ts_primary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}
	.button-primary:hover,
	.button.button-primary:hover,
	.shop-more a.button:hover,
	#content button.button.button-primary:hover,
	.woocommerce-page button.button.button-primary:hover,
	.woocommerce div.product form.cart .button:hover,
	.yith-wfbt-form .yith-wfbt-submit-block .button:hover,
	form.track_order input[type^="submit"]:hover, 
	form.track_order button[type^="submit"]:hover,
	.woocommerce-MyAccount-content form button[type^="submit"]:hover,
	.woocommerce form.woocommerce-ResetPassword.lost_reset_password button[type^="submit"]:hover,
	.load-more-wrapper .button:hover,
	.ts-shop-load-more .button:hover,
	.woocommerce .ts-shop-load-more .button:hover,
	.woocommerce-cart .return-to-shop a.button:hover,
	.widget_shopping_cart .buttons a.checkout,
	.woocommerce #customer_login form.login .button:hover, 
	.woocommerce #customer_login form.register .button:hover,
	.yith-woocompare-widget a.compare:hover,
	.elementor-widget-wp-widget-yith-woocompare-widget a.compare:hover,
	.elementor-widget-wp-widget-woocommerce_widget_cart .buttons a.checkout:hover,
	#add_payment_method .wc-proceed-to-checkout a.checkout-button:hover,
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
	.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:hover,
	.dropdown-footer > a.button.checkout-button{
		color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.woocommerce div.product form.cart .button.loading:after,
	.search-table .search-field.loading ~ .search-button:before,
	.wishlist_table .product-add-to-cart a.add_to_cart.loading:after,
	body .woocommerce table.compare-list .add-to-cart td a.loading:after,
	.product-group-button-meta > div a.loading:after,
	.woocommerce .product-group-button-meta > div a.button.loading:after,
	rs-layer .products .product div.loop-add-to-cart .button.loading:after{
		background: <?php echo esc_html($ts_primary_color); ?> !important;
	}
	<?php if( strpos($ts_button_text_color, 'rgba') !== false ): ?>
		.ts-portfolio-wrapper .item-wrapper a.like.loading:before,
		.portfolio-like .ic-like.loading:before,
		.portfolio-thumbnail > figure ~ a.like.loading:hover:before,
		.woocommerce div.product form.cart .button.loading:before,
		.search-table .search-field.loading ~ .search-button:after,
		#ts-search-sidebar .search-table .search-field.loading ~ .search-button:after,
		.wishlist_table .product-add-to-cart a.add_to_cart.loading:before,
		body .woocommerce table.compare-list .add-to-cart td a.loading:before,
		.product-group-button-meta > div a.loading:before,
		.woocommerce .product-group-button-meta > div a.button.loading:before,
		rs-layer .products .product div.loop-add-to-cart .button.loading:before{
			border-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_button_text_color))); ?>;
			border-top-color: <?php echo esc_html($ts_button_text_color); ?>;
		}
	<?php endif; ?>
	.woocommerce div.product form.cart .button.loading:hover:after,
	.wishlist_table .product-add-to-cart a.add_to_cart.loading:hover:after,
	body .woocommerce table.compare-list .add-to-cart td a.loading:hover:after,
	.product-group-button-meta > div a.loading:hover:after,
	.woocommerce .product-group-button-meta > div a.button.loading:hover:after,
	rs-layer .products .product div.loop-add-to-cart .button.loading:hover:after{
		background: <?php echo esc_html($ts_button_text_color); ?> !important;
	}
	<?php if( strpos($ts_button_background_color, 'rgba') !== false ): ?>
	.woocommerce div.product form.cart .button.loading:hover:before,
	.search-table .search-field.loading ~ .search-button:hover:after,
	#ts-search-sidebar .search-table .search-field.loading ~ .search-button:hover:after,
	.wishlist_table .product-add-to-cart a.add_to_cart.loading:hover:before,
	body .woocommerce table.compare-list .add-to-cart td a.loading:hover:before,
	.product-group-button-meta > div a.loading:hover:before,
	.woocommerce .product-group-button-meta > div a.button.loading:hover:before,
	rs-layer .products .product div.loop-add-to-cart .button.loading:hover:before{
		border-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_button_background_color))); ?>;
		border-top-color: <?php echo esc_html($ts_button_background_color); ?>;
	}
	<?php endif; ?>
	.load-more-wrapper .button.loading,
	.ts-shop-load-more .button.loading,
	.woocommerce .ts-shop-load-more .button.loading{
		border-top-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	select,
	textarea,
	html input[type="search"],
	html input[type="text"],
	html input[type="email"],
	html input[type="password"],
	html input[type="date"],
	html input[type="number"],
	html input[type="tel"],
	.woocommerce .quantity input.qty, 
	.quantity input.qty,
	body .wishlist-title a.show-title-form,
	body .select2-container--default .select2-search--dropdown .select2-search__field,
	body .select2-container--default .select2-selection--single,
	.woocommerce-checkout .select2-dropdown,
	body .select2-container--default .select2-selection--single,
	body .select2-container--default .select2-search--dropdown .select2-search__field,
	.woocommerce form .form-row.woocommerce-validated .select2-container,
	.woocommerce form .form-row.woocommerce-validated input.input-text,
	.woocommerce form .form-row.woocommerce-validated select,
	body .select2-container--default .select2-selection--multiple,
	body .select2-container--default .select2-selection--single .select2-selection__rendered{
		color: <?php echo esc_html($ts_input_text_color); ?>;
		background-color: <?php echo esc_html($ts_input_background_color); ?>;
	}
	.vertical-categories-wrapper .products .product-category .product-wrapper:hover,
	.ts-active-filters .widget_layered_nav_filters ul li a,
	#add_payment_method #payment div.payment_box,
	.woocommerce-cart #payment div.payment_box,
	.woocommerce-checkout #payment div.payment_box,
	.elementor-widget-wp-widget-ts_products.nav-top .ts-slider .owl-nav > div,
	.elementor-widget-wp-widget-ts_blogs.nav-top .ts-slider .owl-nav > div,
	.elementor-widget-wp-widget-ts_recent_comments.nav-top .ts-slider .owl-nav > div,
	.widget-container .ts-slider .owl-nav > div,
	#review_form .cr-upload-local-images #cr_review_image,
	.cr-upload-local-images #cr_review_image{
		background-color: <?php echo esc_html($ts_input_background_color); ?>;
	}
	.ts-header nav.vertical-menu > ul.menu > li:hover,	
	.ts-header nav.vertical-menu > ul.menu > li.ts-active,
	.ts-header .normal-menu nav.vertical-menu ul.sub-menu > li:hover, 
	.ts-header nav.vertical-menu ul li.current-menu-item{
		color: <?php echo esc_html($ts_header_search_color); ?>;
		background-color: <?php echo esc_html($ts_header_search_background_color); ?>;
	}
	input:-webkit-autofill, 
	input:-webkit-autofill:hover, 
	input:-webkit-autofill:focus{
		-webkit-box-shadow: 0 0 0 50px <?php echo esc_html($ts_input_background_color); ?> inset !important; 
	}
	body .select2-container--default .select2-selection--single .select2-selection__placeholder{
		color: <?php echo esc_html($ts_input_text_color); ?>;
	}
	body .wishlist-title a.show-title-form:hover{
		background-color: <?php echo esc_html($ts_primary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}
	#add_payment_method #payment div.payment_box::before,
	.woocommerce-cart #payment div.payment_box::before,
	.woocommerce-checkout #payment div.payment_box::before{
		border-bottom-color: <?php echo esc_html($ts_input_background_color); ?>;
	}
	
	/*** Border Color ***/
	*,
	*:before,
	*:after,
	img,
	.entry-meta-bottom,
	.commentlist li.comment,
	.woocommerce #reviews #comments ol.commentlist li,
	.ts-tiny-cart-wrapper .total, 
	.widget_shopping_cart .total,
	.elementor-widget-wp-widget-woocommerce_widget_cart .total,
	.twitter-wrapper .avatar-name img,
	body.single-post article .entry-format.no-featured-image,
	.woocommerce table.shop_table tbody th,
	.woocommerce table.shop_table tfoot td,
	.woocommerce table.shop_table tfoot th,
	.woocommerce div.product form.cart table.group_table td,
	.woocommerce form.checkout_coupon, 
	.woocommerce .checkout-login-coupon-wrapper form.login,
	.ts-product-brand-wrapper .item img,
	body #yith-woocompare table.compare-list tbody th, 
	body #yith-woocompare table.compare-list tbody td,
	.woocommerce table.shop_table.shop_table_responsive.cart tr.cart_item td.product-subtotal,
	.ts-header .dropdown-container *,
	.color-swatch > div img,
	.ts-product-attribute a img,
	.ts-header nav > ul.menu ul.sub-menu:before,
	.woocommerce div.product.show-tabs-content-default .woocommerce-tabs #reviews nav.woocommerce-pagination,
	#main-content.ts-col-24 .woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-images,
	#main-content.ts-col-24 .woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-images:after,
	#main-content.ts-col-24 .woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-items:after{
		border-color: <?php echo esc_html($ts_border_color); ?>;
	}
	.images.loading:after,
	.ts-product .content-wrapper.loading:after,
	.ts-logo-slider-wrapper.loading .content-wrapper:after,
	.related-posts.loading .content-wrapper:after,
	.search-table .search-button:after,
	.woocommerce .product figure.loading:after,
	.ts-products-widget-wrapper.loading:after,
	.ts-blogs-widget-wrapper.loading:after,
	.ts-recent-comments-widget-wrapper.loading:after,
	.blogs article a.gallery.loading:after,
	.ts-blogs-wrapper.loading .content-wrapper:after,
	.ts-testimonial-wrapper .items.loading:after,
	.ts-twitter-slider .items.loading:after,
	article .thumbnail.loading:after,
	.ts-portfolio-wrapper.loading:after,
	.thumbnails.loading:after,
	.ts-product-category-wrapper .content-wrapper.loading:after,
	.thumbnails-container.loading:after,
	.column-products.loading:after,
	.ts-team-members .loading:after,
	.ts-products-widget-wrapper.loading:after,
	.ts-blogs-widget-wrapper.loading:after,
	.ts-recent-comments-widget-wrapper.loading:after,
	.ts-tiny-cart-wrapper li div.blockUI.blockOverlay:after,
	.widget_shopping_cart li div.blockUI.blockOverlay:after,
	.elementor-widget-wp-widget-woocommerce_widget_cart div.blockUI.blockOverlay:after,
	.dropdown-container ul.cart_list li.loading:after,
	.woocommerce a.button.loading:after,
	.woocommerce button.button.loading:after,
	.woocommerce input.button.loading:after,
	.woocommerce div.product .single-product-buttons-sharing .single-product-buttons a.loading:after,
	div.blockUI.blockOverlay:after,
	.woocommerce div.blockUI.blockOverlay:after,
	.archive.ajax-pagination .woocommerce > .products:before,
	div.wpcf7 .ajax-loader:after{
		border-color: <?php echo esc_html($ts_border_color); ?>;
	}
	.images.loading:after,
	.search-table .search-button:after,
	.ts-product .content-wrapper.loading:after,
	.ts-logo-slider-wrapper.loading .content-wrapper:after,
	.related-posts.loading .content-wrapper:after,
	.woocommerce .product figure.loading:after,
	.ts-products-widget-wrapper.loading:after,
	.ts-blogs-widget-wrapper.loading:after,
	.ts-recent-comments-widget-wrapper.loading:after,
	.blogs article a.gallery.loading:after,
	.ts-blogs-wrapper.loading .content-wrapper:after,
	.ts-testimonial-wrapper .items.loading:after,
	.ts-twitter-slider .items.loading:after,
	article .thumbnail.loading:after,
	.ts-portfolio-wrapper.loading:after,
	.thumbnails.loading:after,
	.ts-product-category-wrapper .content-wrapper.loading:after,
	.thumbnails-container.loading:after,
	.column-products.loading:after,
	.ts-team-members .loading:after,
	.ts-products-widget-wrapper.loading:after,
	.ts-blogs-widget-wrapper.loading:after,
	.ts-recent-comments-widget-wrapper.loading:after,
	.ts-tiny-cart-wrapper li div.blockUI.blockOverlay:after,
	.widget_shopping_cart li div.blockUI.blockOverlay:after,
	.elementor-widget-wp-widget-woocommerce_widget_cart div.blockUI.blockOverlay:after,
	.dropdown-container ul.cart_list li.loading:after,
	.woocommerce a.button.loading:after,
	.woocommerce button.button.loading:after,
	.woocommerce input.button.loading:after,
	.woocommerce div.product .single-product-buttons-sharing .single-product-buttons a.loading:after,
	div.blockUI.blockOverlay:after,
	.woocommerce div.blockUI.blockOverlay:after,
	.archive.ajax-pagination .woocommerce > .products:before,
	div.wpcf7 .ajax-loader:after{
		border-top-color: <?php echo esc_html($ts_text_color); ?>;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li a:after,
	.woocommerce div.product.color-variation-thumbnail .ts-product-attribute div.option.color a:hover img,
	.woocommerce div.product.color-variation-thumbnail .ts-product-attribute div.option.color.selected a img{
		border-color: <?php echo esc_html($ts_text_color); ?>;
	}
	.woocommerce div.product.color-variation-thumbnail .ts-product-attribute div.option.color a:after{
		background: <?php echo esc_html($ts_text_color); ?>;
	}
	
	/*** Header Color ***/
	.ts-store-notice{
		background-color: <?php echo esc_html($ts_notice_background_color); ?>;
		border-color: <?php echo esc_html($ts_notice_border_color); ?>;
		color: <?php echo esc_html($ts_notice_text_color); ?>;
	}
	.header-top,
	.header-middle,
	.header-bottom{
		background-color: <?php echo esc_html($ts_header_background_color); ?>;
		border-color: <?php echo esc_html($ts_header_border_color); ?>;
		color: <?php echo esc_html($ts_header_text_color); ?>;
	}
	.header-contact-info{
		color: <?php echo esc_html($ts_header_text_gray_color); ?>;
	}
	.header-middle .header-right > *:before{
		border-color: <?php echo esc_html($ts_header_border_color); ?>;
	}
	.ts-header .search-content input[type="text"]{
		color: <?php echo esc_html($ts_header_search_color); ?>;
		background-color: <?php echo esc_html($ts_header_search_background_color); ?>;
	}
	<?php if( strpos($ts_header_search_color, 'rgba') !== false ): ?>
	.ts-header .search-table .loading ~ .search-button:after,
	.ts-header .search-table .loading ~ .search-button:hover:after{
		border-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_header_search_color))); ?> !important;
		border-top-color: <?php echo esc_html($ts_header_search_color); ?> !important;
	}
	<?php endif; ?>
	.ts-megamenu .category-style-vertical .products .product-category .product-wrapper{
		background-color: <?php echo esc_html($ts_header_background_color); ?>;
	}
	.ts-megamenu .category-style-vertical .products .product-category.active .product-wrapper,
	.ts-megamenu .category-style-vertical .products .product-category .product-wrapper:hover{
		background-color: <?php echo esc_html($ts_header_search_background_color); ?>;
	}
	.ts-header .social-icons ul li:hover i,
	.ts-megamenu .category-style-vertical .products .product-category .product-wrapper:hover a{
		color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.ts-header .search-content ::-webkit-input-placeholder{
		color: <?php echo esc_html($ts_header_search_placeholder_color); ?>;
	}
	.ts-header .search-content :-moz-placeholder{
		color: <?php echo esc_html($ts_header_search_placeholder_color); ?>;
	}
	.ts-header .search-content ::-moz-placeholder{
		color: <?php echo esc_html($ts_header_search_placeholder_color); ?>;
	}
	.ts-header .search-content :-ms-input-placeholder{
		color: <?php echo esc_html($ts_header_search_placeholder_color); ?>;
	}
	.ts-header nav > ul.menu li ul.sub-menu:before,
	.ts-header nav > ul.menu li ul.sub-menu:after,
	.ts-header .vertical-menu-wrapper:not(.normal-menu) nav.vertical-menu:before,
	.ts-header .vertical-menu > ul,
	.ts-header .vertical-menu > ul > li,
	.ts-header .vertical-menu li:not(.ts-megamenu) > ul.sub-menu > li{
		background-color: <?php echo esc_html($ts_header_background_color); ?>;
		border-color: <?php echo esc_html($ts_header_border_color); ?>;
	}
	.ts-header nav > ul.menu > li.has-line, 
	.ts-header nav > ul > li.has-line,
	.ts-header *,
	.ts-header *:before,
	.ts-header *:after,
	ul.sub-menu .tab-vertical-menu .products .product-category, 
	ul.sub-menu .category-style-vertical .products .product-category{
		border-color: <?php echo esc_html($ts_header_border_color); ?>;
	}
	.ts-header .menu-wrapper .vertical-menu,
	.ts-header nav > ul.menu li ul.sub-menu,
	ul.sub-menu .elementor-element .list-categories ul li a,
	ul.sub-menu .elementor-element .heading-title,
	.header-contact-info strong{
		color: <?php echo esc_html($ts_header_text_color); ?>;
	}
	.ts-header .social-icons ul li i{
		color: <?php echo esc_html($ts_header_social_icon_color); ?>;
	}
	.icon-menu-sticky-header .icon:before, 
	.search-button.search-icon .icon:before, 
	.my-wishlist-wrapper .tini-wishlist:before, 
	.shopping-cart-wrapper .cart-control .ic-cart:before, 
	.shopping-cart-wrapper .cart-control .cart-total,
	.ts-tiny-account-wrapper .account-control>a:before,
	.header-transparent.header-text-light .is-sticky .header-middle .icon-menu-sticky-header .icon:before, 
	.header-transparent.header-text-light .is-sticky .header-middle .search-button.search-icon .icon:before, 
	.header-transparent.header-text-light .is-sticky .header-middle .my-wishlist-wrapper .tini-wishlist:before, 
	.header-transparent.header-text-light .is-sticky .header-middle .shopping-cart-wrapper .cart-control .ic-cart:before, 
	.header-transparent.header-text-light .is-sticky .header-middle .ts-tiny-account-wrapper .account-control>a:before{
		color: <?php echo esc_html($ts_header_icon_color); ?>;
	}	
	.icon-menu-sticky-header:hover .icon:before,
	.search-button.search-icon:hover .icon:before, 
	.my-wishlist-wrapper:hover .tini-wishlist:before, 
	.shopping-cart-wrapper:hover .cart-control .ic-cart:before,
	.shopping-cart-wrapper:hover .cart-control .cart-total,
	.ts-tiny-account-wrapper:hover .account-control>a:before,
	.header-transparent.header-text-light .icon-menu-sticky-header:hover .icon:before,
	.header-transparent.header-text-light .search-button.search-icon:hover .icon:before, 
	.header-transparent.header-text-light .my-wishlist-wrapper:hover .tini-wishlist:before, 
	.header-transparent.header-text-light .shopping-cart-wrapper:hover .cart-control .ic-cart:before, 
	.header-transparent.header-text-light .shopping-cart-wrapper:hover .cart-control .cart-total, 
	.header-transparent.header-text-light .ts-tiny-account-wrapper:hover .account-control>a:before{
		color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.my-wishlist-wrapper .tini-wishlist .count-number,
	.shopping-cart-wrapper .cart-control .cart-number,
	.dropdown-container .theme-title span{
		background: <?php echo esc_html($ts_header_icon_count_bg_color); ?>;
		color: <?php echo esc_html($ts_header_icon_count_color); ?>;
	}
	.header-v4 .header-middle .header-left > *,
	.header-v4 .header-middle .header-right > *,
	.header-v4 .header-middle .header-left .ts-search-by-category,
	.header-v4.header-transparent .is-sticky .header-middle .header-left .ts-search-by-category,
	.header-v4.header-transparent .is-sticky .header-middle .header-left > *,
	.header-v4.header-transparent .is-sticky .header-middle .header-right > *{
		background-color: <?php echo esc_html($ts_header_search_background_color); ?>;
	}
	.header-v4.header-transparent .header-middle .header-left .ts-search-by-category,
	.header-v4.header-transparent .header-middle .header-left > *,
	.header-v4.header-transparent .header-middle .header-right > *{
		background-color: <?php echo esc_html($ts_header_background_color); ?>;
	}
	
	/*** Breadcrumbs ***/
	.breadcrumb-title-wrapper{
		background-color: <?php echo esc_html($ts_breadcrumb_background_color); ?>;
	}
	.breadcrumb-title-wrapper .breadcrumbs,
	.breadcrumb-title-wrapper .page-title{
		color: <?php echo esc_html($ts_breadcrumb_text_color); ?>;
	}
	.breadcrumb-title-wrapper .breadcrumbs a,
	.breadcrumb-title-wrapper .brn_arrow:before,
	.breadcrumb-title-wrapper .breadcrumbs-container > span:not(.current):before,
	.breadcrumb-title-wrapper.breadcrumb-v1 .description{
		color: <?php echo esc_html($ts_breadcrumb_link_color); ?>;
	}

	/*** Footer ***/
	footer#colophon{
		background-color: <?php echo esc_html($ts_footer_background_color); ?>;
		color: <?php echo esc_html($ts_footer_text_color); ?>;
	}
	footer#colophon,
	.footer-container *{
		border-color: <?php echo esc_html($ts_footer_border_color); ?>;
	}
	.footer-container .elementor-widget-divider{
		--divider-color: <?php echo esc_html($ts_footer_border_color); ?>;
	}

	/*** Product ***/
	.column-tabs .list-categories,
	.woocommerce .products .product:not(.product-category) .product-wrapper,
	.product-hover-vertical-style-2 .products .product:not(.product-category) .product-wrapper:hover .product-group-button-meta{
		background-color: <?php echo esc_html($ts_products_background); ?>;
	}
	.product-name,
	h3.product-name,
	.product-name h3,
	.product_list_widget .title,
	ul.product_list_widget li a, 
	.woocommerce ul.cart_list li a, 
	.woocommerce ul.product_list_widget li a,
	.price,
	.product-price,
	.woocommerce div.product p.price,
	.woocommerce div.product span.price,
	ul.product_list_widget .product-categories,
	.price del,
	td[data-title="Price"] del,
	table.group_table del,
	.product-price del,
	body .wishlist_table.mobile table.item-details-table td del{
		color: <?php echo esc_html($ts_products_text_color); ?>;
	}
	.price ins,
	td[data-title="Price"] ins,
	table.group_table ins,
	body .wishlist_table.mobile table.item-details-table td ins,
	.product-price ins{
		color: <?php echo esc_html($ts_secondary_color); ?>;
	}
	.star-rating::before,
	.woocommerce .star-rating::before,
	.woocommerce p.stars a,
	.woocommerce p.stars a:hover ~ a,
	.woocommerce p.stars.selected a.active ~ a,
	.ts-testimonial-wrapper .rating:before,
	blockquote .rating:before{
		color: <?php echo esc_html($ts_rating_color); ?> !important;
	}
	.star-rating span, 
	.woocommerce .star-rating span, 
	.product_list_widget .star-rating span,
	.woocommerce p.stars:hover a, 
	.woocommerce p.stars.selected a, 
	.woocommerce .star-rating span:before, 
	.ts-testimonial-wrapper .rating span:before, 
	blockquote .rating span:before{
		color: <?php echo esc_html($ts_rating_fill_color); ?> !important;
	}
	.ts-product-deals-wrapper .content-wrapper,
	.woocommerce.main-products > .products > .list-categories{
		background-color: <?php echo esc_html($ts_secondary_light_color); ?>;
		border-color: <?php echo esc_html($ts_secondary_color); ?>;
	}
	.meta-wrapper .counter-wrapper .number,
	.counter-wrapper > div .number > span{
		background-color: <?php echo esc_html($ts_secondary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_secondary); ?>;
	}
	.counter-wrapper .separate{
		color: <?php echo esc_html($ts_secondary_color); ?>;
	}
	.woocommerce table.shop_table th,
	.woocommerce table.shop_table td:not(.actions),
	.woocommerce table.shop_table.shop_table_responsive.cart tr.cart_item,
	.woocommerce-cart table.cart td.actions .coupon .input-text, 
	.woocommerce form.checkout_coupon, 
	.woocommerce .checkout-login-coupon-wrapper form.login,
	.woocommerce > form.checkout #customer_details, 
	.woocommerce > form.checkout #order_review_heading,
	.woocommerce > form.checkout #order_review,
	.woocommerce-cart article .woocommerce .cart-collaterals,
	.woocommerce-checkout #order_review,
	.woocommerce #customer_login,
	.woocommerce form.track_order,
	body .wishlist_table.mobile li,
	.woocommerce.ts-search-result-container ul.product_list_widget li,
	.ts-floating-sidebar .woocommerce ul.product_list_widget li,
	#ts-search-sidebar .search-table .search-field input[type="text"],
	.woocommerce-account .woocommerce-MyAccount-content,
	.woocommerce-account .woocommerce-MyAccount-navigation li:not(:hover):not(.is-active) a,
	.woocommerce form.woocommerce-ResetPassword.lost_reset_password,
	.woocommerce div.product.product-style-3 .product-images-summary,
	.woocommerce div.product.product-style-3 .ts-product-brand-info,
	.woocommerce div.product.product-style-4 .product-images-summary,
	.summary-column-2 .ts-product-attribute > div.option:not(.color) > a,
	.woocommerce .summary-column-2 .quantity input.qty,
	.summary-column-2 .quantity input.qty,
	.ts-product-brand-info .brand-info-wrapper,
	.ts-product-brand-info .product_list_widget li,
	.ts-product.style-list .shortcode-heading-wrapper{
		background-color: <?php echo esc_html($ts_products_background); ?>;
	}
	body > #ts-search-result-container,
	.woocommerce-page.archive #main,
	.woocommerce-cart #main,
	.woocommerce-checkout #main,
	.woocommerce-account #main,
	.woocommerce-wishlist #main,
	div.product .summary-column-2,
	.woocommerce .cross-sells:before, 
	.woocommerce .up-sells:before, 
	.woocommerce .related:before,
	.woocommerce div.product > .ts-product-in-category-tab-wrapper:before,
	#ts-search-sidebar .ts-sidebar-content,
	article.single-post .single-related-wrapper{
		background-color: <?php echo esc_html($ts_products_wrapper_background); ?>;
	}
	@media only screen and (max-width: 1279px){
		#ts-filter-widget-area .ts-sidebar-content{
			background-color: <?php echo esc_html($ts_products_wrapper_background); ?>;
		}
	}
	.woocommerce div.product div.summary *{
		border-color: <?php echo esc_html($ts_product_detail_summary_border_color); ?>;
	}
	.woocommerce.yith-wfbt-section .yith-wfbt-images td > a,
	.woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-items,
	.woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-submit-block,
	.woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-items:after,
	.woocommerce .widget_price_filter .price_slider_amount .price_label > span:first-child:before,
	.woocommerce .widget_price_filter .price_slider_amount .price_label > span:last-child,
	.woocommerce div.product.product-style-3 .woocommerce-tabs:before,
	.woocommerce div.product.product-style-3 .ts-mailchimp-subscription-shortcode:before,
	.woocommerce div.product.product-style-3 .ts-instagram-shortcode:before,
	.woocommerce div.product.product-style-4 .woocommerce-tabs:before,
	.woocommerce div.product.product-style-4 .ts-mailchimp-subscription-shortcode:before,
	.woocommerce div.product.product-style-4 .ts-instagram-shortcode:before,
	.ts-active-filters .widget_layered_nav_filters ul li a,
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item a, 
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item span,
	.widget_product_categories ul.product-categories li > a,
	.widget_product_categories ul.product-categories li > span,
	.ts-product-categories-widget-wrapper ul.product-categories li > a,
	.ts-product-categories-widget-wrapper ul.product-categories li > span:not(.icon-toggle),
	.ts-product-categories-widget-wrapper > ul li.cat-parent > span.icon-toggle{
		background: <?php echo esc_html($ts_products_background); ?> !important;
	}
	.woocommerce-widget-layered-nav ul li:hover > a,
	.woocommerce-widget-layered-nav ul li:hover > span,
	.ts-active-filters .widget_layered_nav_filters ul li:hover a,
	.ts-active-filters .widget_layered_nav_filters ul li.chosen a,
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item:hover a, 
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item:hover span,
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen a, 
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen span,
	.widget_product_categories ul.product-categories li:hover > a,
	.widget_product_categories ul.product-categories li:hover > span,
	.widget_product_categories ul.product-categories li.current-cat > a,
	.widget_product_categories ul.product-categories li.current-cat > span,
	.ts-product-categories-widget-wrapper ul.product-categories li:hover > a,
	.ts-product-categories-widget-wrapper ul.product-categories li:hover > span:not(.icon-toggle),
	.ts-product-categories-widget-wrapper ul.product-categories li.current > a,
	.ts-product-categories-widget-wrapper ul.product-categories li.current > span:not(.icon-toggle),
	.ts-product-categories-widget-wrapper > ul li.cat-parent.current > span.icon-toggle{
		background: <?php echo esc_html($ts_primary_light_color); ?> !important;
		border-color: <?php echo esc_html($ts_primary_color); ?> !important;
	}
	@media only screen and (min-width: 1279px){
		.show-filter-top .product-filter-by-brand ul li label, 
		.show-filter-top .product-filter-by-availability ul li label, 
		.show-filter-top .product-filter-by-color ul li a{
			background: <?php echo esc_html($ts_products_background); ?> !important;
		}
		.show-filter-top .product-filter-by-brand ul li.selected label, 
		.show-filter-top .product-filter-by-brand ul li:hover label, 
		.show-filter-top .product-filter-by-availability ul li:hover label, 
		.show-filter-top .product-filter-by-availability ul li.selected label, 
		.show-filter-top .product-filter-by-color ul li:hover a,
		.show-filter-top .product-filter-by-color ul li.chosen a{
			background: <?php echo esc_html($ts_primary_light_color); ?> !important;
			border-color: <?php echo esc_html($ts_primary_color); ?> !important;
		}
	}
	
	/*** Product Label ***/
	.product_list_widget .product-label .onsale,
	.woocommerce .product .product-label .onsale{
		color: <?php echo esc_html($ts_product_sale_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_sale_label_background_color); ?>;
	}
	.product_list_widget .product-label .new,
	.woocommerce .product .product-label .new{
		color: <?php echo esc_html($ts_product_new_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_new_label_background_color); ?>;
	}
	.product_list_widget .product-label .featured,
	.woocommerce .product .product-label .featured{
		color: <?php echo esc_html($ts_product_feature_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_feature_label_background_color); ?>;
	}
	.product_list_widget .product-label .out-of-stock,
	.woocommerce .product .product-label .out-of-stock{
		color: <?php echo esc_html($ts_product_outstock_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_outstock_label_background_color); ?>;
	}
	
	/*** Mobile Buttons Bottom ***/
	#ts-mobile-button-bottom{
		background: <?php echo esc_html($ts_product_group_button_fixed_background_color); ?>;
		border-color: <?php echo esc_html($ts_product_group_button_fixed_border_color); ?>;
	}
	#ts-mobile-button-bottom > div .icon:before, 
	#ts-mobile-button-bottom .my-wishlist-wrapper .tini-wishlist:before, 
	#ts-mobile-button-bottom .shopping-cart-wrapper .cart-control .ic-cart:before, 
	#ts-mobile-button-bottom .ts-tiny-account-wrapper .account-control>a:before{
		color: <?php echo esc_html($ts_product_group_button_fixed_color); ?>;
	}
	#ts-mobile-button-bottom .my-wishlist-wrapper .tini-wishlist .count-number,
	#ts-mobile-button-bottom .shopping-cart-wrapper .cart-control .cart-number{
		background: <?php echo esc_html($ts_primary_color); ?>;
		border-color: <?php echo esc_html($ts_primary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}
	#group-icon-header .ts-sidebar-content{
		background-color: <?php echo esc_html($ts_menu_mobile_background_color); ?>;
	}
	#group-icon-header .ts-sidebar-content,
	.mobile-menu-wrapper,
	.mobile-menu-wrapper .mobile-menu{
		color: <?php echo esc_html($ts_menu_mobile_text_color); ?>;
	}
	
<?php update_option('ts_load_dynamic_style', 1); // uncomment after finished this file ?>	