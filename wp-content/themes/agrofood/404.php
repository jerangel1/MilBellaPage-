<?php 
get_header();

$theme_options = agrofood_get_theme_options();
$classes = array();
$classes[] = 'show_breadcrumb_' . $theme_options['ts_breadcrumb_layout'];

agrofood_breadcrumbs_title(true, false, '');
?>
	<div class="page-container <?php echo esc_attr(implode(' ', $classes)); ?>">
		<div id="main-content">	
			<div id="primary" class="site-content">
				<article>
					<!-- 404 -->
					<div class="not-found">
						<h1><?php esc_html_e('404', 'agrofood'); ?></h1>
						<h5><?php esc_html_e('This page has been probably moved somewhere...', 'agrofood'); ?></h5>
						<p><?php esc_html_e('Please back to homepage or check our offer', 'agrofood'); ?></p>
						<a href="<?php echo esc_url( home_url('/') ) ?>" class="button"><?php esc_html_e('Back to homepage', 'agrofood'); ?></a>
					</div>
				</article>
			</div>
		</div>
	</div>
<?php
get_footer();