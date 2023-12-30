<?php
require_once get_template_directory().'/class-tgm-plugin-activation.php';
/*
if ( ! function_exists( 'talha_setup' ) ) :
   
    function talha_setup() {
        add_theme_support('widgets-block-editor');
        
    }
    endif; // talha_setup
    add_action( 'after_setup_theme', 'talha_setup' );
/**
 * Register ACF Custom Blocks.
 */
add_action('acf/init', 'my_acf_init');
function my_acf_init() {
    
    // check function exists
    if( function_exists('acf_register_block') ) {
        
        // register a testimonial block
        acf_register_block(array(
            'name'              => 'testimonial',
            'title'             => __('Testimonial'),
            'description'       => __('A custom testimonial block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'testimonial', 'quote' ),
        ));
    }
}
/**
 * Render The ACF block
 */
function my_acf_block_render_callback( $block ) {
    
    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);
    
    // include a template part from within the "template-parts/block" folder
    if( file_exists( get_theme_file_path("/template-parts/block/content-testimonial.php") ) ) {
        include( get_theme_file_path("/template-parts/block/content-testimonial.php") );
    }
}

/**
 * Register Customizer Settings.
 * Required as theme options in assessment, However not required as i'm using a block theme
 */
function talha_customize_register( $wp_customize ) {
	// Do stuff with $wp_customize, the WP_Customize_Manager object.

  }
 
  add_action( 'customize_register', 'talha_customize_register' );
/**
 * TGM ACF Plugin Activation Class
 *
 */

 add_action( 'tgmpa_register', 'talha_register_required_plugins' );

 // This function is called from the above hook
 function talha_register_required_plugins(){
     // The plugins array allows us to define multiple plugins we want to include.
     // The commented out example shows how we can include and activation a bundled
     // plugin zip file in our theme.
     $plugins = array(
       		array(
                'name'               => 'Advanced Custom Fields Pro',
                'slug'               => 'advanced-custom-fields-pro',
                'source'             => get_stylesheet_directory() . '/plugins/advanced-custom-fields-pro.zip',
                'required'           => true,
                'version'            => '',
                'force_activation'   => false, // Force activation because we need advanced custom fields,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
       
            // This below definition will include the ACF plugin from the Wordpress.org plugins repository
            // and if permissions permit, will allow for it to be automatically downloaded and installed.
            // If permissions don't allow, the user will be prompted into downloading the plugin themselves
            // and installing it manually.
           /* array(
                'name' 		=> 'Advanced Custom Fields',
                'slug' 		=> 'advanced-custom-fields',
                'required' 	=> true,
            ),
            */
        );
    
        $theme_text_domain = 'talha';
    
        $config = array(
            'domain'       		=> $theme_text_domain,
            'default_path' 		=> '',
            'parent_menu_slug' 	=> 'themes.php',
            'parent_url_slug' 	=> 'themes.php',
            'menu'         		=> 'install-required-plugins',
            'has_notices'      	=> true,
            'is_automatic'    	=> false,
            'message' 			=> '',
            'strings'      		=> array(
                'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
                'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
                'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
                'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
                'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
                'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
                'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
                'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
                'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
                'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
                'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
                'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );
    
        tgmpa( $plugins, $config );
    
}