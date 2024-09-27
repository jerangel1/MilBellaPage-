<?php 
$theme_options = agrofood_get_theme_options();
$facebook_url = $theme_options['ts_facebook_url'];
$twitter_url = $theme_options['ts_twitter_url'];
$youtube_url = $theme_options['ts_youtube_url'];
$instagram_url = $theme_options['ts_instagram_url'];
$pinterest_url = $theme_options['ts_pinterest_url'];
$linkedin_url = $theme_options['ts_linkedin_url'];
$custom_url = $theme_options['ts_custom_social_url'];
$custom_text = $theme_options['ts_custom_social_class'];
?>
<div class="social-icons">
	<ul>
		<?php if( $facebook_url != '' ): ?>
		<li class="facebook">
			<a href="<?php echo esc_url($facebook_url); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
		</li>
		<?php endif; ?>

		<?php if( $twitter_url != '' ): ?>
		<li class="twitter">
			<a href="<?php echo esc_url($twitter_url); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
		</li>
		<?php endif; ?>
		
		<?php if( $instagram_url != '' ): ?>
		<li class="instagram">
			<a href="<?php echo esc_url($instagram_url); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
		</li>
		<?php endif; ?>
		
		<?php if( $youtube_url != '' ): ?>
		<li class="youtube">
			<a href="<?php echo esc_url($youtube_url); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
		</li>
		<?php endif; ?>
		
		<?php if( $pinterest_url != '' ): ?>
		<li class="pinterest">
			<a href="<?php echo esc_url($pinterest_url); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
		</li>
		<?php endif; ?>
		
		<?php if( $linkedin_url != '' ): ?>
		<li class="linkedin">
			<a href="<?php echo esc_url($linkedin_url); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
		</li>
		<?php endif; ?>
		
		<?php if( $custom_url != '' ): ?>
		<li class="custom">
			<a href="<?php echo esc_url($custom_url); ?>" target="_blank"><i class="<?php echo esc_attr( $custom_text ); ?>"></i></a>
		</li>
		<?php endif; ?>
	</ul>
</div>