<?php

add_theme_support( 'post-thumbnails' );
add_image_size( 'slideshow-img', 470, 320, true ); 

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

function slideshow_func() {
	get_template_part('snippets/slideshow');
}

add_shortcode('slideshow', 'slideshow_func');

function date_func() {
	echo '&copy;'.date('Y');
}

add_shortcode('date', 'date_func');
