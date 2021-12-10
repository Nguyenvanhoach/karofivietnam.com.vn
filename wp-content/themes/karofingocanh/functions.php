<?php
/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwenty' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', twentytwenty_get_starter_content() );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new TwentyTwenty_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'twentytwenty_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-twentytwenty-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Register and Enqueue Styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'twentytwenty-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );

/**
 * Register and Enqueue Scripts.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty 1.0
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_non_latin_languages() {
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twentytwenty-style', $custom_css );
	}
}

add_action( 'wp_enqueue_scripts', 'twentytwenty_non_latin_languages' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
		'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
		'footer'   => __( 'Footer Menu', 'twentytwenty' ),
		'social'   => __( 'Social Menu', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'twentytwenty_menus' );

/**
 * Get the information about the logo.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 * @return string
 */
function twentytwenty_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'twentytwenty_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 *
	 * @since Twenty Twenty 1.0
	 */
	function wp_body_open() {
		/** This action is documented in wp-includes/general-template.php */
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'twentytwenty' ) . '</a>';
}

add_action( 'wp_body_open', 'twentytwenty_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @since Twenty Twenty 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'twentytwenty' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'twentytwenty' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
			)
		)
	);

}

add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );

/**
 * Enqueue supplemental block editor styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_block_editor_styles() {

	// Enqueue the editor styles.
	wp_enqueue_style( 'twentytwenty-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'twentytwenty-block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', twentytwenty_get_customizer_css( 'block-editor' ) );

	// Add inline style for non-latin fonts.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );

	// Enqueue the editor script.
	wp_enqueue_script( 'twentytwenty-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_classic_editor_styles() {

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'twentytwenty_classic_editor_styles' );

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @since Twenty Twenty 1.0
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_customizer_styles( $mce_init ) {

	$styles = twentytwenty_get_customizer_css( 'classic-editor' );

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles' );

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_non_latin_styles( $mce_init ) {

	$styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );

	// Return if there are no styles to add.
	if ( ! $styles ) {
		return $mce_init;
	}

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles' );

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_block_editor_settings() {

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => _x( 'Primary', 'color', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => _x( 'Secondary', 'color', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod( 'background_color' );
	if ( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		$background_color     = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'twentytwenty' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);

	add_theme_support( 'editor-styles' );

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ( '#ffffff' === strtolower( twentytwenty_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}

}

add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 * @return string
 */
function twentytwenty_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'twentytwenty_read_more_tag' );

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Add main customizer js file.
	wp_enqueue_script( 'twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery' ), $theme_version, false );

	// Add script for color calculations.
	wp_enqueue_script( 'twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array( 'wp-color-picker' ), $theme_version, false );

	// Add script for controls.
	wp_enqueue_script( 'twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
}

add_action( 'customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts' );

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'twentytwenty-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array() );

	wp_add_inline_script(
		'twentytwenty-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( twentytwenty_customize_opacity_range() )
		)
	);
}

add_action( 'customize_preview_init', 'twentytwenty_customize_preview_init' );

/**
 * Get accessible color for an area.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $area    The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

/**
 * Get an array of elements.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_elements_array() {

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(
		'content'       => array(
			'accent'     => array(
				'color'            => array( '.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a' ),
				'border-color'     => array( 'blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus' ),
				'background-color' => array( 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link' ),
				'fill'             => array( '.fill-children-accent', '.fill-children-accent *' ),
			),
			'background' => array(
				'color'            => array( ':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)' ),
				'background-color' => array( ':root .has-background-background-color' ),
			),
			'text'       => array(
				'color'            => array( 'body', '.entry-title a', ':root .has-primary-color' ),
				'background-color' => array( ':root .has-primary-background-color' ),
			),
			'secondary'  => array(
				'color'            => array( 'cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color' ),
				'background-color' => array( ':root .has-secondary-background-color' ),
			),
			'borders'    => array(
				'border-color'        => array( 'pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr' ),
				'background-color'    => array( 'caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color' ),
				'border-bottom-color' => array( '.wp-block-table.is-style-stripes' ),
				'border-top-color'    => array( '.wp-block-latest-posts.is-grid li' ),
				'color'               => array( ':root .has-subtle-background-color' ),
			),
		),
		'header-footer' => array(
			'accent'     => array(
				'color'            => array( 'body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover' ),
				'background-color' => array( '.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]' ),
			),
			'background' => array(
				'color'            => array( '.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]' ),
				'background-color' => array( '#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before' ),
			),
			'text'       => array(
				'color'               => array( '.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle' ),
				'background-color'    => array( 'body:not(.overlay-header) .primary-menu ul' ),
				'border-bottom-color' => array( 'body:not(.overlay-header) .primary-menu > li > ul:after' ),
				'border-left-color'   => array( 'body:not(.overlay-header) .primary-menu ul ul:after' ),
			),
			'secondary'  => array(
				'color' => array( '.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a' ),
			),
			'borders'    => array(
				'border-color'     => array( '.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top' ),
				'background-color' => array( '.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before' ),
			),
		),
	);

	/**
	 * Filters Twenty Twenty theme elements.
	 *
	 * @since Twenty Twenty 1.0
	 *
	 * @param array Array of elements.
	 */
	return apply_filters( 'twentytwenty_get_elements_array', $elements );
}


add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
	unset($fields['billing']['billing_state']);
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['billing']['billing_state']);
	unset($fields['billing']['billing_address_2']);
	unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_city']);
	
	return $fields;
}

//tạo field tring product
function woo_add_custom_general_fields() {
  
  global $woocommerce, $post;
   
  echo '<div class="options_group">';   
  	woocommerce_wp_text_input( 
			array( 
					'id'          => 'baohanh', 
					'label'       => __( 'Bảo Hành:', 'woocommerce' ), 
					'placeholder' => 'Nhập thời gian bảo hành',
					'desc_tip'    => '',
					'description' => __( 'Nhập thời gian bảo hành', 'woocommerce' ) 
			)
		);   
  echo '</div>';
	echo '<div class="options_group">';   
		woocommerce_wp_select( 
			array( 
					'id'      => 'kieudang', 
					'label'   => __( 'Kiểu dáng:', 'woocommerce' ), 
					'options' => array(
							'Không tủ'   => __( 'Không tủ', 'woocommerce' ),
							'Có tủ'   => __( 'Có tủ', 'woocommerce' ),
							'4 cấp lọc' => __( '4 cấp lọc', 'woocommerce' ),
							'5 cấp lọc' => __( '5 cấp lọc', 'woocommerce' ),
							'6 cấp lọc' => __( '6 cấp lọc', 'woocommerce' ),
							'8 cấp lọc' => __( '8 cấp lọc', 'woocommerce' ),
							'Tủ IQ cao cấp' => __( 'Tủ IQ cao cấp', 'woocommerce' ),
							'Tủ đứng'   => __( 'Tủ đứng', 'woocommerce' ),
							'Để bàn - Để gầm'   => __( 'Để bàn - Để gầm', 'woocommerce' ),
							'Hút bình'   => __( 'Hút bình', 'woocommerce' ),
							'Úp bình'   => __( 'Úp bình', 'woocommerce' ),
							'Tích hợp hệ thống lọc RO'   => __( 'Tích hợp hệ thống lọc RO', 'woocommerce' ),
							'Máy lọc nước tích hợp nóng lạnh'   => __( 'Máy lọc nước tích hợp nóng lạnh', 'woocommerce' ),
							'Công suất 1500l/h'   => __( 'Công suất 1500l/h', 'woocommerce' ),
							'2 vòi nóng lạnh'   => __( '2 vòi nóng lạnh', 'woocommerce' ),
							
							)
					)
			);
	echo '</div>';
     
}
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );
function woo_add_custom_general_fields_save( $post_id ){
    // Text Field
    $woocommerce_text_field = $_POST['baohanh'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, 'baohanh', esc_attr( $woocommerce_text_field ) );
		// Select
    $woocommerce_select = $_POST['kieudang'];
    if( !empty( $woocommerce_select ) )
        update_post_meta( $post_id, 'kieudang', esc_attr( $woocommerce_select ) );
}

//Set cookies
function giniit_track_product_view() {
	if ( ! is_singular( 'product' ) ) {
		return;
	}
	global $post;

	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) )
		$viewed_products = array();
	else
		$viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );

	if ( ! in_array( $post->ID, $viewed_products ) ) {
		$viewed_products[] = $post->ID;
	}

	if ( sizeof( $viewed_products ) > 15 ) {
		array_shift( $viewed_products );
	}

	wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}

