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
<?php 	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php if(is_front_page()) { ?>
			
	<?php the_content(); ?>		
			
			<?php } else { ?>

<h2 class="accentColour"><?php the_title(); ?></h2>

<?php the_content(); ?>



<?php 	}
		endwhile;
		endif; ?>
</div>