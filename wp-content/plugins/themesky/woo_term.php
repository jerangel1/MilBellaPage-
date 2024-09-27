<?php 
class TS_Custom_Product_Category{

	function __construct(){
		if( is_admin() ){
			add_action( 'product_cat_add_form_fields', array($this, 'add_category_fields'), 20 );
			add_action( 'product_cat_edit_form_fields', array($this, 'edit_category_fields'), 20, 2 );
			add_action( 'created_term', array($this, 'save_category_fields'), 10, 3 );
			add_action( 'edit_term', array($this, 'save_category_fields'), 10, 3 );
		}
	}
	
	function add_category_fields(){
		$default_sidebars = function_exists('agrofood_get_list_sidebars')?agrofood_get_list_sidebars():array();
		$sidebar_options = array();
		foreach( $default_sidebars as $key => $_sidebar ){
			$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
		}
		?>

		<div class="form-field ts-product-cat-upload-field">
			<label><?php esc_html_e( 'Icon', 'themesky' ); ?></label>
			<div class="preview-image">
				<img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" />
			</div>
			<div class="button-wrapper">
				<input type="hidden" class="placeholder-image-url" value="<?php echo esc_url( wc_placeholder_img_src() ); ?>" />
				<input type="hidden" name="product_cat_icon_id" class="value-field" value="" />
				<button type="button" class="button upload-button"><?php esc_html_e('Upload/Add image', 'themesky') ?></button>
				<button type="button" class="button remove-button"><?php esc_html_e('Remove image', 'themesky') ?></button>
			</div>
		</div>
		
		<div class="form-field ts-product-cat-upload-field">
			<label><?php esc_html_e( 'Breadcrumbs Background Image', 'themesky' ); ?></label>
			<div class="preview-image">
				<img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" />
			</div>
			<div class="button-wrapper">
				<input type="hidden" class="placeholder-image-url" value="<?php echo esc_url( wc_placeholder_img_src() ); ?>" />
				<input type="hidden" name="product_cat_bg_breadcrumbs_id" class="value-field" value="" />
				<button type="button" class="button upload-button"><?php esc_html_e('Upload/Add image', 'themesky') ?></button>
				<button type="button" class="button remove-button"><?php esc_html_e('Remove image', 'themesky') ?></button>
			</div>
		</div>
		
		<div class="form-field">
			<label for="layout"><?php esc_html_e( 'Layout', 'themesky' ); ?></label>
			<select name="layout" id="layout">
				<option value=""><?php esc_html_e('Default', 'themesky') ?></option>
				<option value="0-1-0"><?php esc_html_e('Fullwidth', 'themesky') ?></option>
				<option value="1-1-0"><?php esc_html_e('Left Sidebar', 'themesky') ?></option>
				<option value="0-1-1"><?php esc_html_e('Right Sidebar', 'themesky') ?></option>
				<option value="1-1-1"><?php esc_html_e('Left & Right Sidebar', 'themesky') ?></option>
			</select>
		</div>
		
		<div class="form-field">
			<label for="left_sidebar"><?php esc_html_e( 'Left Sidebar', 'themesky' ); ?></label>
			<select name="left_sidebar" id="left_sidebar">
				<option value=""><?php esc_html_e('Default', 'themesky') ?></option>
				<?php foreach( $sidebar_options as $sidebar_id => $sidebar_name ): ?>
					<option value="<?php echo esc_attr($sidebar_id); ?>"><?php echo esc_html($sidebar_name); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<div class="form-field">
			<label for="right_sidebar"><?php esc_html_e( 'Right Sidebar', 'themesky' ); ?></label>
			<select name="right_sidebar" id="right_sidebar">
				<option value=""><?php esc_html_e('Default', 'themesky') ?></option>
				<?php foreach( $sidebar_options as $sidebar_id => $sidebar_name ): ?>
					<option value="<?php echo esc_attr($sidebar_id); ?>"><?php echo esc_html($sidebar_name); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<?php
	}
	