add_action( 'template_redirect', 'giniit_track_product_view', 20 );
add_action( 'wp_enqueue_scripts', function() {
	$styles = wp_styles();
	$styles->add_data( 'twentytwenty-style', 'after', array() );
}, 20 );
function get_ecommerce_excerpt(){
	$excerpt = get_the_excerpt();
	$excerpt = preg_replace(" ([.*?])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 80);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
	return $excerpt;
	}
/**Remove script woocommerce*/
add_action( 'wp_enqueue_scripts', 'grd_woocommerce_script_cleaner', 99 );
function grd_woocommerce_script_cleaner() {
	if(!is_admin()){
		remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
		wp_dequeue_style( 'woocommerce_frontend_styles' );
		wp_dequeue_style( 'woocommerce-general');
		wp_dequeue_style( 'woocommerce-layout' );
		wp_dequeue_style( 'woocommerce-smallscreen' );
		wp_dequeue_style( 'woocommerce_fancybox_styles' );
		wp_dequeue_style( 'woocommerce_chosen_styles' );
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		wp_dequeue_style( 'select2' );
		wp_dequeue_script( 'wc-add-payment-method' );
		wp_dequeue_script( 'wc-lost-password' );
		wp_dequeue_script( 'wc_price_slider' );
		// wp_dequeue_script( 'wc-single-product' );
		wp_dequeue_script( 'wc-add-to-cart' );
		// wp_dequeue_script( 'wc-cart-fragments' );
		wp_dequeue_script( 'wc-credit-card-form' );
		wp_dequeue_script( 'wc-checkout' );
		wp_dequeue_script( 'wc-add-to-cart-variation' );
		// wp_dequeue_script( 'wc-single-product' );
		// wp_dequeue_script( 'wc-cart' );
		wp_dequeue_script( 'wc-chosen' );
		// wp_dequeue_script( 'woocommerce' );
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
		wp_dequeue_script( 'jquery-blockui' );
		wp_dequeue_script( 'jquery-placeholder' );
		wp_dequeue_script( 'jquery-payment' );
		wp_dequeue_script( 'fancybox' );
		wp_dequeue_script( 'jqueryui' );
	}
}
add_theme_support('woocommerce');

// add_action( 'woocommerce_before_shop_loop_item_title', create_function('', 'echo "<div class=\"archive-img-wrap d-flex align-items-center justify-content-center\">";'), 5, 2);
// add_action( 'woocommerce_before_shop_loop_item_title',create_function('', 'echo "</div><hr>";'), 12, 2);

add_filter( 'woocommerce_sale_flash', 'add_percentage_to_sale_badge', 20, 3 );
function add_percentage_to_sale_badge( $html, $post, $product ) {
	if( $product->is_type('variable')){
			$percentages = array();

			// Get all variation prices
			$prices = $product->get_variation_prices();

			// Loop through variation prices
			foreach( $prices['price'] as $key => $price ){
					// Only on sale variations
					if( $prices['regular_price'][$key] !== $price ){
							// Calculate and set in the array the percentage for each variation on sale
							$percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
					}
			}
			$percentage = max($percentages) . '%';
	} else {
		$regular_price = (float) $product->get_regular_price();
		$sale_price    = (float) $product->get_sale_price();
		if($regular_price > 0) {
			$percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
		}
	}
	if ( $product->price > 0 ) {
		return '<span class="onsale">' . esc_html__( '-', 'woocommerce' ) . ' ' . $percentage . '</span>';
	}
}

function add_fields_user($profile_fields){
	$profile_fields['phone'] = 'Số điện thoại';
	$profile_fields['user_address'] = 'Địa chỉ';
	// $profile_fields['facebook'] = 'Facebook profile URL';
	return $profile_fields;
}
add_filter('user_contactmethods', 'add_fields_user');
function login_redirect($redirect_to, $request, $user ) {
    if (isset($user->roles) && is_array($user->roles)) {
    	if (in_array('administrator', $user->roles)) {
            $redirect_to =  home_url().'/wp-admin';
        } else {
        	$redirect_to =  home_url().'/tai-khoan/';
    	}
    }
    return $redirect_to;
}
add_filter( 'login_redirect', 'login_redirect', 10, 3 );

add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
  .area-config-mymenu{clear:both;padding-left:15px;padding-right:15px;box-sizing:border-box;margin-top:30px}.block-config-mymenu::after,.block-config-mymenu::before{content:"";display:table;width:100%;clear:both}.block-config-mymenu{margin:0 -15px}.h-w{width:50%;float:left;box-sizing:border-box}.area-config-mymenu h2{text-transform:capitalize;font-weight:700;margin-bottom:0}.px-15{padding-left:15px;padding-right:15px}@media(min-width:1200px){.h-w{width:25%}}@media(max-width:1024px){.h-w{width:33.33333333%}}@media(max-width:767px){.block-config-mymenu{width:100%}.h-w{width:100%}}
  </style>';
}
add_action( 'admin_init', 'register_settings' );
function register_settings(){
	//đăng ký các fields dữ liệu cần lưu
	//register_setting( string $option_group, string $option_name, array $args = array() ) 
	register_setting( 'my-settings-group', 'address_company' ); // dòng 1 là group name, dòng 2 là option name , dòng 3 là phần mở rộng, mình chưa có nhé.
	register_setting( 'my-settings-group', 'phone_company' );
	register_setting( 'my-settings-group', 'mail_company' );
	register_setting( 'my-settings-group', 'copy_right' );
	register_setting( 'my-settings-group', 'hotline' );
	register_setting( 'my-settings-group', 'hotline_2' );   
	register_setting( 'my-settings-group', 'fax_company' );
	register_setting( 'my-settings-group', 'facebook_company' );
	register_setting( 'my-settings-group', 'twitter_company' );
	register_setting( 'my-settings-group', 'youtube_company' );
	register_setting( 'my-settings-group', 'pinterest_company' );
	register_setting( 'my-settings-group', 'zalo' );    
	register_setting( 'my-settings-group', 'google_map' );
	register_setting( 'my-settings-group', 'designer' );    
}
function wpdocs_register_my_custom_menu_page(){
	 // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page('Config Page Custom Title','Cấu Hình Trang Tùy Chỉnh', 'manage_options', 'custompage','my_custom_menu_page','dashicons-admin-generic',90); 
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );
if(!function_exists('my_custom_menu_page')){
function my_custom_menu_page() { ?>
	<div class="area-config-mymenu">
		<h2>Cấu Hình Chính</h2>
		<form id="landingOptions" method="post" action="options.php">
		<?php settings_fields( 'my-settings-group' ); ?>
			<div class="block-config-mymenu">
				<div class="px-15 h-w">
					 <p><label for="address_company">Địa chỉ công ty:</label><br/>
					 <input style="width:100%; height: 38px;" type="text" name="address_company" value="<?php echo get_option('address_company')?>" placeholder="Ví dụ: 51 đường 18 phường Phước Bình quận 9" /></p>			 	
				</div>
				<div class="px-15 h-w">
					 <p><label for="phone_company">Số điện thoại</label><br/>
					 <input style="width:100%; height: 38px;" type="text" name="phone_company" value="<?php echo get_option('phone_company')?>" /></p>
				</div>
				<div class="px-15 h-w">
					 <p><label for="fax_company">Số Fax</label><br/>
					 <input style="width:100%; height: 38px;" type="text" name="fax_company" value="<?php echo get_option('fax_company')?>" /></p>
				</div>
				<div class="px-15 h-w">
				 <p><label for="mail_company">Mail công ty</label><br/>
				 <input style="width:100%; height: 38px;" type="text" name="mail_company" value="<?php echo get_option('mail_company')?>" /></p>
				</div>
				<div class="px-15 h-w">
					<p><label for="copy_right">Copy Right</label><br/>
					<input style="width:100%; height: 38px;" type="text" name="copy_right" value="<?php echo get_option('copy_right')?>" /></p>
				</div>
				<div class="px-15 h-w">
				 <p><label for="hotline">Hotline</label><br/>
				 <input style="width:100%; height: 38px;" type="text" name="hotline" value="<?php echo get_option('hotline')?>" /></p>
				</div>
				<div class="px-15 h-w">
				 <p><label for="hotline_2">Hotline 2</label><br/>
				 <input style="width:100%; height: 38px;" type="text" name="hotline_2" value="<?php echo get_option('hotline_2')?>" /></p>
				</div>

				<div class="px-15 h-w">
				 <p><label for="facebook_company">Địa chỉ Facebook</label><br/>
				 <input style="width:100%; height: 38px;" type="text" name="facebook_company" value="<?php echo get_option('facebook_company')?>" /></p>
				</div>
				<div class="px-15 h-w">
				 <p><label for="twitter_company">Địa chỉ Twitter</label><br/>
				 <input style="width:100%; height: 38px;" type="text" name="twitter_company" value="<?php echo get_option('twitter_company')?>" /></p>
				</div>
				<div class="px-15 h-w">
				 <p><label for="youtube_company">Địa chỉ Youtube</label><br/>
				 <input style="width:100%; height: 38px;" type="text" name="youtube_company" value="<?php echo get_option('youtube_company')?>" /></p>
				</div>
				<div class="px-15 h-w">
				 <p><label for="pinterest_company">Địa chỉ Pinterest</label><br/>
				 <input style="width:100%; height: 38px;" type="text" name="pinterest_company" value="<?php echo get_option('pinterest_company')?>" /></p>
				</div>
				<div class="px-15 h-w">
				 <p><label for="zalo">Zalo Fanpage</label><br/>
				 <input style="width:100%; height: 38px;" type="text" name="zalo" value="<?php echo get_option('zalo')?>" /></p>
				</div>
				<div class="px-15" style="clear: both;">
				 <p><label for="google_map">Chèn Google Map</label><br/></p>
				 <textarea name="google_map" cols="40" rows="5" style="width:100%;"><?php echo get_option('google_map')?></textarea>
				</div>
				<div class="px-15 h-w">
				 <p><label for="designer">Designer</label><br/>
				 <input style="width:100%; height: 38px;" type="text" name="designer" value="<?php echo get_option('designer')?>" /></p>
				</div>
				<div class="px-15" style="clear: both;">
				 <p class="submit">
				 <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				 </p>
				</div>			 
			</div>
		</form>
	</div>
<?php } }
function trim_text_to_words($excerpt, $desired_length = 100){
	$excerpt = wp_strip_all_tags($excerpt);
	$desired_length = $desired_length?:100;
	if (strlen($excerpt) > $desired_length) {
	  $excerpt = preg_replace('/\s+?(\S+)?$/', '', substr( $excerpt , 0, $desired_length+1));
	}
	return $excerpt."...";
}
function remove_head_scripts() { 
	if(!is_admin()) {
		remove_action('wp_head', 'wp_print_scripts'); 
		remove_action('wp_head', 'wp_print_head_scripts', 9); 
		remove_action('wp_head', 'wp_enqueue_scripts', 1);

		add_action('wp_footer', 'wp_print_scripts', 5);
		add_action('wp_footer', 'wp_enqueue_scripts', 5);
		add_action('wp_footer', 'wp_print_head_scripts', 5); 
	}
} 
function remove_image_size_attributes($html){ return preg_replace( '/(width|height)="\d*"/', '', $html ); }
// Remove image size attributes from post thumbnails
add_filter( 'post_thumbnail_html', 'remove_image_size_attributes' );
// Remove image size attributes from images added to a WordPress post
add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );

