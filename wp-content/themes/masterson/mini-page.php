<?php 

// Template Name: mini-page

?>

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

<div class="jbasewrap content miniPage">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<div class="right grid6col alignright miniContent">
		<h2 class="accentColour"><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>
	
<?php
	endwhile;
	endif; ?>
</div>

<?php get_footer(); ?>