	function edit_category_fields( $term, $taxonomy ){
		$default_sidebars = function_exists('agrofood_get_list_sidebars')?agrofood_get_list_sidebars():array();
		$sidebar_options = array();
		foreach( $default_sidebars as $key => $_sidebar ){
			$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
		}
	
		$icon_id = get_term_meta($term->term_id, 'icon_id', true);
		$bg_breadcrumbs_id = get_term_meta($term->term_id, 'bg_breadcrumbs_id', true);
		$layout = get_term_meta($term->term_id, 'layout', true);
		$left_sidebar = get_term_meta($term->term_id, 'left_sidebar', true);
		$right_sidebar = get_term_meta($term->term_id, 'right_sidebar', true);
		?>

		<tr class="form-field ts-product-cat-upload-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Icon', 'themesky' ); ?></label></th>
			<td>
				<div class="preview-image">
					<?php 
					if( empty($icon_id) ){
						$icon_src = wc_placeholder_img_src();
					}
					else{
						$icon_src = wp_get_attachment_image_url( $icon_id, 'thumbnail' );
					}
					?>
					<img src="<?php echo esc_url( $icon_src ); ?>" width="60px" height="60px" />
				</div>
				<div class="button-wrapper">
					<input type="hidden" class="placeholder-image-url" value="<?php echo esc_url( wc_placeholder_img_src() ); ?>" />
					<input type="hidden" name="product_cat_icon_id" class="value-field" value="<?php echo esc_attr($icon_id) ?>" />
					<button type="button" class="button upload-button"><?php esc_html_e('Upload/Add image', 'themesky') ?></button>
					<button type="button" class="button remove-button"><?php esc_html_e('Remove image', 'themesky') ?></button>
				</div>
			</td>
		</tr>
		
		<tr class="form-field ts-product-cat-upload-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Breadcrumbs Background Image', 'themesky' ); ?></label></th>
			<td>
				<div class="preview-image">
					<?php 
					if( empty($bg_breadcrumbs_id) ){
						$bg_breadcrumbs_src = wc_placeholder_img_src();
					}
					else{
						$bg_breadcrumbs_src = wp_get_attachment_image_url( $bg_breadcrumbs_id, 'thumbnail' );
					}
					?>
					<img src="<?php echo esc_url( $bg_breadcrumbs_src ); ?>" width="60px" height="60px" />
				</div>
				<div class="button-wrapper">
					<input type="hidden" class="placeholder-image-url" value="<?php echo esc_url( wc_placeholder_img_src() ); ?>" />
					<input type="hidden" name="product_cat_bg_breadcrumbs_id" class="value-field" value="<?php echo esc_attr($bg_breadcrumbs_id) ?>" />
					<button type="button" class="button upload-button"><?php esc_html_e('Upload/Add image', 'themesky') ?></button>
					<button type="button" class="button remove-button"><?php esc_html_e('Remove image', 'themesky') ?></button>
				</div>
			</td>
		</tr>
		
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Layout', 'themesky' ); ?></label></th>
			<td>
				<select name="layout" id="layout">
					<option value="" <?php selected($layout, ''); ?>><?php esc_html_e('Default', 'themesky') ?></option>
					<option value="0-1-0" <?php selected($layout, '0-1-0'); ?>><?php esc_html_e('Fullwidth', 'themesky') ?></option>
					<option value="1-1-0" <?php selected($layout, '1-1-0'); ?>><?php esc_html_e('Left Sidebar', 'themesky') ?></option>
					<option value="0-1-1" <?php selected($layout, '0-1-1'); ?>><?php esc_html_e('Right Sidebar', 'themesky') ?></option>
					<option value="1-1-1" <?php selected($layout, '1-1-1'); ?>><?php esc_html_e('Left & Right Sidebar', 'themesky') ?></option>
				</select>
			</td>
		</tr>
		
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Left Sidebar', 'themesky' ); ?></label></th>
			<td>
				<select name="left_sidebar" id="left_sidebar">
					<option value="" <?php selected($left_sidebar, ''); ?>><?php esc_html_e('Default', 'themesky') ?></option>
					<?php foreach( $sidebar_options as $sidebar_id => $sidebar_name ): ?>
						<option value="<?php echo esc_attr($sidebar_id); ?>" <?php selected($left_sidebar, $sidebar_id); ?>><?php echo esc_html($sidebar_name); ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Right Sidebar', 'themesky' ); ?></label></th>
			<td>
				<select name="right_sidebar" id="right_sidebar">
					<option value="" <?php selected($right_sidebar, ''); ?>><?php esc_html_e('Default', 'themesky') ?></option>
					<?php foreach( $sidebar_options as $sidebar_id => $sidebar_name ): ?>
						<option value="<?php echo esc_attr($sidebar_id); ?>" <?php selected($right_sidebar, $sidebar_id); ?>><?php echo esc_html($sidebar_name); ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<?php
	}
	