add_action( 'admin_footer', 'rv_custom_dashboard_widget' );
function rv_custom_dashboard_widget(){if(get_current_screen()->base !== 'dashboard'){return;}?>
 <div id="custom-id" class="welcome-panel" style="display: none;">
 	<h3 style="margin-top: 0;text-transform: uppercase">CHÀO MỪNG BẠN ĐẾN VỚI TRANG QUẢN TRỊ WEBSITE <?php echo get_bloginfo( 'name' ); ?>.</h3>
	<p><strong>THÔNG TIN WEBSITE:</strong></p>
	<p><?php echo bloginfo( 'name' ); ?> | <?php echo bloginfo( 'description' ); ?></p>
	<p>Website được phát triển bởi <strong><a href="https://www.facebook.com/nguyenvanhoach89/">NGUYỄN VĂN HOẠCH</a></strong>.</p>
	<p><strong>THÔNG TIN LIÊN HỆ:</strong></p>
	<p><strong>Web Developer</strong>:  NGUYỄN VĂN HOẠCH</p>
	<p><strong>Email</strong>: theearthsmall@gmail.com</p>
	<p><strong>Phone</strong>: <a href="tel:0937956838">0937.956.838</a>&nbsp;|&nbsp;<a href="tel:0989084017">0989.084.017</a></p> 
 </div>
 <script>
  jQuery(document).ready(function($){$('#welcome-panel').after($('#custom-id').show());});
 </script>
<?php }
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
function remove_wp_logo($wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );
function tp_admin_logo() {
    echo '<br/> <img src="'. get_template_directory_uri() .'/assets/images/logo.png"/>';
}
add_action( 'admin_notices', 'tp_admin_logo' );
function tp_admin_footer_credits( $text ) {	
	$text='<p>Chào mừng bạn đến với website <a href="'.get_bloginfo( 'url' ).'"  title="'.get_bloginfo( 'name' ).'"><strong>'.get_bloginfo( 'name' ).'</strong></a></p>';
   	return $text;
}
add_filter( 'admin_footer_text', 'tp_admin_footer_credits' );
function custom_loginlogo() {
echo '<style type="text/css">
h1 a {background-image: url("'. get_template_directory_uri() .'/assets/images/logo.png") !important; background-size: contain  !important;width: auto !important;}
</style>';
}
add_action('login_head', 'custom_loginlogo');
// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
// Remove WP Version From Styles 
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );
// Function to remove version numbers
function sdt_remove_ver_css_js( $src ) {
 if ( strpos( $src, 'ver=' ) )
  $src = remove_query_arg( 'ver', $src );
 return $src;
}
remove_action( 'wp_head', 'wp_generator' );

/*start crumbs*/
$opt 						= array();
$opt['home'] 				= '<i class="fas fa-home mr-1"></i>Trang chủ';
$opt['blog'] 				= "";
$opt['sep'] 				= '<i class="fa fa-angle-right mx-1" style="color: #646464;"></i>';
$opt['prefix']				= "";
$opt['boldlast'] 			= true;
$opt['nofollowhome'] 		= true;
$opt['singleparent'] 		= 0;
$opt['singlecatprefix']		= true;
$opt['archiveprefix'] 		= "";
$opt['searchprefix'] 		= "Search for ";
update_option("bt_breadcrumbs",$opt);
function bt_breadcrumb($prefix = '', $suffix = '', $display = true) {
	global $wp_query, $post;
	$opt = get_option("bt_breadcrumbs");
	if (!function_exists('bold_or_not')) {
		function bold_or_not($input) {
			$opt = get_option("bt_breadcrumbs");
			if ($opt['boldlast']) {
				return '<span class="current">'.$input.'</span>';
			} else {
				return $input;
			}
		}
	}
	if (!function_exists('bt_get_category_parents')) {
		// Copied and adapted from WP source
		function bt_get_category_parents($id, $link = FALSE, $separator = '/', $nicename = FALSE){
			$chain = '';
			$parent = &get_category($id);
			if ( is_wp_error($parent ) )
			   return $parent;
			if ($nicename )
			   $name = $parent->slug;
			else
			   $name = $parent->cat_name;
			if ($parent->parent && ($parent->parent != $parent->term_id) )
			   $chain .= get_category_parents($parent->parent, true, $separator, $nicename);
			$chain .= bold_or_not($name);
			return $chain;
		}
	}
	$nofollow = ' ';
	if ($opt['nofollowhome']) {
		$nofollow = ' rel="nofollow" ';
	}
	$on_front = get_option('show_on_front');
	if ($on_front == "page") {
		$homelink = '<a'.$nofollow.'href="'.get_permalink(get_option('page_on_front')).'"><i class="fa fa-home" aria-hidden="true"></i> '.$opt['home'].'</a>';
		$bloglink = $homelink.'  <a href="'.get_permalink(get_option('page_for_posts')).'">'.$opt['blog'].'</a>';
	} else {
		$homelink = '<a'.$nofollow.'href="'.get_bloginfo('url').'">'.$opt['home'].'</a>';
		$bloglink = $homelink;
	}
	if ( ($on_front == "page" && is_front_page()) || ($on_front == "posts" && is_home()) ) 	{
		$output = bold_or_not($opt['home']);
	} elseif ($on_front == "page" && is_home() ) {
		$output = $homelink.' '.$opt['sep'].' '.bold_or_not($opt['blog']);
	} elseif ( !is_page() ) {
		$output = $bloglink.' '.$opt['sep'].' ';
		if ( ( is_single() || is_category() || is_tag() || is_date() || is_author() ) && $opt['singleparent'] != false)
		{
			$output .= '<a href="'.get_permalink($opt['singleparent']).'">'.get_the_title($opt['singleparent']).'</a> '.$opt['sep'].' ';
		}
		if (is_single() && $opt['singlecatprefix']) {
			$cats = get_the_category();
			$cat = $cats[0];
			if ( is_object($cat) ) {
				if ($cat->parent != 0) {
					$output .= get_category_parents($cat->term_id, true, " ".$opt['sep']." ");
				} else {
				   //	$output .= '<a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a> '.$opt['sep'].' ';
				}
			}
		}
		if ( is_category() )
		{
			$cat = intval( get_query_var('cat') );
			$output .= bt_get_category_parents($cat, false, " ".$opt['sep']." ");
		} elseif ( is_tag() )
		{
			$output .= bold_or_not($opt['archiveprefix']." ".single_cat_title('',false));
		} elseif ( is_date() )
		{
			$output .= bold_or_not($opt['archiveprefix']." ".single_month_title(' ',false));
		} elseif ( is_author() )
		{
			$user = get_userdatabylogin($wp_query->query_vars['author_name']);
			$output .= bold_or_not($opt['archiveprefix']." ".$user->display_name);
		} elseif ( is_search() )
		{
			//$output .= bold_or_not('Tìm kiếm "'.stripslashes(strip_tags(get_search_query())).'"');
			$output .= bold_or_not('Tìm kiếm');
		}
		else if ( is_tax() )
		{
			$taxonomy 	= get_taxonomy ( get_query_var('taxonomy') );
			//$term_title		=  single_term_title('',false);
			$page= get_page_by_title($taxonomy->label, 'OBJECT', 'page');
			$term = get_term_by('slug',get_query_var('term') , $taxonomy->name);
			$output .='<a rel="nofollow" href="'.  get_permalink($page->ID) . '">'. $taxonomy->label.'</a> ';
			$terms = array($term);
			while($term->parent){
				$term =get_term($term->parent	, $term->taxonomy );
				$terms [] =$term ;
			}
			$terms = array_reverse($terms);
			for ($i=0;$i<count($terms);$i++)
			{
				$link = get_term_link($terms[$i]);
				if($i+1==count($terms))
				{
					$output .=$opt['sep']. ' '. bold_or_not($terms[$i]->name );
				}
				//else
					//$output .=$opt['sep']. ' '. '<a rel="nofollow" href="'.  $link . '">'. $terms[$i]->name .'</a> ';
			}
		} else {
				if($post->post_type !='page')
				{
					$post_type_label = $opt['blog'];
					if($post->post_type !='post') {
							global $wp_post_types;
							$obj = $wp_post_types[$post->post_type];
							$post_type_label = $obj->labels->name;
					}
					$page= get_page_by_title($post_type_label, 'OBJECT', 'page');
					if($page) {
						$output .= '<a rel="nofollow" href="'. get_permalink($page->ID). '">'. $post_type_label.'</a>';
					}
					//wp_die($post->post_type);
					if(is_singular('post')){}
					else
					$output .= ' '.$opt['sep'].' ';
		}
		$output .= bold_or_not(get_the_title());
		}
	} else {
		$post = $wp_query->get_queried_object();
		// If this is a top level Page, it's simple to output the breadcrumb
		if ( 0 == $post->post_parent ) {
			$output = $homelink." ".$opt['sep']." ".bold_or_not(get_the_title());
		} else {
			if (isset($post->ancestors)) {
				if (is_array($post->ancestors))
					$ancestors = array_values($post->ancestors);
				else
					$ancestors = array($post->ancestors);
			} else {
				$ancestors = array($post->post_parent);
			}
			// Reverse the order so it's oldest to newest
			$ancestors = array_reverse($ancestors);
			// Add the current Page to the ancestors list (as we need it's title too)
			$ancestors[] = $post->ID;
			$links = array();
			foreach ($ancestors as $ancestor ) {
				$tmp  = array();
				$tmp['title'] 	= strip_tags( get_the_title($ancestor ) );
				$tmp['url'] 	= get_permalink($ancestor);
				$tmp['cur'] = false;
				if ($ancestor == $post->ID  ) {
					$tmp['cur'] = true;
				}
				$links[] = $tmp;
			}
			$output = $homelink;
			foreach ($links as $link ) {
				$output .= ' '.$opt['sep'].' ';
				if (!$link['cur']) {
					$output .= '<a href="'.$link['url'].'">'.$link['title'].'</a>';
				} else {
					    $output .= bold_or_not($link['title']);
				}
			}
		}
	}
	if ($opt['prefix'] != "")
	{
		$output = $opt['prefix']." ".$output;
		$output = $opt['prefix'];
	}
	if ($display) {
		$output = str_ireplace("(Not remove or edit)", "", $output);
		echo $prefix.$output.$suffix;
	} else {
		return $prefix.$output.$suffix;
	}
}
function breadcrumb() {
		bt_breadcrumb('<div id="crumbs" class="list-crumb text-capitalize">','</div>');
	return;
}
/*end crumbs*/

