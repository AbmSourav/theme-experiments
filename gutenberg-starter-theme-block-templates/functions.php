<?php

if ( ! function_exists( 'gutenberg_starter_theme_support' ) ) :
    function gutenberg_starter_theme_support()  {

		// Make theme available for translation.
		load_theme_textdomain( 'gutenberg-starter-theme', get_template_directory() . '/languages' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Alignwide and alignfull classes in the block editor
		add_theme_support( 'align-wide' );

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Adding support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Support a custom color palette.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Strong Blue', 'gutenberg-starter-theme' ),
				'slug'  => 'strong-blue',
				'color' => '#0073aa',
			),
			array(
				'name'  => __( 'Lighter Blue', 'gutenberg-starter-theme' ),
				'slug'  => 'lighter-blue',
				'color' => '#229fd8',
			),
			array(
				'name'  => __( 'Very Light Gray', 'gutenberg-starter-theme' ),
				'slug'  => 'very-light-gray',
				'color' => '#eee',
			),
			array(
				'name'  => __( 'Very Dark Gray', 'gutenberg-starter-theme' ),
				'slug'  => 'very-dark-gray',
				'color' => '#444',
			),
		) );

		// Starter content
		add_theme_support('starter-content', [
			// Static front page set to Home, posts page set to Blog
			'options' => [
				'show_on_front' => 'page',
				'page_on_front' => '{{home}}',
				'page_for_posts' => '{{blog}}',
			],
			// Starter pages to include
			'posts' => [
				'home' => [
					'post_content' => '<!-- wp:template-part {"slug":"example-post","theme":"gutenberg-starter-theme"} -->'
				],
				'blog'
			]
		]);
    }
    add_action( 'after_setup_theme', 'gutenberg_starter_theme_support' );
endif;

/**
 * Register Google Fonts
 */
function gutenberg_starter_theme_fonts_url() {
	$fonts_url = '';

	/*
	 *Translators: If there are characters in your language that are not
	 * supported by Noto Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$notoserif = esc_html_x( 'on', 'Noto Serif font: on or off', 'gutenberg-starter-theme' );

	if ( 'off' !== $notoserif ) {
		$font_families = array();
		$font_families[] = 'Noto Serif:400,400italic,700,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function gutenberg_starter_theme_scripts() {
	wp_enqueue_style( 'gutenberg-starter-theme-styles', get_stylesheet_uri() );
	wp_enqueue_style( 'gutenberg-starter-theme-block-styles', get_template_directory_uri() . '/css/blocks.css' );
	wp_enqueue_style( 'gutenberg-starter-theme-fonts', gutenberg_starter_theme_fonts_url() );
}
add_action( 'wp_enqueue_scripts', 'gutenberg_starter_theme_scripts' );