	function save_category_fields( $term_id, $tt_id, $taxonomy ){
		if( isset($_POST['product_cat_icon_id']) ){
			update_term_meta( $term_id, 'icon_id', esc_attr( $_POST['product_cat_icon_id'] ) );
		}
		
		if( isset($_POST['product_cat_bg_breadcrumbs_id']) ){
			update_term_meta( $term_id, 'bg_breadcrumbs_id', esc_attr( $_POST['product_cat_bg_breadcrumbs_id'] ) );
		}
	
		if( isset($_POST['layout']) ){
			update_term_meta( $term_id, 'layout', esc_attr( $_POST['layout'] ) );
		}
		
		if( isset($_POST['left_sidebar']) ){
			update_term_meta( $term_id, 'left_sidebar', esc_attr( $_POST['left_sidebar'] ) );
		}
		
		if( isset($_POST['right_sidebar']) ){
			update_term_meta( $term_id, 'right_sidebar', esc_attr( $_POST['right_sidebar'] ) );
		}
	}
}
new TS_Custom_Product_Category();

class TS_Custom_Product_Brand{

	function __construct(){
		if( is_admin() ){
			add_action( 'ts_product_brand_add_form_fields', array($this, 'add_brand_fields'), 20 );
			add_action( 'ts_product_brand_edit_form_fields', array($this,'edit_brand_fields'), 20, 2 );
			add_action( 'created_term', array($this, 'save_brand_fields'), 10, 3 );
			add_action( 'edit_term', array($this, 'save_brand_fields'), 10, 3 );
		}
	}

	function add_brand_fields(){
		?>
		<div class="form-field">
			<label for="facebook_url"><?php esc_html_e( 'Facebook URL', 'themesky' ); ?></label>
			<input name="facebook_url" id="facebook_url" type="text" size="40">
		</div>
		<div class="form-field">
			<label for="twitter_url"><?php esc_html_e( 'Twitter URL', 'themesky' ); ?></label>
			<input name="twitter_url" id="twitter_url" type="text" size="40">
		</div>
		<div class="form-field">
			<label for="instagram_url"><?php esc_html_e( 'Instagram URL', 'themesky' ); ?></label>
			<input name="instagram_url" id="instagram_url" type="text" size="40">
		</div>
		<div class="form-field">
			<label for="youtube_url"><?php esc_html_e( 'Youtube URL', 'themesky' ); ?></label>
			<input name="youtube_url" id="youtube_url" type="text" size="40">
		</div>
		<div class="form-field">
			<label for="pinterest_url"><?php esc_html_e( 'Pinterest URL', 'themesky' ); ?></label>
			<input name="pinterest_url" id="pinterest_url" type="text" size="40">
		</div>
		<div class="form-field">
			<label for="linkedin_url"><?php esc_html_e( 'LinkedIn URL', 'themesky' ); ?></label>
			<input name="linkedin_url" id="linkedin_url" type="text" size="40">
		</div>
		<div class="form-field">
			<label for="custom_url"><?php esc_html_e( 'Custom Social URL', 'themesky' ); ?></label>
			<input name="custom_url" id="custom_url" type="text" size="40">
		</div>
		<div class="form-field">
			<label for="custom_url_class"><?php esc_html_e( 'Custom Social URL Class', 'themesky' ); ?></label>
			<input name="custom_url_class" id="custom_url_class" type="text" size="40">
		</div>
		<?php
	}

