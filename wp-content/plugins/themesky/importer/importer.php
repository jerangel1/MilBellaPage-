<?php 
if( !class_exists('TS_Importer') ){
	class TS_Importer{

		function __construct(){
			add_filter( 'ocdi/plugin_page_title', array($this, 'import_notice') );
			
			add_filter( 'ocdi/plugin_page_setup', array($this, 'import_page_setup') );
			add_action( 'ocdi/before_widgets_import', array($this, 'before_widgets_import') );
			add_filter( 'ocdi/import_files', array($this, 'import_files') );
			add_filter( 'ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
			add_action( 'ocdi/after_import', array($this, 'after_import_setup') );
			
			if( wp_doing_ajax() && isset($_POST['action']) && 'ocdi_import_demo_data' == $_POST['action'] ){
				add_filter('upload_mimes', array($this, 'allow_upload_font_files'));
			}
		}
		
		function import_notice( $plugin_title ){
			$allowed_html = array(
				'a' => array( 'href' => array(), 'target' => array() )
			);
			ob_start();
			?>
			<div class="ts-ocdi-notice-info">
				<p>
					<i class="fas fa-exclamation-circle"></i>
					<span><?php echo wp_kses( __('If you have any problem with importer, please read this article <a href="https://ocdi.com/import-issues/" target="_blank">https://ocdi.com/import-issues/</a> and check your hosting configuration, or contact our support team here <a href="https://skygroup.ticksy.com/" target="_blank">https://skygroup.ticksy.com/</a>.', 'themesky'), $allowed_html ); ?></span>
				</p>
			</div>
			<?php
			$plugin_title .= ob_get_clean();
			return $plugin_title;
		}
		
		function allow_upload_font_files( $existing_mimes = array() ){
			$existing_mimes['svg'] = 'font/svg';
			return $existing_mimes;
		}
		
		function import_page_setup( $default_settings ){
			$default_settings['parent_slug'] = 'themes.php';
			$default_settings['page_title']  = esc_html__( 'Agrofood - Import Demo Content' , 'themesky' );
			$default_settings['menu_title']  = esc_html__( 'Agrofood Importer' , 'themesky' );
			$default_settings['capability']  = 'import';
			$default_settings['menu_slug']   = 'agrofood-importer';
			return $default_settings;
		}
		
		function before_widgets_import(){
			global $wp_registered_sidebars;
			$file_path = dirname(__FILE__) . '/data/custom_sidebars.txt';
			if( file_exists($file_path) ){
				$file_url = plugin_dir_url(__FILE__) . 'data/custom_sidebars.txt';
				$custom_sidebars = wp_remote_get( $file_url );
				$custom_sidebars = maybe_unserialize( trim( $custom_sidebars['body'] ) );
				update_option('ts_custom_sidebars', $custom_sidebars);
				
				if( is_array($custom_sidebars) && !empty($custom_sidebars) ){
					foreach( $custom_sidebars as $name ){
						$custom_sidebar = array(
											'name' 			=> ''.$name.''
											,'id' 			=> sanitize_title($name)
											,'description' 	=> ''
											,'class'		=> 'ts-custom-sidebar'
										);
						if( !isset($wp_registered_sidebars[$custom_sidebar['id']]) ){
							$wp_registered_sidebars[$custom_sidebar['id']] = $custom_sidebar;
						}
					}
				}
			}
		}
		
		function import_files(){
			return array(
				array(
					'import_file_name'           => 'Demo Import',
					'import_file_url'            => plugin_dir_url( __FILE__ ) . 'data/content.xml',
					'import_widget_file_url'     => plugin_dir_url( __FILE__ ) . 'data/widget_data.wie',
					'import_redux'               => array(
						array(
							'file_url'    => plugin_dir_url( __FILE__ ) . 'data/redux.json',
							'option_name' => 'agrofood_theme_options',
						),
					)
				)
			);
		}
		
		function after_import_setup(){
			set_time_limit(0);
			$this->woocommerce_settings();
			$this->menu_locations();
			$this->set_homepage();
			$this->import_revslider();
			$this->change_url();
			$this->set_elementor_site_settings();
			$this->update_theme_options();
			$this->update_menu_homepage();
			$this->update_product_category_id_in_homepage_content();
			$this->update_mega_menu_content();
			$this->update_footer_content();
			$this->delete_transients();
			$this->update_woocommerce_lookup_table();
			$this->update_menu_term_count();
		}
		
		function get_post_by_title($post_title, $post_type = 'page'){
			$query = new WP_Query(
						array(
							'post_type'               => $post_type
							,'title'                  => $post_title
							,'post_status'            => 'publish'
							,'posts_per_page'         => 1
							,'no_found_rows'          => true
							,'ignore_sticky_posts'    => true
							,'update_post_term_cache' => false
							,'update_post_meta_cache' => false
							,'orderby'                => 'post_date ID'
							,'order'                  => 'ASC'
						)
					);
		 
			if( ! empty( $query->post ) ){
				return $query->post;
			}
			return null;
		}
		
		/* WooCommerce Settings */
		function woocommerce_settings(){
			$woopages = array(
				'woocommerce_shop_page_id' 			=> 'Shop'
				,'woocommerce_cart_page_id' 		=> 'Shopping Cart'
				,'woocommerce_checkout_page_id' 	=> 'Checkout'
				,'woocommerce_myaccount_page_id' 	=> 'My Account'
				,'yith_wcwl_wishlist_page_id' 		=> 'Wishlist'
			);
			foreach( $woopages as $woo_page_name => $woo_page_title ) {
				$woopage = $this->get_post_by_title( $woo_page_title );
				if( isset( $woopage->ID ) && $woopage->ID ) {
					update_option($woo_page_name, $woopage->ID);
				}
			}
			
			if( class_exists('YITH_Woocompare') ){
				update_option('yith_woocompare_compare_button_in_products_list', 'yes');
			}
			
			if( class_exists('YITH_WCWL') ){
				update_option('yith_wcwl_show_on_loop', 'yes');
			}

			if( class_exists('WC_Admin_Notices') ){
				WC_Admin_Notices::remove_notice('install');
			}
			delete_transient( '_wc_activation_redirect' );
			
			flush_rewrite_rules();
		}
		
		/* Menu Locations */
		function menu_locations(){
			$locations = get_theme_mod( 'nav_menu_locations' );
			$menus = wp_get_nav_menus();

			if( $menus ){
				foreach( $menus as $menu ){
					if( $menu->name == 'Main Menu' ){
						$locations['primary'] = $menu->term_id;
					}
					if( $menu->name == 'Mobile Menu' ){
						$locations['mobile'] = $menu->term_id;
					}
					if( $menu->name == 'Shop by products' ){
						$locations['vertical'] = $menu->term_id;
					}
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations );
		}
		
		/* Set Homepage */
		function set_homepage(){
			$homepage = $this->get_post_by_title( 'Home' );
			if( isset( $homepage->ID ) ){
				update_option('show_on_front', 'page');
				update_option('page_on_front', $homepage->ID);
			}
		}
		
		/* Import Revolution Slider */
		function import_revslider(){
			if ( class_exists( 'RevSliderSliderImport' ) ) {
				$rev_directory = dirname(__FILE__) . '/data/revslider/';
			
				foreach( glob( $rev_directory . '*.zip' ) as $file ){
					$import = new RevSliderSliderImport();
					$import->import_slider(true, $file);  
				}
			}
		}
		
		/* Change url */
		function change_url(){
			global $wpdb;
			$wp_prefix = $wpdb->prefix;
			$import_url = 'https://demo.theme-sky.com/agrofood-import';
			$site_url = get_option( 'siteurl', '' );
			$wpdb->query("update `{$wp_prefix}posts` set `guid` = replace(`guid`, '{$import_url}', '{$site_url}');");
			$wpdb->query("update `{$wp_prefix}posts` set `post_content` = replace(`post_content`, '{$import_url}', '{$site_url}');");
			$wpdb->query("update `{$wp_prefix}posts` set `post_title` = replace(`post_title`, '{$import_url}', '{$site_url}') where post_type='nav_menu_item';");
			$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '{$import_url}', '{$site_url}');");
			$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '" . str_replace( '/', '\\\/', $import_url ) . "', '" . str_replace( '/', '\\\/', $site_url ) . "') where `meta_key` = '_elementor_data';");
			
			$option_name = 'agrofood_theme_options';
			$option_ids = array( 
						'ts_logo'
						,'ts_logo_mobile'
						,'ts_logo_sticky'
						,'ts_favicon'
						,'ts_custom_loading_image'
						,'ts_bg_breadcrumbs'
						,'ts_prod_placeholder_img'
						,'ts_prod_category_image_top'
						,'ts_prod_category_image_bottom'
						,'ts_prod_ads_banner_content'
						);
			$theme_options = get_option($option_name);
			if( is_array($theme_options) ){
				foreach( $option_ids as $option_id ){
					if( isset($theme_options[$option_id]) ){
						$theme_options[$option_id] = str_replace($import_url, $site_url, $theme_options[$option_id]);
					}
				}
				update_option($option_name, $theme_options);
			}
			
			/* Update Widgets */
			$widgets = array(
				'media_image' 	=> array('url', 'link_url')
				,'text' 		=> array('text')
			);
			foreach( $widgets as $base => $fields ){
				$widget_instances = get_option( 'widget_' . $base, array() );
				if( is_array($widget_instances) ){
					foreach( $widget_instances as $number => $instance ){
						if( $number == '_multiwidget' ){
							continue;
						}
						foreach( $fields as $field ){
							if( isset($widget_instances[$number][$field]) ){
								$widget_instances[$number][$field] = str_replace($import_url, $site_url, $widget_instances[$number][$field]);
							}
						}
					}
					update_option( 'widget_' . $base, $widget_instances );
				}
			}
		}
		
		/* Set Elementor Site Settings */
		function set_elementor_site_settings(){
			$id = 0;
			
			$args = array(
				'post_type' 		=> 'elementor_library'
				,'post_status' 		=> 'public'
				,'posts_per_page'	=> 1
				,'orderby'			=> 'date'
				,'order'			=> 'ASC' /* Date is not changed when import. Use imported post */
			);
			
			$posts = new WP_Query( $args );
			if( $posts->have_posts() ){
				$id = $posts->post->ID;
				update_option('elementor_active_kit', $id);
			}
			
			if( $id ){ /* Fixed width, space, ... if query does not return the imported post */
				$page_settings = get_post_meta($id, '_elementor_page_settings', true);
			
				if( !is_array($page_settings) ){
					$page_settings = array();
				}
					
				if( !isset($page_settings['container_width']) ){
					$page_settings['container_width'] = array();
				}
				
				$page_settings['container_width']['unit'] = 'px';
				$page_settings['container_width']['size'] = 1240;
				$page_settings['container_width']['sizes'] = array();
				
				if( !isset($page_settings['space_between_widgets']) ){
					$page_settings['space_between_widgets'] = array();
				}
				
				$page_settings['space_between_widgets']['unit'] = 'px';
				$page_settings['space_between_widgets']['size'] = 20;
				$page_settings['space_between_widgets']['column'] = 20;
				$page_settings['space_between_widgets']['row'] = 20;
				$page_settings['space_between_widgets']['sizes'] = array();
				
				$page_settings['page_title_selector'] = 'h1.entry-title';
				
				update_post_meta($id, '_elementor_page_settings', $page_settings);
			}
			
			/* Use color, font from theme */
			update_option('elementor_disable_color_schemes', 'yes');
			update_option('elementor_disable_typography_schemes', 'yes');
		}
		
		/* Update Header Page Links */
		function update_theme_options(){
			$option_name = 'agrofood_theme_options';
			$theme_options = get_option($option_name);
			if( is_array($theme_options) ){
				$list_pages = array(
					'ts_404_page' => array('404 Page')
					,'ts_portfolio_page' => array('Portfolio')
				);
				
				foreach( $list_pages as $option_key => $page_titles ){
					$page_ids = array();
					foreach( $page_titles as $page_title ){
						$page = $this->get_post_by_title( $page_title );
						if( is_object( $page ) ){
							$page_ids[] = $page->ID;
						}
					}
					if( count($page_ids) == 1 ){ /* not multi */
						$page_ids = implode('', $page_ids);
					}
					$theme_options[$option_key] = $page_ids;
				}
				
				/* Product Category */
				$list_categories = array(
					'ts_header_specific_product_categories' => array('Bread', 'Candy', 'Coffee & Tea', 'Dry foods', 'ECO', 'Fruits', 'Nuts', 'Spices', 'Vegetables', 'Snacks', 'Cakes', 'Exotic')
					,'ts_prod_parent_category_top' => array('Fruits')
					,'ts_prod_parent_category_bottom' => array('Vegetables')
				);
				
				foreach( $list_categories as $option_key => $cat_names ){
					$cat_ids = array();
					foreach( $cat_names as $cat_name ){
						$cat = get_term_by('name', $cat_name, 'product_cat');
						if( isset($cat->term_id) ){
							$cat_ids[] = $cat->term_id;
						}
					}
					if( count($cat_ids) == 1 ){ /* not multi */
						$cat_ids = implode('', $cat_ids);
					}
					$theme_options[$option_key] = $cat_ids;
				}
				
				update_option($option_name, $theme_options);
			}
		}
		
		/* Set menu for home pages */
		function update_menu_homepage(){
			$pages = array(
				'Home 4' 	=> array('ts_menu_id' => 'Main Menu 2')
				,'Home 5' 	=> array('ts_menu_id' => 'Main Menu 4', 'ts_vertical_menu_id' => 'Shop by products - 2')
				,'Home 6' 	=> array('ts_menu_id' => 'Main Menu 3', 'ts_vertical_menu_id' => 'Shop by products - 3')
				,'Home 7' 	=> array('ts_menu_id' => 'Main Menu 3')
				,'Home 8' 	=> array('ts_menu_id' => 'Main Menu 3')
			);
			
			foreach( $pages as $page_title => $page_menus ){
				$page = $this->get_post_by_title( $page_title );
				if( is_object( $page ) ){
					foreach( $page_menus as $option_key => $menu_name ){
						$menu = get_term_by( 'name', $menu_name, 'nav_menu' );
						if( isset($menu->term_id) ){
							update_post_meta( $page->ID, $option_key, $menu->term_id );
						}
					}
				}
			}
		}
		
		/* Update Product Category Id In Homepage Content */
		function update_product_category_id_in_homepage_content(){
			global $wpdb;
			$wp_prefix = $wpdb->prefix;
			
			$pages = array(
					'Home'	=> array(
							array(
								'211,212,213,214,247,189,205,215,188'
								,array( 'Bread', 'Candy', 'Coffee & Tea', 'Dry foods', 'ECO', 'Fruits', 'Nuts', 'Spices', 'Vegetables' )
								,'ids'
							)
							,array(
								'188'
								,array( 'Vegetables' )
								,'product_cats'
							)
							,array(
								'189'
								,array( 'Fruits' )
								,'product_cats'
							)
							,array(
								'190'
								,array( 'Nutes & Seeds' )
								,'product_cats'
							)
							,array(
								'191'
								,array( 'Juices and drinks' )
								,'product_cats'
							)
					)
					,'Home 2'	=> array(
							array(
								'189'
								,array( 'Fruits' )
								,'parent_cat'
							)
							,array(
								'190'
								,array( 'Nutes & Seeds' )
								,'parent_cat'
							)
							,array(
								'188'
								,array( 'Vegetables' )
								,'parent_cat'
							)
					)
					,'Home 3'	=> array(
							array(
								'211,212,213,214,247,189,205,215,188,216,217,218'
								,array( 'Bread', 'Candy', 'Coffee & Tea', 'Dry foods', 'ECO', 'Fruits', 'Nuts', 'Spices', 'Vegetables', 'Snacks', 'Cakes', 'Exotic' )
								,'ids'
							)
							,array(
								'189'
								,array( 'Fruits' )
								,'parent_cat'
							)
							,array(
								'190'
								,array( 'Nutes & Seeds' )
								,'parent_cat'
							)
							,array(
								'188'
								,array( 'Vegetables' )
								,'parent_cat'
							)
					)
					,'Home 4'	=> array(
							array(
								'189'
								,array( 'Fruits' )
								,'product_cats'
							)
							,array(
								'188'
								,array( 'Vegetables' )
								,'product_cats'
							)
					)
					,'Home 5'	=> array(
							array(
								'211,212,213,214,247,189,205,215,188'
								,array( 'Bread', 'Candy', 'Coffee & Tea', 'Dry foods', 'ECO', 'Fruits', 'Nuts', 'Spices', 'Vegetables' )
								,'ids'
							)
							,array(
								'189'
								,array( 'Fruits' )
								,'parent_cat'
							)
							,array(
								'188'
								,array( 'Vegetables' )
								,'parent_cat'
							)
							,array(
								'190'
								,array( 'Nutes & Seeds' )
								,'parent_cat'
							)
					)
					,'Home 6'	=> array(
							array(
								'211,212,213,214,247,189,205,215,188'
								,array( 'Bread', 'Candy', 'Coffee & Tea', 'Dry foods', 'ECO', 'Fruits', 'Nuts', 'Spices', 'Vegetables' )
								,'ids'
							)
							,array(
								'189'
								,array( 'Fruits' )
								,'product_cats'
							)
							,array(
								'188'
								,array( 'Vegetables' )
								,'product_cats'
							)
							,array(
								'205'
								,array( 'Nuts' )
								,'product_cats'
							)
					)
					,'Home 7'	=> array(
							array(
								'211,212,213,214,247,189,205,215,188'
								,array( 'Bread', 'Candy', 'Coffee & Tea', 'Dry foods', 'ECO', 'Fruits', 'Nuts', 'Spices', 'Vegetables' )
								,'ids'
							)
					)
					,'Home 8'	=> array(
							array(
								'211,212,213,214,247,189'
								,array( 'Bread', 'Candy', 'Coffee & Tea', 'Dry foods', 'ECO', 'Fruits' )
								,'ids'
							)
							,array(
								'205,215,188,216,217,218'
								,array( 'Nuts', 'Spices', 'Vegetables', 'Snacks', 'Cakes', 'Exotic' )
								,'ids'
							)
							,array(
								'182,183,184,185,186,264'
								,array( 'Potatoes', 'Tomatoes', 'Cucumbers', 'Onion', 'Cabbage', 'New items in this category' )
								,'ids'
							)
							,array(
								'192,193,194,195,199,196'
								,array( 'Pineapple', 'Bananas', 'Dates', 'Figs', 'Apples', 'Mango' )
								,'ids'
							)
							,array(
								'200,201,202,203,204,205,198'
								,array( 'Raisins', 'Dates', 'Figs', 'Apricots', 'Almonds', 'Nuts', 'Plums' )
								,'ids'
							)
							,array(
								'273,266,274,263,216,213'
								,array( 'Vegetables and fruits', 'Bakery', 'Food', 'Sweet', 'Snacks', 'Coffee & Tea' )
								,'ids'
							)
							,array(
								'266'
								,array( 'Bakery' )
								,'parent'
							)
							,array(
								'191'
								,array( 'Juices and drinks' )
								,'parent'
							)
					)
			);
			
			$loaded_categories = array();
			
			foreach( $pages as $page_title => $cat_ids_names ){
				$page = $this->get_post_by_title( $page_title );
				if( is_object( $page ) ){
					foreach( $cat_ids_names as $cat_id_name ){
						$key = isset($cat_id_name[2]) ? $cat_id_name[2] : 'ids';
						
						$old_ids = explode(',', $cat_id_name[0]);
						
						$new_ids = array();
						foreach( $cat_id_name[1] as $cat_name ){
							$loaded_id = array_search($cat_name, $loaded_categories);
							if( $loaded_id ){
								$new_ids[] = $loaded_id;
							}
							else{
								$cat = get_term_by('name', $cat_name, 'product_cat');
								if( isset($cat->term_id) ){
									$new_ids[] = $cat->term_id;
									$loaded_categories[$cat->term_id] = $cat_name;
								}
							}
						}
						
						if( $key == 'parent' || $key == 'parent_cat' ){ /* not multi */
							$old_string = '"' . $key . '":"' . implode('', $old_ids) . '"';
							$new_string = '"' . $key . '":"' . implode('', $new_ids) . '"';
						}
						else{
							$old_string = '"' . $key . '":["' . implode('","', $old_ids) . '"]';
							$new_string = '"' . $key . '":["' . implode('","', $new_ids) . '"]';
						}
						
						$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '" . $old_string . "', '" . $new_string . "') where `meta_key` = '_elementor_data' and post_id=" . $page->ID . ";");
					}
				}
			}
			
			/* Product Brand - Home 2 */
			$page = $this->get_post_by_title( 'Home 2' );
			if( is_object( $page ) ){
				$brand_id_names = array(
					array(
						'219,220,221,222,223,224,225,226,227'
						, array('Colas Company', 'Let\'s Cook', 'Food', 'Best Cook', 'Cooking', 'Marcises', 'Krungthep', 'Topolis', 'Skialist')
					)
					,array(
						'228,229,230,231,232,233,251,252,253'
						, array('Medicstore', 'iHeart', 'We Take Care', 'Medi Alarm', 'Heart Shield', 'Best Pharm', 'Pharmy', 'Heart Rate', 'I love health')
					)
				);
				$key = 'brands';
				
				foreach( $brand_id_names as $brand_id_name ){
					$old_ids = explode(',', $brand_id_name[0]);
						
					$new_ids = array();
					foreach( $brand_id_name[1] as $brand_name ){
						$brand = get_term_by('name', $brand_name, 'ts_product_brand');
						if( isset($brand->term_id) ){
							$new_ids[] = $brand->term_id;
						}
					}
					
					$old_string = '"' . $key . '":["' . implode('","', $old_ids) . '"]';
					$new_string = '"' . $key . '":["' . implode('","', $new_ids) . '"]';
					$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '" . $old_string . "', '" . $new_string . "') where `meta_key` = '_elementor_data' and post_id=" . $page->ID . ";");
				}
			}
		}
		
		/* Update Mega Menu Content */
		function update_mega_menu_content(){
			global $wpdb;
			$wp_prefix = $wpdb->prefix;
			
			/* Product Categories */
			$mega_menus = array(
					'Vegetables - 2'	=> array(
							'ids' => array(
								'192,193,194,195,199,196,197,198,264'
								, array( 'Pineapple', 'Bananas', 'Dates', 'Figs', 'Apples', 'Mango', 'Apricots', 'Plums', 'New items in this category' )
							)
					)
					,'Fruits - 2'	=> array(
							'parent' => array(
								'189'
								, array( 'Fruits' )
							)
					)
					,'Nuts - 2'	=> array(
							'ids' => array(
								'200,201,202,203,204,205,198,280'
								, array( 'Raisins', 'Dates', 'Figs', 'Apricots', 'Almonds', 'Nuts', 'Plums', 'Cherries' )
							)
					)
					,'Eco - 2'	=> array(
							'ids' => array(
								'273,266,274,263,216,213,214,191'
								, array( 'Vegetables and fruits', 'Bakery', 'Food', 'Sweet', 'Snacks', 'Coffee & Tea', 'Dry foods', 'Juices and drinks' )
							)
					)
					,'Bread - 2'	=> array(
							'ids' => array(
								'265,211,260,261,262,263,277,278'
								, array( 'BIO', 'Bread', 'Dry bread', 'No gluten', 'Rolls', 'Sweet', 'Toast', 'Others' )
							)
					)
					,'Vegetables'	=> array(
							'ids' => array(
								'192,193,194,195,199,196,197,198,264'
								, array( 'Pineapple', 'Bananas', 'Dates', 'Figs', 'Apples', 'Mango', 'Apricots', 'Plums', 'New items in this category' )
							)
					)
					,'Fruits'	=> array(
							'parent' => array(
								'189'
								, array( 'Fruits' )
							)
					)
					,'Nuts'	=> array(
							'ids' => array(
								'200,201,202,203,204,205,198,280'
								, array( 'Raisins', 'Dates', 'Figs', 'Apricots', 'Almonds', 'Nuts', 'Plums', 'Cherries' )
							)
					)
					,'Eco'	=> array(
							'ids' => array(
								'273,266,274,263,216,213,214,191,279'
								, array( 'Vegetables and fruits', 'Bakery', 'Food', 'Sweet', 'Snacks', 'Coffee & Tea', 'Dry foods', 'Juices and drinks', 'Cleaning' )
							)
					)
					,'Bread'	=> array(
							'ids' => array(
								'265,211,260,261,262,263,277,278'
								, array( 'BIO', 'Bread', 'Dry bread', 'No gluten', 'Rolls', 'Sweet', 'Toast', 'Others' )
							)
					)
			);
			
			$loaded_categories = array();
			
			foreach( $mega_menus as $title => $cat_ids_names ){
				$mega_menu_post = $this->get_post_by_title( $title, 'ts_mega_menu' );
				if( is_object( $mega_menu_post ) ){
					foreach( $cat_ids_names as $key => $cat_id_name ){
						$old_ids = explode(',', $cat_id_name[0]);
						
						$new_ids = array();
						foreach( $cat_id_name[1] as $cat_name ){
							$loaded_id = array_search($cat_name, $loaded_categories);
							if( $loaded_id ){
								$new_ids[] = $loaded_id;
							}
							else{
								$cat = get_term_by('name', $cat_name, 'product_cat');
								if( isset($cat->term_id) ){
									$new_ids[] = $cat->term_id;
									$loaded_categories[$cat->term_id] = $cat_name;
								}
							}
						}
						
						if( $key == 'parent' ){
							$old_string = '"' . $key . '":"' . implode('', $old_ids) . '"';
							$new_string = '"' . $key . '":"' . implode('', $new_ids) . '"';
						}
						else{
							$old_string = '"' . $key . '":["' . implode('","', $old_ids) . '"]';
							$new_string = '"' . $key . '":["' . implode('","', $new_ids) . '"]';
						}
						
						$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '" . $old_string . "', '" . $new_string . "') where `meta_key` = '_elementor_data' and post_id=" . $mega_menu_post->ID . ";");
					}
				}
			}
			
			/* Update Nav Menu */
			$mega_menus = array(
				'Mega - Pages'	=> array(83 => 'Pages - Homes', 81 => 'Pages - Category', 149 => 'Pages - Product', 257 => 'Pages - Blog & Portfolio', 82 => 'Pages - Other')
			);
			
			foreach( $mega_menus as $title => $menus ){
				$mega_menu_post = $this->get_post_by_title( $title, 'ts_mega_menu' );
				if( is_object( $mega_menu_post ) ){
					foreach( $menus as $old_id => $menu_name ){
						$menu = get_term_by( 'name', $menu_name, 'nav_menu' );
						if( isset($menu->term_id) ){
							$old_string = '"nav_menu":"' . $old_id . '"';
							$new_string = '"nav_menu":"' . $menu->term_id . '"';
							$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '" . $old_string . "', '" . $new_string . "') where `meta_key` = '_elementor_data' and post_id=" . $mega_menu_post->ID . ";");
						}
					}
				}
			}
		}
		
		/* Update Footer Content */
		function update_footer_content(){
			global $wpdb;
			$wp_prefix = $wpdb->prefix;
			
			/* Update Nav Menu */
			$footers = array(
				'Footer 5'			=> array(248 => 'Footer - Account', 249 => 'Footer - Store', 250 => 'Footer - Horizontal')
				,'Footer 4'			=> array(248 => 'Footer - Account', 249 => 'Footer - Store', 250 => 'Footer - Horizontal')
				,'Footer 3'			=> array(248 => 'Footer - Account', 249 => 'Footer - Store', 250 => 'Footer - Horizontal')
				,'Footer 2'			=> array(248 => 'Footer - Account', 249 => 'Footer - Store', 250 => 'Footer - Horizontal')
				,'Footer 1'			=> array(248 => 'Footer - Account', 249 => 'Footer - Store', 250 => 'Footer - Horizontal')
			);
			
			foreach( $footers as $title => $menus ){
				$footer_post = $this->get_post_by_title( $title, 'ts_footer_block' );
				if( is_object( $footer_post ) ){
					foreach( $menus as $old_id => $menu_name ){
						$menu = get_term_by( 'name', $menu_name, 'nav_menu' );
						if( isset($menu->term_id) ){
							$old_string = '"nav_menu":"' . $old_id . '"';
							$new_string = '"nav_menu":"' . $menu->term_id . '"';
							$wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '" . $old_string . "', '" . $new_string . "') where `meta_key` = '_elementor_data' and post_id=" . $footer_post->ID . ";");
						}
					}
				}
			}
		}
		
		/* Delete transient */
		function delete_transients(){
			delete_transient('ts_mega_menu_custom_css');
			delete_transient('ts_product_deals_ids');
			delete_transient('wc_products_onsale');
		}
		
		/* Update WooCommerce Loolup Table */
		function update_woocommerce_lookup_table(){
			if( function_exists('wc_update_product_lookup_tables_is_running') && function_exists('wc_update_product_lookup_tables') ){
				if( !wc_update_product_lookup_tables_is_running() ){
					if( !defined('WP_CLI') ){
						define('WP_CLI', true);
					}
					wc_update_product_lookup_tables();
				}
			}
		}
		
		/* Update Menu Term Count - Keep this function until One Click Demo Import fixed */
		function update_menu_term_count(){
			$args = array(
						'taxonomy'		=> 'nav_menu'
						,'hide_empty'	=> 0
						,'fields'		=> 'ids'
					);
			$menus = get_terms( $args );
			if( is_array($menus) ){
				wp_update_term_count_now( $menus, 'nav_menu' );
			}
		}
	}
	new TS_Importer();
}
?>