function slideshow_register() {
    register_post_type( 'slideshow',  	
		array(
		  'labels' => array(
		    'name' => __( 'Slider show' ),
		    'singular_name' => __( 'Slider show' )
		  ),
		  'hierarchical' => true,
		  'show_ui' => true, 
		  'taxonomies' => array('post_tag'),
		  'public' => true,
		  'has_archive' => true,
		  'menu_position' => 4,
		  'can_export' => true,
		  'capability_type' => 'post',
		  'rewrite' => array('slug' => 'slideshow'),
		  'menu_icon' => 'dashicons-camera', 
        'supports' => array('title','thumbnail'),
		)
	);
	register_taxonomy( 'slider-location', array( 'slideshow' ),
		array(
			'labels' => array(
				'name' => 'Slider Location',
				'menu_name' => 'Slider Location',
				'singular_name' => 'Slider Location',
				'all_items' => 'Slider Location'
			),
			'public' => true,
			'hierarchical' => true,
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'slider-location', 'hierarchical' => true, 'with_front' => false ),
		)
	);

}
add_action('init', 'slideshow_register');
add_action("admin_init", "admin_init");
function admin_init(){
  add_meta_box("url-meta", "Slider Options", "url_meta", "slideshow", "side", "low");
}
function url_meta(){
  global $post;
  $custom = get_post_custom($post->ID);
  $url = $custom["url"][0];
  $url_open = $custom["url_open"][0];
  ?>
  <label>URL:</label>
  <input name="url" value="<?php echo $url; ?>" />
  <input type="checkbox" name="url_open"<?php if($url_open == "on"): echo " checked"; endif ?>>URL open in new window?<br />
  <?php
}

add_action('save_post', 'save_details');
function save_details(){
  global $post;

  if( $post->post_type == "slideshow" ) {
      if(!isset($_POST["url"])):
         return $post;
      endif;
      if($_POST["url_open"] == "on") {
        $url_open_checked = "on";
      } else {
        $url_open_checked = "off";
      }
      update_post_meta($post->ID, "url", $_POST["url"]);
      update_post_meta($post->ID, "url_open", $url_open_checked);
  }
}
function banner_meta_box() {
	add_meta_box( 'banner-info', 'Thông tin banner', 'banner_output', 'slideshow' );
}
add_action( 'add_meta_boxes', 'banner_meta_box' );

function banner_output($post) {
	$des_banner = get_post_meta($post->ID,'des_banner',true);
	wp_nonce_field( 'save_banner', 'banner_nonce' );?>
	<p>
		<label for="des_banner">Description: </label><br>
		<input type="text" style="height:38px;width: 100%" id="des_banner" name="des_banner" value="<?php echo esc_attr($des_banner); ?>"/>
 	</p>	
<?php }
function banner_save($post_id) {
	$banner_nonce = $_POST['banner_nonce'];
	if( !isset($banner_nonce ) ) { return; }
	// Kiểm tra nếu giá trị nonce không trùng khớp
	if( !wp_verify_nonce($banner_nonce, 'save_banner' ) ) { return; }
	$des_banner = sanitize_text_field($_POST['des_banner'] );	
	update_post_meta($post_id, 'des_banner', $des_banner);
}
add_action( 'save_post', 'banner_save' );