	function edit_brand_fields( $term, $taxonomy ){
		$facebook_url 		= get_term_meta( $term->term_id, 'facebook_url', true );
		$twitter_url 		= get_term_meta( $term->term_id, 'twitter_url', true );
		$instagram_url 		= get_term_meta( $term->term_id, 'instagram_url', true );
		$youtube_url 		= get_term_meta( $term->term_id, 'youtube_url', true );
		$pinterest_url 		= get_term_meta( $term->term_id, 'pinterest_url', true );
		$linkedin_url	 	= get_term_meta( $term->term_id, 'linkedin_url', true );
		$custom_url 		= get_term_meta( $term->term_id, 'custom_url', true );
		$custom_url_class 	= get_term_meta( $term->term_id, 'custom_url_class', true );
		?>

		<tr class="form-field">
			<th scope="row"><label for="facebook_url"><?php esc_html_e( 'Facebook URL', 'themesky'); ?></label></th>
			<td>
				<input name="facebook_url" id="facebook_url" type="text" value="<?php echo esc_attr( $facebook_url ); ?>" size="40">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="twitter_url"><?php esc_html_e( 'Twitter URL', 'themesky'); ?></label></th>
			<td>
				<input name="twitter_url" id="twitter_url" type="text" value="<?php echo esc_attr( $twitter_url ); ?>" size="40">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="instagram_url"><?php esc_html_e( 'Instagram URL', 'themesky'); ?></label></th>
			<td>
				<input name="instagram_url" id="instagram_url" type="text" value="<?php echo esc_attr( $instagram_url ); ?>" size="40">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="youtube_url"><?php esc_html_e( 'Youtube URL', 'themesky'); ?></label></th>
			<td>
				<input name="youtube_url" id="youtube_url" type="text" value="<?php echo esc_attr( $youtube_url ); ?>" size="40">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="pinterest_url"><?php esc_html_e( 'Pinterest URL', 'themesky'); ?></label></th>
			<td>
				<input name="pinterest_url" id="pinterest_url" type="text" value="<?php echo esc_attr( $pinterest_url ); ?>" size="40">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="linkedin_url"><?php esc_html_e( 'Linkedin URL', 'themesky'); ?></label></th>
			<td>
				<input name="linkedin_url" id="linkedin_url" type="text" value="<?php echo esc_attr( $linkedin_url ); ?>" size="40">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="custom_url"><?php esc_html_e( 'Custom Social URL', 'themesky'); ?></label></th>
			<td>
				<input name="custom_url" id="custom_url" type="text" value="<?php echo esc_attr( $custom_url ); ?>" size="40">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="custom_url_class"><?php esc_html_e( 'Custom Social URL Class', 'themesky'); ?></label></th>
			<td>
				<input name="custom_url_class" id="custom_url_class" type="text" value="<?php echo esc_attr( $custom_url_class ); ?>" size="40">
			</td>
		</tr>
		<?php
	}

	function save_brand_fields( $term_id, $tt_id, $taxonomy ){
		if( isset($_POST['facebook_url']) ){
			update_term_meta( $term_id, 'facebook_url', esc_attr( $_POST['facebook_url'] ) );
		}

		if( isset($_POST['twitter_url']) ){
			update_term_meta( $term_id, 'twitter_url', esc_attr( $_POST['twitter_url'] ) );
		}

		if( isset($_POST['instagram_url']) ){
			update_term_meta( $term_id, 'instagram_url', esc_attr( $_POST['instagram_url'] ) );
		}

		if( isset($_POST['youtube_url']) ){
			update_term_meta( $term_id, 'youtube_url', esc_attr( $_POST['youtube_url'] ) );
		}

		if( isset($_POST['pinterest_url']) ){
			update_term_meta( $term_id, 'pinterest_url', esc_attr( $_POST['pinterest_url'] ) );
		}

		if( isset($_POST['linkedin_url']) ){
			update_term_meta( $term_id, 'linkedin_url', esc_attr( $_POST['linkedin_url'] ) );
		}

		if( isset($_POST['custom_url']) ){
			update_term_meta( $term_id, 'custom_url', esc_attr( $_POST['custom_url'] ) );
		}

		if( isset($_POST['custom_url_class']) ){
			update_term_meta( $term_id, 'custom_url_class', esc_attr( $_POST['custom_url_class'] ) );
		}
	}
}
new TS_Custom_Product_Brand();
?>