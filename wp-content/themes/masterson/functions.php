<?php

add_theme_support( 'post-thumbnails' );
add_image_size( 'slideshow-img', 470, 320, false );

function child_theme_init() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action('init', 'child_theme_init');

function custom_editor_style( $url ) {

  if ( !empty($url) )
    $url .= ',';

  // Change the path here if using sub-directory
  $url .= trailingslashit( get_bloginfo( 'stylesheet_directory' ) ) . 'css/editor-style.css';

  return $url;

} 

add_filter( 'mce_css', 'custom_editor_style' );

function add_stylesheets() { ?>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Francois+One' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,bold' rel='stylesheet' type='text/css' />
<?php }

add_action('wp_head', 'add_stylesheets');

function add_scripts() { ?>
	
	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/mootools-core-1.3.2-full-compat-yc.js"></script>
	<!--[if (gte IE 6)&(lte IE 8)]>
	  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/selectivizr-min.js"></script>
	  <noscript><link rel="stylesheet" href="[fallback css]" /></noscript>
	<![endif]--> 
	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.hoverIntent.minified.js"></script>
<?php }

add_action('wp_footer', 'add_scripts');

function home_rotate($size = thumbnail) {

	if($images = get_children(array(
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
	))) {			
	
		$i=0;
		foreach($images as $image) {
			$attimg  = wp_get_attachment_image_src($image->ID,$size);
			$attimgurl = $attimg[0];
			$atturl   = wp_get_attachment_url($image->ID);
			$attlink  = get_attachment_link($image->ID);
			$postlink = get_permalink($image->post_parent);
			$atttitle = apply_filters('the_title',$image->post_title);
			$attcontent = ($image->post_content);
			if($i==0) {
				echo '<img class="primary home" src="'.$attimgurl.'"/>';
			} else {
				echo '<img src="'.$attimgurl.'"/>';
			}
			$i++;
		}
		echo '<span id="imagecount">'.count($images).'</span>';
	}
	return count($images);
	
}

function date_func() {
	echo '&copy;'.date('Y');
}

add_shortcode('date', 'date_func');