function getSliderBanner($post_page = '-1') {  
	$args = array(
	'post_type' => 'slideshow',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => $post_page,
	'tax_query' => array(
			array(
				'taxonomy' => 'slider-location',
				'field' => 'slug',
				'terms' => 'main',//tên ở trong homslide
				'operator' => 'IN'
			)
		)
	);
	$listbanner = new WP_Query($args); 
	if ($listbanner->have_posts()) {
		echo '<div class="banner-home mt-md-2">';
			$loop1 = '<div class="slider slider-for">';
			$loop2 = '<div class="slider slider-nav">';
			while ($listbanner->have_posts() ) : $listbanner->the_post();
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full' );	
				$post_id = get_the_ID();		
				$des_banner = get_post_meta($post_id, 'des_banner', true );
				$custom = get_post_custom(get_the_id());
				$url = $custom["url"][0]; 
				$url_open = $custom["url_open"][0];
				$custom_title = "#".get_the_id(); 
				$_blank = '';
				
				if($url_open) {
					$_blank = 'target="_blank"';
				}
				if ($url) {
					$loop1 .= '<div><a '.$_blank .' title="'. get_the_title() . '" href="'.$url.'" class="d-block">'.get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' =>'img-fluid w-100', 'loading' => 'lazy') ).'</a></div>';
				} else {
					$loop1 .= '<div>'.get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' =>'img-fluid w-100', 'loading' => 'lazy') ).'</div>';
				}

				$loop2 .= '<div class="banner-des h-auto text-center"><span class="d-flex align-items-center justify-content-center">'. get_the_title() . '</span></div>';
					
			endwhile;
			$loop1 .= '</div>';
			$loop2 .= '</div>';
			echo $loop1;
			echo $loop2;
		echo '</div>';
	}
	wp_reset_query(); 
}
function sliderMainRight($post_page = '3') {  
	$args = array(
	'post_type' => 'slideshow',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => $post_page,
	'tax_query' => array(
			array(
					'taxonomy' => 'slider-location',
					'field' => 'slug',
					'terms' => 'main-right',
					'operator' => 'IN'
			)
		)
	);
	$listbanner = new WP_Query($args); 
	if ($listbanner->have_posts()) {
		echo '<div class="promo-home">';
			while ($listbanner->have_posts() ) : $listbanner->the_post();
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full' );	
				$post_id = get_the_ID();		
				$des_banner = get_post_meta($post_id, 'des_banner', true );
				$custom = get_post_custom(get_the_id());
				$url = $custom["url"][0]; 
				$url_open = $custom["url_open"][0];
				$custom_title = "#".get_the_id(); 
				$_blank = '';
				if($url_open) {
					$_blank = 'target="_blank"';
				}
				if ($url) {
					echo '<a '.$_blank .' title="'. get_the_title() . '" href="'.$url.'" class="mt-1 d-block">'.get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' =>'img-fluid w-100', 'loading' => 'lazy') ).'</a>';
				} else {
					echo '<div class="mt-1 d-block">'.get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' =>'img-fluid w-100', 'loading' => 'lazy') ).'</div>';
				}
			endwhile;
		echo '</div>';
	}
	wp_reset_query(); 
}
function contactForm() {
	$success = '';  $errcaptacha = ''; 
   if(isset($_POST['btn-send']) ) { 
	   $address_company = '537 Đỗ Xuân Hợp, Phường Phước Long B, Quận 9, Tp.Hồ Chí Minh';$phone_company = '0936.275.345';$mail_company = 'tuonglk01@gmail.com';
	   if(get_option('address_company') !='') {
		   $address_company = get_option('address_company');
	   }
	   if(get_option('phone_company') !='') {
		   $phone_company = get_option('phone_company');
	   }
	   if(get_option('hotline') !='') {
		   $hotline = get_option('hotline');
	   }
	   if(get_option('mail_company') !='') {
		   $mail_company = get_option('mail_company');
	   }
	   if(isset($_POST['g-recaptcha-response'])){  
		 $tut_captcha=$_POST['g-recaptcha-response'];
	   } 
	   if(!$tut_captcha){
		 $errcaptacha = '<div class="text-danger">Bạn chưa xác thực reCAPTCHA!.</div>';
	   }  
	   $kiemtra=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le2jkQdAAAAAGEQzbxCRP7BxPpe4gJX6v2FnuFe&response=".$tut_captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
	   
	   $kiemtra = json_decode($kiemtra);
	   
	   if($kiemtra->success == false) {
		 $errcaptacha = 'Bạn đã nhập sai mã Captcha ?';
		 echo '<script> window.alert("Bạn chưa chọn Captcha ?");
					   window.location = "'.get_bloginfo( 'url' ).'/lien-he"</script>';	
		 die();
	   } else {
		   $email = trim($_POST['your-email']);
		   $yourName = trim($_POST['your-name']);
		   $yourTel = trim($_POST['your-tel']);
		   $yourMessage = trim($_POST['your-message']);
		   $result = array('status' => 0);
		   require(get_stylesheet_directory().'/PHPMailer-5.2.16/PHPMailerAutoload.php');

		   $mail  = new PHPMailer();
		   $body = "";		
		   $mail->IsSMTP();
		   $mail->CharSet = "UTF-8";
		   $mail->SMTPDebug  = 2;
		   $mail->SMTPAuth   = true;
		   $mail->Host       = "smtp.gmail.com";
		   $mail->SMTPSecure = 'tls';
		   $mail->Port       = 587;
		   $mail->Username   = "automails123@gmail.com";
		   $mail->Password   = "Khongthequen89";
		   $mail->SetFrom('admin@gmail.com');
		   $mail->addAddress($mail_company);
		//    $mail->addCC($email,'ducnguyen6318@gmail.com','xuanngoc@martoyo.vn');
		   $mail->addCC('automails123@gmail.com');
		   $mail->Subject    = "Nội Dung Liên Hệ Tới - ".get_bloginfo( 'name' )."";
		   $body.="<div style='background-color:#ffffff;color:#000000;font-family:Arial,Helvetica,sans-serif;font-size:15px;margin:0 auto;padding:0'>
		   <table align='center' border='0' cellpadding='0' cellspacing='0' style='padding:0;border-spacing:0px;table-layout:fixed;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;background-color:#f5f5f5;'>
		   <tbody><tr><td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;padding-left:40px' bgcolor='#e4e6ea'></td></tr><tr>
			   <td bgcolor='#f5f5f5' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif'>
				   <table border='0' cellpadding='0' cellspacing='0' width='688' align='center' style='padding:0;border-spacing:0px;table-layout:fixed;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif'>
					   <tbody>
					   <tr>
						   <td width='360' align='left' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;padding:10px 0 10px 10px'>
							   <a href='".get_bloginfo( 'url' )."' style='text-decoration:none;font-family:Arial,Helvetica,sans-serif' target='_blank'>
								   <img src='".get_template_directory_uri()."/assets/images/logo.png' style='border:0;max-width: 100%;height: auto' alt=''></a>
						   </td>
						   <td width='30' align='left' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif'></td>
						   <td width='90' align='left' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif'><a href='".get_bloginfo( 'url' )."/gioi-thieu' style='text-decoration:none;font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:12px;line-height:20px;display:inline-block' target='_blank'>Về Chúng Tôi</a></td>
						   <td width='30' align='left' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif'></td>
						   <td width='90' align='left' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif'><a href='".get_bloginfo( 'url' )."/lien-he' style='text-decoration:none;font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:12px;line-height:20px;display:inline-block' target='_blank'>Liên Hệ</a></td>
					   </tr>
					   </tbody>
				   </table>
			   </td>
		   </tr>
		   <tr>
			   <td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;padding-bottom: 30px'>
			   <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse:collapse' bgcolor='#ffffff'>
				   <tbody>
					 <tr><td bgcolor='#105aa6' width='100%' height='15px' valign='top'></td></tr>
					   <tr>
						   <td>
							   <table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='#ffffff'>
								   <tbody>
								   <tr>
									   <td style='background-color:#105aa6;width:16px;height:100%;padding:0;margin:0;line-height:0;border:none'></td>
									   <td style='padding:0px 0 22px 0'>
										   <table border='0' cellpadding='0' cellspacing='0' width='100%' style='padding:15px 0 0 0'>
											   <tbody>
											   <tr>
												   <td style='padding:14px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#1a7138'><b>Nội Dung Liên Hệ</b></td>
											   </tr>
											   <tr>
												   <td style='padding:18px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666'>Cảm ơn quý khách ".$yourName." đã gửi nội dung sau tới ".get_bloginfo( 'name' ).":</td>
											   </tr>
											   <tr>
												   <td style='padding:18px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666'>
												   <div style='background-color: #eee;border:2px solid #f50; padding:20px;margin-bottom:15px'>
													   <div style='margin-bottom:10px;'>Tên khách hàng: <b>".$yourName."</b></div>
													   <div style='margin-bottom:10px;'>Email khách hàng: <b>".$email."</b></div>
													   <div>Nội dung: <b>".$yourMessage."</b></div>
												   </div>
												   </td>
											   </tr>
																					   
											   <tr>
												   <td style='padding:3px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666;margin-top:30px;'>► Email hỗ trợ: <a href='mailto:".$mail_company."' target='_blank'> <span style='color:#0388cd'>".$mail_company."</span></a> hoặc</td>
											   </tr>
											   <tr>
												   <td style='padding:3px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666'>► Tổng đài Chăm sóc khách hàng: <span style='font-weight:bold'>".$hotline." </span></td>
											   </tr>
											   <tr>
												   <td style='padding:16px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666'><span style='font-weight:bold'>".get_bloginfo( 'name' )."</span> trân trọng cảm ơn và rất hân hạnh được phục vụ Quý khách.</td>
											   </tr>
											   <tr>
												   <td style='padding:12px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#666666;font-style:italic'>*Quý khách vui lòng không trả lời email này*.</td>
											   </tr>
											   </tbody>
										   </table>
									   </td>
									   <td style='background-color:#105aa6;width:16px;height:100%;padding:0;margin:0;line-height:0;border:none'></td>
								   </tr>
								   </tbody>
							   </table>
						   </td>
					   </tr>
					   <tr>
						   <td style='background-color:#105aa6;width:100%;height:15px'></td>
					   </tr>
				   </tbody>
			   </table>
			   </td>
		   </tr>
		   </tbody>
		   </table>
		   <table border='0' cellpadding='0' cellspacing='0' width='600' align='center' style='padding:0;border-spacing:0px;table-layout:fixed;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;'>
		   <tbody>
			   <tr>
			   <td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;padding-bottom:20px'>
				   <table border='0' cellpadding='0' cellspacing='0' width='100%' style='padding:0;border-spacing:0px;table-layout:fixed;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif'>
				   <tbody>
					   <tr>
					   <td style='margin:0;font-family:Arial,Helvetica,sans-serif;padding:20px 0'>
						   <table border='0' cellpadding='0' cellspacing='0' width='100%' style='padding:0;border-spacing:0px;table-layout:fixed;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif'>
						   <tbody>
							   <tr>
							   <td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:15px;line-height:20px'><b>".get_bloginfo( 'name' )."</b></td>
							   </tr>
							   <tr>
							   <td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:12px;line-height:20px'><b>Địa chỉ giao dịch: </b>".$address_company."</td>
							   </tr>
							   <tr>
							   <td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:12px;line-height:20px'><b>Hotline:</b> ".$hotline." - Email: <b>".$mail_company."</b></td>
							   </tr>				                   
						   </tbody>
						   </table>
					   </td>
					   </tr>
				   </tbody>
				   </table>
			   </td>
			   </tr>
		   </tbody>
		   </table>
		   </div>";
		   $mail->MsgHTML($body);	
		   // if  update user return true then lets send user an email containing the new password

		   if(!$mail->Send()) {
			   echo "Mailer Error: " . $mail->ErrorInfo;
			   $result['msg'] = 'There is an error, please check your input and try again';
			   $result['debug'] = $mail->ErrorInfo;
		   } else {
			   $result['status'] = 1;
			   echo '<script> window.alert("Cảm ơn Quý Khách đã gửi thông điệp tới '.get_bloginfo( 'name' ).'. '.get_bloginfo( 'name' ).' sẽ sớm phản hồi lại Quý khách hàng.");
				   window.location = "'.get_bloginfo( 'url' ).'"</script>';	
		   }
	   }
	   
   } ?>
	<form action="" method="post" accept-charset="utf-8">                                
		<div class="row form-group">
			<div class="col-sm-4 col-lg-3"><label>Họ tên *</label></div>
			<div class="col-sm-8 col-lg-9"><input type="text" name="your-name" class="form-control" required></div>
		</div>
		<div class="row form-group">
			<div class="col-sm-4 col-lg-3"><label>Email *</label></div>
			<div class="col-sm-8 col-lg-9"><input type="email" name="your-email" required class="form-control"></div>
		</div>
		<div class="row form-group">
			<div class="col-sm-4 col-lg-3"><label>Điện thoại *</label></div>
			<div class="col-sm-8 col-lg-9"><input type="tel" name="your-tel" required class="form-control"></div>
		</div>
		<div class="row form-group">
			<div class="col-sm-4 col-lg-3"><label>Thông tin liên hệ</label></div>
			<div class="col-sm-8 col-lg-9"><textarea name="your-message" cols="40" rows="3" class="form-control"></textarea></div>
		</div>
		
		<div class="form-group g-recaptcha-block row align-items-center">
			<div class="col-sm-4 col-lg-3"></div>
			<div class="col-sm-8 col-lg-9"><div class="g-recaptcha" data-sitekey="6Le2jkQdAAAAAHxEYncFqBXcaTP0jq5jG-PJrYAy"></div></div>
		</div>
		<div class="row form-group">
			<div class="col-sm-4 col-lg-3"></div>
			<div class="col-sm-8 col-lg-9"><input type="submit" value="Gửi liên hệ" class="btn btn-send px-3 px-lg-4 py-2" name="btn-send"></div>
		</div>
		<div class="form-group text-danger"><?php	echo $errcaptacha;?></div>
	</form>
<?php 		
}
function revcon_change_post_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Tin Tức';
	$submenu['edit.php'][5][0] = 'Tin Tức';
	$submenu['edit.php'][10][0] = 'Thêm Tin Tức';
	$submenu['edit.php'][16][0] = 'Thẻ Tin Tức';
}
function revcon_change_post_object() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Tin Tức';
	$labels->singular_name = 'Tin Tức';
	$labels->add_new = 'Thêm Tin Tức';
	$labels->add_new_item = 'Thêm Tin Tức';
	$labels->edit_item = 'Chỉnh Sửa Tin Tức';
	$labels->new_item = 'Tin Tức';
	$labels->view_item = 'Xem Tin Tức';
	$labels->search_items = 'Tìm Kiếm Tin Tức';
	$labels->not_found = 'Tin Tức Không Tìm Thấy';
	$labels->not_found_in_trash = 'Tin Tức Không Tìm Thấy Trong Thùng Rác';
	$labels->all_items = 'Tất Cả Tin Tức';
	$labels->menu_name = 'Tin Tức';
	$labels->name_admin_bar = 'Tin Tức';
}

