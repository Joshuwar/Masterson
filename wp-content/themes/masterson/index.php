<?php get_header(); ?>

<?php
wp_nav_menu( array(
	'container' => 'div',
	'container_id' => 'navContainer',
	'container_class' => 'jbasewrap',
	'theme_location' => 'main_menu', 
	'menu_id' => 'nav'
) );
?>
<div class="jbasewrap content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php if(is_front_page()) { ?>
			
		<!--<?php the_content(); ?>-->
		<script type="text/javascript">
			window.imageDirectoryURL = "<?php echo bloginfo('stylesheet_directory'); ?>";
		</script>
		<div class="left slideshowContainer marginbottom">
			<div class="slideshow">
				<div class="svwp" id="slideshow">
					<ul>
						<?php $images = get_children(array(
							'post_parent'    => get_the_ID(),
							'post_type'      => 'attachment',
							'numberposts'    => -1, // show all
							'post_status'    => null,
							'post_mime_type' => 'image',
							'order'          => 'ASC',
							'orderby'        => 'menu_order',
						));
						foreach($images as $image) :	
							$attimg = wp_get_attachment_image_src($image->ID, 'slideshow-img');
							$src = $attimg[0];
							$alt = get_post_meta($image->ID, '_wp_attachment_image_alt', true);							
						?>
						<li><img alt="<?php echo $alt; ?>" src="<?php echo $src; ?>" /></li>
						<?php 
						endforeach;
						?>
					</ul>
				</div>
			</div>
		</div>
	
	<?php } else { ?>

<h2 class="accentColour"><?php the_title(); ?></h2>
<?php the_content(); ?>
<?php 	}
	endwhile;
	endif; ?>
</div>
<div id="scrollAlert"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pixel-arrow.png" /></div>
<?php get_footer(); ?>
