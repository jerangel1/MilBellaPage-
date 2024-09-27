<?php
$agrofood_theme_options = agrofood_get_theme_options();

$header_classes = array();
if( $agrofood_theme_options['ts_enable_sticky_header'] ){
	$header_classes[] = 'has-sticky';
}

if( !$agrofood_theme_options['ts_enable_tiny_shopping_cart'] ){
	$header_classes[] = 'hidden-cart';
}

if( !$agrofood_theme_options['ts_enable_tiny_wishlist'] || !class_exists('WooCommerce') || !class_exists('YITH_WCWL') ){
	$header_classes[] = 'hidden-wishlist';
}

if( !$agrofood_theme_options['ts_header_currency'] ){
	$header_classes[] = 'hidden-currency';
}

if( !$agrofood_theme_options['ts_header_language'] ){
	$header_classes[] = 'hidden-language';
}

if( !$agrofood_theme_options['ts_enable_search'] ){
	$header_classes[] = 'hidden-search';
}
?>

<header class="ts-header <?php echo esc_attr(implode(' ', $header_classes)); ?>">
	<div class="header-container">
		<div class="header-template">

			<div class="header-sticky">
				<div class="header-middle">
					<div class="container">
					
						<div class="header-left">
						
							<?php if( !$agrofood_theme_options['ts_enable_mobile_app_style'] ): ?>
							<!-- Menu Icon -->
							<div class="ts-mobile-icon-toggle visible-phone">
								<span class="icon"></span>
							</div>
							<?php endif; ?>
						
							<div class="menu-wrapper hidden-phone">
							
								<?php if( $agrofood_theme_options['ts_enable_search'] ): ?>
									<div class="ts-search-by-category hidden"><?php get_search_form(); ?></div>
								<?php endif; ?>
								
								<?php if ( has_nav_menu( 'vertical' ) ): ?>
									<div class="vertical-menu-wrapper">			
										<div class="vertical-menu-heading"><?php echo agrofood_get_vertical_menu_heading(); ?></div>
										<?php 
											wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'vertical','walker' => new Agrofood_Walker_Nav_Menu() ) );
										?>
									</div>
								<?php endif; ?>
							
								<div class="ts-menu">
									<?php 
										if ( has_nav_menu( 'primary' ) ) {
											wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'primary','walker' => new Agrofood_Walker_Nav_Menu() ) );
										}
										else{
											wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper' ) );
										}
									?>
								</div>
							
							</div>
							
							<?php if( $agrofood_theme_options['ts_enable_search'] ): ?>
								<div class="search-button search-icon hidden-phone">
									<span class="icon"></span>
								</div>
							<?php endif; ?>
							
						</div>
						
						<div class="logo-wrapper"><?php agrofood_theme_logo(); ?></div>
						
						<div class="header-right">
						
							<?php if( $agrofood_theme_options['ts_enable_search'] ): ?>
								<div class="search-button search-icon visible-phone">
									<span class="icon"></span>
								</div>
							<?php endif; ?>
						
							<?php if( $agrofood_theme_options['ts_enable_tiny_account'] ): ?>
							<div class="my-account-wrapper hidden-phone">							
								<?php echo agrofood_tiny_account(); ?>
							</div>
							<?php endif; ?>
							
							<?php if( class_exists('YITH_WCWL') && $agrofood_theme_options['ts_enable_tiny_wishlist'] ): ?>
								<div class="my-wishlist-wrapper hidden-phone"><?php echo agrofood_tini_wishlist(); ?></div>
							<?php endif; ?>
							
							<?php if( $agrofood_theme_options['ts_enable_tiny_shopping_cart'] ): ?>
							<div class="shopping-cart-wrapper hidden-phone">
								<?php echo agrofood_tiny_cart(); ?>
							</div>
							<?php endif; ?>
			
						</div>

					</div>					
				</div>
			</div>			
		</div>	
	</div>
</header>