add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );

add_post_type_support( 'page', 'excerpt' );


//CODE LAY LUOT XEM
function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "01 lượt xem";
	}
	return $count.' lượt xem';
} 
// CODE DEM LUOT XEM
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
	}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
	}
}

function yeucauBaoGiaForm() {
	global $wp;
	$success = '';  $errcaptacha = ''; 
  if(isset($_POST['btn-yeucau']) ) { 
	   $address_company = '537 Đỗ Xuân Hợp, Phường Phước Long B, Quận 9, Tp.Hồ Chí Minh';$phone_company = '0936.275.345';$mail_company = 'tuonglk01@gmail.com';
	   if(get_option('address_company') !='') {
		   $address_company = get_option('address_company');
	   }
	   if(get_option('phone_company') !='') {
		   $phone_company = get_option('phone_company');
	   }
	   if(get_option('hotline') !='') {
		   $hotline = get_option('hotline');
	   }
	   if(get_option('mail_company') !='') {
		   $mail_company = get_option('mail_company');
	   }
	   if(isset($_POST['g-recaptcha-response'])){  
		 $tut_captcha=$_POST['g-recaptcha-response'];
	   } 
	   if(!$tut_captcha){
		 $errcaptacha = '<div class="text-danger">Bạn chưa xác thực reCAPTCHA!.</div>';
	   }  
	   $kiemtra=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le2jkQdAAAAAGEQzbxCRP7BxPpe4gJX6v2FnuFe&response=".$tut_captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
	   
	   $kiemtra = json_decode($kiemtra);
	   
	   if($kiemtra->success == false) {
		 $errcaptacha = 'Bạn đã nhập sai mã Captcha ?';
		 echo '<script> window.alert("Bạn chưa chọn Captcha ?");
					   window.location = "'.home_url($wp->request).'"</script>';	
		 die();
	   } else {
		   $email = trim($_POST['your-email']);
		   $yourName = trim($_POST['your-name']);
		   $yourTel = trim($_POST['your-tel']);
		   $tuvan1 =  $_POST['tuvan1'];
			 $tuvan2 =  $_POST['tuvan2'];
			 $tuvan3 =  $_POST['tuvan3'];			
		   $result = array('status' => 0);
		   require(get_stylesheet_directory().'/PHPMailer-5.2.16/PHPMailerAutoload.php');

		   $mail  = new PHPMailer();
		   $body = "";		
		   $mail->IsSMTP();
		   $mail->CharSet = "UTF-8";
		   $mail->SMTPDebug  = 2;
		   $mail->SMTPAuth   = true;
		   $mail->Host       = "smtp.gmail.com";
		   $mail->SMTPSecure = 'tls';
		   $mail->Port       = 587;
		   $mail->Username   = "automails123@gmail.com";
		   $mail->Password   = "Khongthequen89";
		   $mail->SetFrom('admin@gmail.com');
		   $mail->addAddress($mail_company);
		//    $mail->addCC($email,'ducnguyen6318@gmail.com','xuanngoc@martoyo.vn');
		   $mail->addCC('automails123@gmail.com');
		   $mail->Subject    = "THÔNG TIN YÊU CẦU TƯ VẤN - ".get_bloginfo( 'name' )."";
		   $body.="<div style='background-color:#ffffff;color:#000000;font-family:Arial,Helvetica,sans-serif;font-size:15px;margin:0 auto;padding:0'>
		   <table align='center' border='0' cellpadding='0' cellspacing='0' style='padding:0;border-spacing:0px;table-layout:fixed;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;background-color:#f5f5f5;'>
		   <tbody><tr><td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;padding-left:40px' bgcolor='#e4e6ea'></td></tr><tr>
			   <td bgcolor='#f5f5f5' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif'>
				   <table border='0' cellpadding='0' cellspacing='0' width='688' align='center' style='padding:0;border-spacing:0px;table-layout:fixed;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif'>
					   <tbody>
					   <tr>
						   <td width='360' align='left' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;padding:10px 0 10px 10px'>
							   <a href='".get_bloginfo( 'url' )."' style='text-decoration:none;font-family:Arial,Helvetica,sans-serif' target='_blank'>
								   <img src='".get_template_directory_uri()."/assets/images/logo.png' style='border:0;max-width: 100%;height: auto' alt=''></a>
						   </td>
						   <td width='30' align='left' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif'></td>
						   <td width='90' align='left' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif'><a href='".get_bloginfo( 'url' )."/gioi-thieu' style='text-decoration:none;font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:12px;line-height:20px;display:inline-block' target='_blank'>Về Chúng Tôi</a></td>
						   <td width='30' align='left' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif'></td>
						   <td width='90' align='left' style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif'><a href='".get_bloginfo( 'url' )."/lien-he' style='text-decoration:none;font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:12px;line-height:20px;display:inline-block' target='_blank'>Liên Hệ</a></td>
					   </tr>
					   </tbody>
				   </table>
			   </td>
		   </tr>
		   <tr>
			   <td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;padding-bottom: 30px'>
			   <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse:collapse' bgcolor='#ffffff'>
				   <tbody>
					 	<tr><td bgcolor='#105aa6' width='100%' height='15px' valign='top'></td></tr>
					   <tr>
						   <td>
							   <table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='#ffffff'>
								   <tbody>
								   <tr>
									   <td style='background-color:#105aa6;width:16px;height:100%;padding:0;margin:0;line-height:0;border:none'></td>
									   <td style='padding:0px 0 22px 0'>
										   <table border='0' cellpadding='0' cellspacing='0' width='100%' style='padding:15px 0 0 0'>
											   <tbody>
											   <tr>
												   <td style='padding:14px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#1a7138'><b>Thông Tin Tư Vấn</b></td>
											   </tr>
											   <tr>
												   <td style='padding:18px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666'>Cảm ơn quý khách ".$yourName." đã gửi thông tin sau tới ".get_bloginfo( 'name' ).":</td>
											   </tr>
											   <tr>
												   <td style='padding:18px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666'>
												   <div style='background-color: #eee;border:2px solid #f50; padding:20px;margin-bottom:15px'>
													   <div style='margin-bottom:10px;'>Họ Và Tên: <b>".$yourName."</b></div>
													   <div style='margin-bottom:10px;'>Số Điện Thoại: <b>".$yourTel."</b></div>
													   <div style='margin-bottom:10px;'>Email: <b>".$email."</b></div>
													   <div>Nội dung tư vấn: <b>".$tuvan1.", ".$tuvan2.", ".$tuvan3."</b></div>
												   </div>
												   </td>
											   </tr>
																					   
											   <tr>
												   <td style='padding:3px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666;margin-top:30px;'>► Email hỗ trợ: <a href='mailto:".$mail_company."' target='_blank'> <span style='color:#0388cd'>".$mail_company."</span></a> hoặc</td>
											   </tr>
											   <tr>
												   <td style='padding:3px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666'>► Tổng đài Chăm sóc khách hàng: <span style='font-weight:bold'>".$hotline." </span></td>
											   </tr>
											   <tr>
												   <td style='padding:16px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666'><span style='font-weight:bold'>".get_bloginfo( 'name' )."</span> trân trọng cảm ơn và rất hân hạnh được phục vụ Quý khách.</td>
											   </tr>
											   <tr>
												   <td style='padding:12px 10px 0 24px;font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#666666;font-style:italic'>*Quý khách vui lòng không trả lời email này*.</td>
											   </tr>
											   </tbody>
										   </table>
									   </td>
									   <td style='background-color:#105aa6;width:16px;height:100%;padding:0;margin:0;line-height:0;border:none'></td>
								   </tr>
								   </tbody>
							   </table>
						   </td>
					   </tr>
				   </tbody>
			   </table>
			   </td>
		   </tr>
		   </tbody>
		   </table>
		   <table border='0' cellpadding='0' cellspacing='0' width='600' align='center' style='padding:0;border-spacing:0px;table-layout:fixed;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;'>
		   <tbody>
			   <tr>
			   <td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;padding-bottom:20px'>
				   <table border='0' cellpadding='0' cellspacing='0' width='100%' style='padding:0;border-spacing:0px;table-layout:fixed;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif'>
				   <tbody>
					   <tr>
					   <td style='margin:0;font-family:Arial,Helvetica,sans-serif;padding:20px 0'>
						   <table border='0' cellpadding='0' cellspacing='0' width='100%' style='padding:0;border-spacing:0px;table-layout:fixed;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif'>
						   <tbody>
							   <tr>
							   <td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:15px;line-height:20px'><b>".get_bloginfo( 'name' )."</b></td>
							   </tr>
							   <tr>
							   <td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:12px;line-height:20px'><b>Địa chỉ giao dịch: </b>".$address_company."</td>
							   </tr>
							   <tr>
							   <td style='padding:0;margin:0;font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:12px;line-height:20px'><b>Hotline:</b> ".$hotline." - Email: <b>".$mail_company."</b></td>
							   </tr>				                   
						   </tbody>
						   </table>
					   </td>
					   </tr>
				   </tbody>
				   </table>
			   </td>
			   </tr>
		   </tbody>
		   </table>
		   </div>";
		   $mail->MsgHTML($body);	
		   // if  update user return true then lets send user an email containing the new password

		   if(!$mail->Send()) {
			   echo "Mailer Error: " . $mail->ErrorInfo;
			   $result['msg'] = 'There is an error, please check your input and try again';
			   $result['debug'] = $mail->ErrorInfo;
		   } else {
			   $result['status'] = 1;
			   echo '<script> window.alert("Cảm ơn Quý Khách đã gửi thông tin cần tư vấn tới '.get_bloginfo( 'name' ).'. '.get_bloginfo( 'name' ).' sẽ sớm phản hồi lại Quý khách hàng.");
				   window.location = "'.get_bloginfo( 'url' ).'"</script>';	
		   }
	   }
	   
   } ?>
	<form id="tuvan" action="" method="post" accept-charset="utf-8" class="form-tuvan py-3 py-md-4 px-3 px-lg-5">    
		<h3 class="text-uppercase text-center mb-3"><i class="fa fa-headphones" aria-hidden="true"></i> Yêu cầu tư vấn</h3>                            
		<div class="row form-group">
			<div class="col-12"><input type="text" name="your-name" class="form-control text-center" required="" placeholder="Họ và tên *"></div>
		</div>
		<div class="row form-group">
			<div class="col-12"><input type="tel" name="your-tel" class="form-control text-center" required="" placeholder="Số điện thoại *"></div>
		</div>
		<div class="row form-group">
			<div class="col-12"><input type="email" name="your-email" required="" class="form-control text-center" placeholder="Email"></div>
		</div>
		<div class="row form-group">
			<div class="col-sm-12">
				<div class="checkbox"><label><input class="mr-1" type="checkbox" name="tuvan1" value="Tư vấn sản phẩm phù hợp">Tư vấn sản phẩm phù hợp</label></div>
				<div class="checkbox"><label><input class="mr-1" type="checkbox" name="tuvan2" value="Yêu cầu báo giá">Yêu cầu báo giá</label></div>
				<div class="checkbox"><label><input class="mr-1" type="checkbox" name="tuvan3" value="Yêu cầu tư vấn kỹ thuật">Yêu cầu tư vấn kỹ thuật</label></div>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-12 text-center"><input type="submit" value="Gửi liên hệ" class="btn btn-yeucau text-uppercase px-3 px-lg-4 py-2 w-100" name="btn-yeucau"></div>
		</div>
		<div class="row form-group g-recaptcha-block">
			<div class="col-12"><div class="g-recaptcha" data-sitekey="6Le2jkQdAAAAAHxEYncFqBXcaTP0jq5jG-PJrYAy"></div></div>
		</div>
		<div class="form-group text-danger"><?php	echo $errcaptacha;?></div>
	</form>
<?php 		
}
function related_posts($post_page = '4') {
	global $post;
	$categories = get_the_category($post->ID);
	if ($categories) {
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args=array(
		'category__in' => $category_ids[0],
		'post__not_in' => array($post->ID),
		'posts_per_page'=> $post_page, // Number of related posts that will be shown.
		'ignore_sticky_posts'=>1
		);

		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) {
		echo '<div id="related_posts"><h3 class="text-uppercase text-20 font-weight-bold">Bài viết liên quan</h3><div class="row space-1">';
		while( $my_query->have_posts() ) {
			$my_query->the_post();
			echo '<div class="col-6 col-md-3 my-2"><a href="'.get_the_permalink().'" rel="bookmark" title="'.get_the_title().'">';
			if(has_post_thumbnail()) {
				echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'img-fluid d-block w-100 mx-auto mb-2','loading' => 'lazy', 'alt' => get_the_title() ));
			} else {
				echo '<img src="'.get_template_directory_uri().'/assets/images/no_img.png" alt="'.get_the_title().'" class="img-fluid mb-2 d-block mx-auto" loading="lazy">';
			}	
			echo '</a><a class="text-14 font-weight-bold" style="color:#165fe6" href="'.get_the_permalink().'" rel="bookmark" title="'.get_the_title().'">'.get_the_title().'</a><time class="text-12 py-1 d-block">'.get_the_time('d-m-Y, g:i a').'</time></div>';		
		}
		echo '</div></div>';
		}
	}
	wp_reset_query(); 
}

