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
<h2 class="accentColour"><?php the_title(); ?></h2>
<?php the_content();
	endwhile;
	endif; ?>
</div>
<div id="scrollAlert"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pixel-arrow.png" /></div>
<?php get_footer(); ?>
