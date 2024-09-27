<?php $agrofood_theme_options = agrofood_get_theme_options(); ?>
<div class="clear"></div>
</div><!-- #main .wrapper -->
<div class="clear"></div>
	<?php if( !is_page_template('page-templates/blank-page-template.php') && $agrofood_theme_options['ts_footer_block'] ): ?>
	<footer id="colophon" class="footer-container footer-area">
		<div class="container">
			<?php agrofood_get_footer_content( $agrofood_theme_options['ts_footer_block'] ); ?>
		</div>
	</footer>
	<?php endif; ?>
</div><!-- #page -->

<?php if( !is_page_template('page-templates/blank-page-template.php') ): ?>

	<!-- Group Header Button -->
	<div id="group-icon-header" class="ts-floating-sidebar">
		<div class="overlay"></div>
		<div class="ts-sidebar-content">
			<div class="sidebar-content">
				<span class="close"></span>
				
				<ul class="tab-mobile-menu">
					<li id="main-menu" class="active"><span><?php esc_html_e('Menu', 'agrofood'); ?></span></li>
					<?php if( $agrofood_theme_options['ts_header_layout'] == 'v2' ): ?>
					<li id="vertical-menu"><span><?php esc_html_e('Categories', 'agrofood'); ?></span></li>
					<?php elseif( has_nav_menu( 'vertical' ) ): ?>
					<li id="vertical-menu"><span><?php echo agrofood_get_vertical_menu_heading(); ?></span></li>
					<?php endif; ?>
				</ul>
				
				<h6 class="menu-title"><span><?php esc_html_e('Menu', 'agrofood'); ?></span></h6>
				
				<div class="mobile-menu-wrapper ts-menu tab-menu-mobile">
					<div class="menu-main-mobile">
						<?php 
						if( has_nav_menu( 'mobile' ) ){
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'mobile', 'walker' => new Agrofood_Walker_Nav_Menu() ) );
						}else if( has_nav_menu( 'primary' ) ){
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'primary', 'walker' => new Agrofood_Walker_Nav_Menu() ) );
						}
						else{
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu' ) );
						}
						?>
					</div>
				</div>
				
				<?php if( $agrofood_theme_options['ts_header_layout'] == 'v2' && $agrofood_theme_options['ts_header_product_categories'] ): ?>
				<div class="mobile-menu-wrapper ts-menu tab-vertical-menu">
					<?php agrofood_header_vertical_menu(); ?>
				</div>
				<?php elseif ( has_nav_menu( 'vertical' ) ): ?>
					<div class="mobile-menu-wrapper ts-menu tab-vertical-menu">
						<div class="vertical-menu-wrapper">			
							<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'vertical','walker' => new Agrofood_Walker_Nav_Menu() ) ); ?>
						</div>
					</div>
				<?php endif; ?>
				
				<div class="group-button-header">
					
					<?php if( !$agrofood_theme_options['ts_enable_mobile_app_style'] ): ?>
					
						<?php if( $agrofood_theme_options['ts_enable_search']): ?>
						<div class="ts-search-by-category"><?php get_search_form(); ?></div>
						<?php endif; ?>
						
						<?php if( $agrofood_theme_options['ts_enable_tiny_account'] ): ?>
						<div class="my-account-wrapper">
							<?php echo agrofood_tiny_account( array( 'login_title' => esc_html__( 'Login', 'agrofood' ), 'register_title' => esc_html__( 'Create an account', 'agrofood' ), 'style' => 'ts-style-text' ) ); ?>
						</div>	
						<?php endif; ?>
						
						<?php if( class_exists('YITH_WCWL') && $agrofood_theme_options['ts_enable_tiny_wishlist'] ): ?>
							<div class="my-wishlist-wrapper hidden-phone"><?php echo agrofood_tini_wishlist(); ?></div>
						<?php endif; ?>
						
					<?php endif; ?>
					
					<?php if( function_exists('ts_header_social_icons') ): ?>
						<div class="header-social-icon"><?php ts_header_social_icons(); ?></div>
					<?php endif; ?>
					
					<?php if( $agrofood_theme_options['ts_header_contact_info'] && in_array($agrofood_theme_options['ts_header_layout'], array('v1')) ): ?>
						<div class="header-contact-info">
							<?php echo wp_kses($agrofood_theme_options['ts_header_contact_info'], 'agrofood_tgmpa'); ?>
						</div>
					<?php endif; ?>
					
					<?php if( $agrofood_theme_options['ts_header_currency'] || $agrofood_theme_options['ts_header_language'] ): ?>
					<div class="language-currency">
						
						<?php if( $agrofood_theme_options['ts_header_language'] ): ?>
						<div class="header-language"><?php agrofood_wpml_language_selector(); ?></div>
						<?php endif; ?>
						
						<?php if( $agrofood_theme_options['ts_header_currency'] ): ?>
						<div class="header-currency"><?php agrofood_woocommerce_multilingual_currency_switcher(); ?></div>
						<?php endif; ?>
						
					</div>
					<?php endif; ?>
					
				</div>
				
			</div>	
		</div>
	</div>
	
	<?php if( $agrofood_theme_options['ts_enable_mobile_app_style'] ): ?>

		<!-- Mobile Group Button -->
		<div id="ts-mobile-button-bottom">
			<!-- Menu Icon -->
			<div class="ts-mobile-icon-toggle">
				<span class="icon"></span>
			</div>
			
			<!-- Home Icon -->
			<div class="mobile-button-home">
				<a href="<?php echo esc_url( home_url('/') ) ?>">
					<span class="icon"></span>
				</a>
			</div>
			
			<!-- Myaccount Icon -->
			<?php if( $agrofood_theme_options['ts_enable_tiny_account'] ): ?>
			<div class="my-account-wrapper">
				<?php echo agrofood_tiny_account( array('show_dropdown' => false) ); ?>
			</div>
			<?php endif; ?>
			
			<!-- Wishlist Icon -->
			<?php if( class_exists('YITH_WCWL') && $agrofood_theme_options['ts_enable_tiny_wishlist'] ): ?>
				<div class="my-wishlist-wrapper"><?php echo agrofood_tini_wishlist(); ?></div>
			<?php endif; ?>
			
			<!-- Cart Icon -->
			<?php if( $agrofood_theme_options['ts_enable_tiny_shopping_cart'] ): ?>
			<div class="shopping-cart-wrapper mobile-cart">
				<?php echo agrofood_tiny_cart(true, false); ?>
			</div>
			<?php endif; ?>
		</div>
		
	<?php endif; ?>
		
