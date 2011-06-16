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
global $words;
?>

<div class="jbasewrap content miniPage">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<?php if(is_front_page()) { ?>
	<div class="right grid6col aligncenter miniContent">
		<div class="imagebox">
			<?php $count = home_rotate('slideshow-img'); ?>
		</div>
	</div>
	<?php } else { ?>
	<div class="right grid7col alignright miniContent">
		<?php if($words) { ?>
			<div id="words"><?php the_content(); ?></div>
		<?php } else { ?>
			<!--<h2 class="accentColour"><?php the_title(); ?></h2>-->
			<?php the_content(); ?>
		<?php } ?>
	</div>
	<?php } ?>
	
<?php
	endwhile;
	endif; ?>
</div>

<?php get_footer(); ?>