function share_social() { ?>
	<div class="action-post d-flex flex-wrap align-items-center justify-content-center my-4">
		<div class="item-g btn-goback mr-1 mr-md-3 mb-3"><a title="Quay lại" rel="nofollow" href="javascript:window.history.back(-1);"><i class="fa fa-reply-all mr-1" aria-hidden="true"></i>Quay lại</a></div>
			<div class="item-g print mr-1 mr-md-3 mb-3"><a title="In bài này" onclick="javascript:window.print();" rel="nofollow" href="javascript:void(0)"><i class="fa fa-print mr-1" aria-hidden="true"></i>In bài này</a></div>
			<div class="item-g mr-1 mr-md-3 mb-3">Chia sẻ trên:</div>
			<div class="share-social d-flex flex-wrap align-items-center justify-content-center">
					<a class="mr-2 fb mb-3" title="Chia sẻ trên Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
					<a class="mr-3 mr-sm-2 instagram mb-3 rounded" title="Chia sẻ trên Instagram" href="https://www.instagram.com/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
					<a class="mr-3 mr-sm-2 twinter mb-3 rounded" title="Chia sẻ trên Twinter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>+<?php echo get_permalink(); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
					<a class="mr-3 mr-sm-2 pinterest mb-3 rounded" title="Chia sẻ trên Pinterest" href="https://www.pinterest.com/pin/create/link/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo the_post_thumbnail_url('large'); ?>&description=<?php echo get_the_title(get_the_ID()); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
					<a class="linkedin mb-3 rounded" title="Chia sẻ trên Linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo get_the_title(get_the_ID()); ?>&source=<?php echo site_url();?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>			    
			</div>
	</div>
<?php }
function newsViewMore() {$catID = 1;
	$cf = new WP_Query(array('category' => $catID,'post_status' => 'publish','posts_per_page' => 10, 'meta_key' => 'post_views_count', 'orderby'=> 'meta_value_num', 'order' => 'DESC'));
	$stt = 0;
	$n;
	if( $cf->have_posts() ) {
		echo '<div class="list-news-view mb-3"><h3 class="title-right font-weight-bold text-uppercase mb-3">TIN XEM NHIỀU</h3><div class="list-item">';
		while ($cf->have_posts()) {
			$cf->the_post();
			$n=$stt+1;
			echo '<a title="'. get_the_title() . '" href="'.get_permalink().'" class="item border-top media py-2"><span class="no">'. $n .'</span><span class="name media-body pl-2">'. get_the_title() . '</span></a>';
			$stt++;
		}
		echo '</div></div>';
	}
	wp_reset_postdata();
}
function wpb_widgets_init() {
 
	register_sidebar( array(
			'name' => __( 'Main Sidebar', 'wpb' ),
			'id' => 'sidebar-1',
			'description' => __( 'The main sidebar appears on the right on each page except the front page template', 'wpb' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );

	// register_sidebar( array(
	// 		'name' =>__( 'Front page sidebar', 'wpb'),
	// 		'id' => 'sidebar-2',
	// 		'description' => __( 'Appears on the static front page template', 'wpb' ),
	// 		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 		'after_widget' => '</aside>',
	// 		'before_title' => '<h3 class="widget-title">',
	// 		'after_title' => '</h3>',
	// ) );
}

add_action( 'widgets_init', 'wpb_widgets_init' );

// Start Add metabox
add_action( 'add_meta_boxes', 'create_custom_meta_box' );
if ( ! function_exists( 'create_custom_meta_box' ) ) {
	function create_custom_meta_box()	{
		add_meta_box(
			'custom_product_meta_box',
			__( 'Thông tin thêm sản phẩm', 'cmb' ),
			'add_custom_content_meta_box',
			'product',
			'normal',
			'default'
		);
	}
}
//  Custom metabox content in admin product pages
if ( ! function_exists( 'add_custom_content_meta_box' ) ){
    function add_custom_content_meta_box( $post ){
        $prefix = '_bhww_'; // global $prefix;

        $tskthuat = get_post_meta($post->ID, $prefix.'tskthuat_wysiwyg', true) ? get_post_meta($post->ID, $prefix.'tskthuat_wysiwyg', true) : '';
				$ddnbat = get_post_meta($post->ID, $prefix.'ddnbat_wysiwyg', true) ? get_post_meta($post->ID, $prefix.'ddnbat_wysiwyg', true) : '';

        $args['textarea_rows'] = 6;

        echo '<p><strong>'.__( 'Thông số kỹ thuật', 'cmb' ).'</strong></p>';
        wp_editor( $tskthuat, 'tskthuat_wysiwyg', $args );

				echo '<p><strong>'.__( 'Đặc điểm nổi bật', 'cmb' ).'</strong></p>';
        wp_editor( $ddnbat, 'ddnbat_wysiwyg', $args );

        echo '<input type="hidden" name="custom_product_field_nonce" value="' . wp_create_nonce() . '">';
    }
}
//Save the data of the Meta field
add_action( 'save_post', 'save_custom_content_meta_box', 10, 1 );
if ( ! function_exists( 'save_custom_content_meta_box' ) )
{
    function save_custom_content_meta_box( $post_id ) {
        $prefix = '_bhww_'; // global $prefix;
        // We need to verify this with the proper authorization (security stuff).
        // Check if our nonce is set.
        if ( ! isset( $_POST[ 'custom_product_field_nonce' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'custom_product_field_nonce' ];
        //Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        // Check the user's permissions.
        if ( 'product' == $_POST[ 'post_type' ] ){
            if ( ! current_user_can( 'edit_product', $post_id ) )
                return $post_id;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return $post_id;
        }
        // Sanitize user input and update the meta field in the database.
        update_post_meta( $post_id, $prefix.'tskthuat_wysiwyg', wp_kses_post($_POST[ 'tskthuat_wysiwyg' ]) );
				update_post_meta( $post_id, $prefix.'ddnbat_wysiwyg', wp_kses_post($_POST[ 'ddnbat_wysiwyg' ]) );
    }
}
// End Add metabox

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
  
add_action( 'woocommerce_after_single_product_summary', 'bbloomer_wc_output_long_description', 10 );
  
function bbloomer_wc_output_long_description() {
?>
  <div class="bg-white p-3 mb-4">
		<div class="row">
			<div class="col-lg-8">
				<div class ="description-main content-collapse fix-mh position-relative">			
					<?php wc_get_template( 'single-product/tabs/description.php' ); ?>
					<div class="mb-4 mb-md-5"><?php wc_get_template( 'single-product/tabs/additional-information.php' ); ?></div>
					<div id="btn-view-collap">
						<div class="collap-on">Xem thêm <i class="fa fa-caret-down" style="font-family:'Font Awesome 5 Free' !important"></i></div>
						<div class="collap-hide">Thu gọn <i class="fa fa-caret-up" style="font-family:'Font Awesome 5 Free' !important"></i></div>
					</div>
				</div>
				<div class="my-3 my-md-4 text-center">
					<div class="btn btn-tuvan px-4 px-lg-5" data-toggle="modal" data-target="#modalbaogia">
						<b class="d-block font-weight-bold text-uppercase text-16">Yêu cầu gọi tư vấn trực tiếp</b>
						<span>(Tư vấn viên luôn sẵn sàng phục vụ bạn 24/7)</span>
					</div>
				</div>				
				
				<hr>
				<?php comments_template(); ?>
			</div>
			<div class="col-lg-4 d-none d-lg-block">
				<div class="right-des-product p-2">
					<?php 
						do_action( 'woocommerce_single_product_summary' );
						echo '<div class="text-action border p-2 mb-3"><span>Cam kết sản phẩm <strong style="color: #f90011;">chính hãng 100%</strong>, Sản phẩm được kiểm soát chất lượng bởi các chuyên gia Karofi. Áp dụng cho toàn bộ sản phẩm. <a style="color: #165fe6" target="_blank" rel="nofollow" href="'.get_bloginfo( 'url' ).'/chinh-sach-bao-hanh">Chính sách bảo hành</a> và <a style="color: #165fe6" target="_blank" rel="nofollow" href="'.get_bloginfo( 'url' ).'/chinh-sach-doi-tra-hang">chính sách đổi trả hàng</a></span></div>';
						echo '<ul class="hotline-sale list-unstyled m-0 text-center"><li class="title"><b>Gọi ngay! Sẽ có giá tốt hơn</b></li><li class="sale-item"><span><i class="fas fa-phone-volume red"></i> &nbsp;Hotline: <a href="tel:0936275345" class="track-hotline-sp"><b class="red">0936.275.345</b></a></span></li></ul>';
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- end bg-white -->
<?php }

function productView() {
	global $woocommerce;
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
	$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
	$query_args = array(
		'posts_per_page' => 12, // Hiển thị số lượng sản phẩm đã xem
		'post_status'    => 'publish', 
		'post_type'      => 'product', 
		'post__in'       => $viewed_products, 
		'orderby'        => 'rand'
	);
	$query_args['meta_query'] = array();
	$query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	$r = new WP_Query($query_args);
	if ( $r->have_posts() ) {
		echo '<div class="product-viewed mb-4"> 
			<h2 class="text-20 text-uppercase font-weight-bold">SẢN PHẨM VỪA XEM</h2> 
			<div class="bg-white"><div class="product-list clearfix"><div class="mx-0" slide-viewed>';
				while ( $r->have_posts() ) { $r->the_post();
					wc_get_template_part( 'content', get_post_type());
					//get_template_part( 'template-parts/content', get_post_type() ); // Giao diện hiển thị theo ý bạn muốn
				}
		echo '</div></div></div></div>';
	}
	wp_reset_postdata();
}	

function productViewHome() {
	global $woocommerce;
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
	$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
	$query_args = array(
		'posts_per_page' => 10, // Hiển thị số lượng sản phẩm đã xem
		'post_status'    => 'publish', 
		'post_type'      => 'product', 
		'post__in'       => $viewed_products, 
		'orderby'        => 'rand'
	);
	$query_args['meta_query'] = array();
	$query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	$r = new WP_Query($query_args);
	if ( $r->have_posts() ) {
		echo '<div class="container mb-3"><div class="bg-white"><div class="prod-view wrap-title clearfix"><h2 class="text-uppercase text-center m-0 font-weight-bold title-parent d-flex align-items-center py-2">Sản phẩm đã xem</h2></div><div class="product-list clearfix"><div class="mx-0" slide-viewed>';
				while ( $r->have_posts() ) { $r->the_post();
					global $post, $product; 
				//	wc_get_template_part( 'content', get_post_type());
				echo '<div class="col-6 col-sm-4 col-md-3 col-lg-cs-5 prod-num-1 py-3"><div class="item">
						<a class="d-block img-cat position-relative" href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'img-fluid', 'loading' => 'lazy') ).''. apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ).' </a>
						<a class="d-block" href="'.get_the_permalink().'" title="'.get_the_title().'"><h3 class="title-product-home">'.get_the_title().'</h3></a>
						<div class="wrap-price">'. $product->get_price_html().'</div>
						<div class="txt-promo">'.get_ecommerce_excerpt().'</div>
					</div></div>';				
				}
		echo '</div></div></div></div>';
	}
	wp_reset_postdata();
}	
function get_product_cat($cat_id,$perPage= '20') { 
	$taxonomy = 'product_cat';
	$args_cat = array( 'post_type' => 'product','posts_per_page' =>$perPage,'tax_query' => array(array('taxonomy'=> $taxonomy,'field' => 'term_id','terms' => $cat_id)));
	$getposts = new WP_query($args_cat);
	global $wp_query; $wp_query->in_the_loop = true;
	$term_children = get_term_children($cat_id,$taxonomy);  
	

	if ($getposts->have_posts()) { 
		echo '<div class="container mb-3"><div class="bg-white"><div class="feature-cat wrap-title clearfix">
			<h2 class="text-uppercase text-center m-0 font-weight-bold title-parent d-flex align-items-center"><i class="fas fa-sort-down mr-3"></i>'.get_the_category_by_ID($cat_id).'</h2>';
			if(count($term_children) > 0) { 
				echo '<div class="list-hortial d-flex align-items-center"><ul class="list-inline mb-0 mt-md-2 mr-2">';
				foreach ( $term_children as $child ) {    
					$term = get_term_by('id', $child, $taxonomy);
					echo '<li class="list-inline-item"><a class="d-block py-2 px-2 bg-transparent text-uppercase" href="' . get_term_link( $term->term_id, $taxonomy ) . '" title="'.$term->name.'">'.$term->name.'</a></li>';
				}
				echo '</div></ul>';
			}       
			echo '</div><div class="product-list clearfix"><div class="row mx-0">';        
			while ($getposts->have_posts()) : $getposts->the_post(); 	
				global $post, $product;
					echo '<div class="col-6 col-sm-4 col-md-3 col-lg-cs-5 prod-num-1 py-3"><div class="item">
						<a class="d-block img-cat position-relative" href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail( get_the_id(), 'full', array( 'class' =>'img-fluid' , 'loading' => 'lazy') ).'
						'. apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ).'	</a>
						<a class="d-block" href="'.get_the_permalink().'" title="'.get_the_title().'"><h3 class="title-product-home">'.get_the_title().'</h3></a>
						<div class="wrap-price">'. $product->get_price_html().'</div><div class="txt-promo">'.get_ecommerce_excerpt().'</div></div></div>';					 
			endwhile; 
		echo '</div></div></div></div>';
	}
	wp_reset_postdata();
}

// tắt cập nhật tự động plugin
add_filter( 'auto_update_plugin', '__return_false' );
// tắt tự động cập nhật theme
add_filter( 'auto_update_theme', '__return_false' );

function featureProduct($perpage='6') {
	$tax_featured[] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => 'featured',
		'operator' => 'IN',
	);
	$args_featured = array( 'post_type' => 'product','posts_per_page' => $perpage,'ignore_sticky_posts' => 1, 'tax_query' => $tax_featured);
	$getposts = new WP_query( $args_featured);
	global $wp_query; $wp_query->in_the_loop = true;
	echo '<div class="feature-product product-list clearfix"><div class="row mx-0">';
		while ($getposts->have_posts()) : $getposts->the_post();
			global $post, $product; 
			echo '<div class="col-6 prod-num-1 py-3"><div class="item"><a class="d-block img-cat position-relative" href="'.get_the_permalink().'" title="'.get_the_title().'">
				'.get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'img-fluid', 'loading' => 'lazy') ).'
					'. apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ).'</a>
				<a class="d-block" href="'.get_the_permalink().'" title="'.get_the_title().'"><h3 class="title-product-home">'.get_the_title().'</h3></a>
				<div class="wrap-price">'. $product->get_price_html().'</div>
				<div class="txt-promo">'.get_ecommerce_excerpt().'</div>
			</div></div>';              
		endwhile;
	echo '</div>'; wp_reset_postdata();
}