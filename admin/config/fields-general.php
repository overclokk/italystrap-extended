<?php
declare(strict_types=1);

namespace ItalyStrap;

use ItalyStrap\Core;
$beta = ' {{BETA VERSION}}';

return [
	[
		'label'			=> \__( 'Activate advanced options', 'italystrap' ) . $beta,
		'desc'			=> \__( 'If you want to have more advanced options to control', 'italystrap' ),
		'id'			=> 'activate_advanced',
//		'type'			=> 'checkbox',
		'type'			=> 'hidden',
		'class'			=> 'activate_advanced easy hidden',
		'value'			=> '1',
		'sanitize'		=> 'sanitize_text_field',
	],
	[
		'label'			=> \__( 'Show Post Type IDs', 'italystrap' ),
		'desc'			=> \__( 'Post type edit screen: show post/page IDS', 'italystrap' ),
		'id'			=> 'show-ids',
		'type'			=> 'checkbox',
		'class'			=> 'show-ids easy',
		'value'			=> '',
		'sanitize'		=> 'sanitize_text_field',
	],
	[
		'label'			=> \__( 'Show the Post Type Thumbnail', 'italystrap' ),
		'desc'			=> \__( 'Post type edit screen: show post/page thumbnail', 'italystrap' ),
		'id'			=> 'show-thumb',
		'type'			=> 'checkbox',
		'class'			=> 'show-thumb easy',
		'value'			=> '',
		'sanitize'		=> 'sanitize_text_field',
	],
	[
		'label'			=> \__( 'Kill the Emojis', 'italystrap' ),
		'desc'			=> \__( 'Avoid loading Emojis support if your does not need it to speed up the website.', 'italystrap' ),
		'id'			=> 'kill-emojis',
		'type'			=> 'checkbox',
		'class'			=> 'kill-emojis easy',
		'value'			=> 'on',
		'sanitize'		=> 'sanitize_text_field',
	],
	[
		'label'			=> \__( 'Activate Social Sharing Button', 'italystrap' ) . $beta,
		'desc'			=> \__( 'This are a simple social sharing links', 'italystrap' ),
		'id'			=> 'activate_social_share',
		'type'			=> 'checkbox',
		'class'			=> 'activate_social_share easy',
		'value'			=> '',
		// 'validate'	=> 'ctype_alpha',
		'sanitize'		=> 'sanitize_text_field',
		'show_on'		=> Core\is_beta(),
	],
	[
		'label'			=> \__( 'Social Sharing Button position', 'italystrap' ),
		'desc'			=> \__( 'Select the position to display buttons', 'italystrap' ) . $beta,
		'id'			=> 'social_button_position',
		'type'			=> 'select',
		'options'		=> [
			'before'	=> \__( 'Before the content', 'italystrap' ),
			'after'		=> \__( 'After the content', 'italystrap' ),
			'both'		=> \__( 'Before and after the content', 'italystrap' ),
		],
		'class'			=> 'social_button_position easy',
		'value'			=> 'after',
		'sanitize'		=> 'sanitize_text_field',
		'show_on'		=> Core\is_beta(),
	],
	[
		'label'			=> \__( 'Display Social Sharing on', 'italystrap' ),
		'desc'			=> \__( 'Select the post types to display buttons', 'italystrap' ) . $beta,
		'id'			=> 'social_button_on_post_types',
		'type'			=> 'checkbox',
		'options'		=> (array) \get_post_types( [ 'public'   => true, ] ),
		'class'			=> 'widefat post_types social_button_position easy',
		'value'			=> 'post',
		'sanitize'		=> 'sanitize_select_multiple',
		'show_on'		=> Core\is_beta(),
	],
	[
		'label'			=> \__( 'Google API Key', 'italystrap' ),
		'desc'			=> \__( 'Insert here the google API key.', 'italystrap' ) . $beta,
		'id'			=> 'google_api_key',
		'type'			=> 'text',
		'class'			=> 'google_api_key easy',
		'value'			=> '',
		'sanitize'		=> 'sanitize_text_field',
		'show_on'		=> Core\is_beta(),
	],
	[
		'label'			=> \__( 'Web font Loading', 'italystrap' ) . $beta,
		'desc'			=> \__( 'Activate it for using the web fonts loader (lazyload for the web fonts), then you have to go to the <strong>customizer</strong> and select the font, weight and subsets you want to use in this site, then in the customizer below the selected font you can add in the dedicated text input the HTML tags or CSS selector you want to bind to the font selected, all separated by comma. Example: <code>body</code> or <code>h1</code> or <code>h1,h2,h3,h4,h5,h6</code> or <code>.widget-title</code>. Otherwise you can add some css to the Custom CSS area of this plugin (Settings > Style > Custom CSS) or in your style.css like this:
						<br>
						<pre>.fonts-loaded body{ font-family: "Open Sans"; }<br>.fonts-loaded h1{ font-family: "Lato"; }</pre>', 'italystrap' ),
		'id'			=> 'web_font_loading',
		'type'			=> 'checkbox',
		'class'			=> 'web_font_loading hard',
		'value'			=> '',
		'sanitize'		=> 'sanitize_text_field',
		'show_on'		=> Core\is_beta(),
	],
	[
		'label'			=> \__( 'Display visual editor on term page', 'italystrap' ),
		'desc'			=> \__( '(Cats, Tags and Custom terms)', 'italystrap' ),
		'id'			=> 'visual_editor_on_terms',
		'type'			=> 'checkbox',
		'class'			=> 'visual_editor_on_terms easy',
		'value'			=> '',
		'sanitize'		=> 'sanitize_text_field',
	],
	[
		'label'			=> \__( 'Show Theme Hooks', 'italystrap' ),
		'desc'			=> \__( 'Only for ItalyStrap theme framework. This is only for getting a visual of the ItalyStrap theme framework hooks registered.', 'italystrap' ),
		'id'			=> 'show_theme_hooks',
		'type'			=> 'checkbox',
		'class'			=> 'show_theme_hooks easy',
		'value'			=> '',
		'sanitize'		=> 'sanitize_text_field',
		'show_on'		=> Core\is_italystrap_active(),
	],
	[
		'label'			=> \__( 'Show Hooked callable', 'italystrap' ),
		'desc'			=> \__( 'This will show callable with hook.', 'italystrap' ),
		'id'			=> 'show_hooked_callable',
		'type'			=> 'checkbox',
		'class'			=> 'show_hooked_callable easy',
		'value'			=> '',
		'sanitize'		=> 'sanitize_text_field',
		'show_on'		=> Core\is_italystrap_active(),
	],
	[
		'label'			=> \__( 'Cache the menu output', 'italystrap' ) . $beta,
		'desc'			=> \__( 'This will put in cache the menu output only if server cache is active.', 'italystrap' ),
		'id'			=> 'menu_cache',
		'type'			=> 'checkbox',
		'class'			=> 'menu_cache easy',
		'value'			=> '1',
		'sanitize'		=> 'sanitize_text_field',
		'show_on'		=> Core\is_beta(),
	],
];