<?php endif; ?>

<!-- Search Sidebar -->
<?php if( $agrofood_theme_options['ts_enable_search'] ): ?>
	
	<div id="ts-search-sidebar" class="ts-floating-sidebar">
		<div class="overlay"></div>
		<div class="ts-sidebar-content">
			<span class="close"></span>
			
			<div class="ts-search-by-category woocommerce">
				<h2 class="title"><?php esc_html_e('Search for products', 'agrofood'); ?></h2>
				<?php get_search_form(); ?>
				<div class="ts-search-result-container"></div>
			</div>
		</div>
	</div>

<?php endif; ?>

<!-- Shopping Cart Floating Sidebar -->
<?php if( class_exists('WooCommerce') && $agrofood_theme_options['ts_enable_tiny_shopping_cart'] && $agrofood_theme_options['ts_shopping_cart_sidebar'] && !is_cart() && !is_checkout() ): ?>
<div id="ts-shopping-cart-sidebar" class="ts-floating-sidebar">
	<div class="overlay"></div>
	<div class="ts-sidebar-content">
		<span class="close"></span>
		<div class="ts-tiny-cart-wrapper"></div>
	</div>
</div>
<?php endif; ?>

<?php 
if( ( !wp_is_mobile() && $agrofood_theme_options['ts_back_to_top_button'] ) || ( wp_is_mobile() && $agrofood_theme_options['ts_back_to_top_button_on_mobile'] ) ): 
?>
<div id="to-top" class="scroll-button">
	<a class="scroll-button" href="javascript:void(0)" title="<?php esc_attr_e('Back to Top', 'agrofood'); ?>"><?php esc_html_e('Back to Top', 'agrofood'); ?></a>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>