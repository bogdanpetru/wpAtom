<?php
/*=======================================
=            Require Plugins            =
=======================================*/

/*----------  Include MGT Plugin Activation  ----------*/

add_action( 'init', 'wpAtom_include_tgm_plugin_activation', 9999 );
function wpAtom_include_tgm_plugin_activation() {
}
  require_once( 'plugins/TGMPluginActivation/class-tgm-plugin-activation.php' );


add_action( 'tgmpa_register', 'wpAtom_register_required_plugins' );


function wpAtom_register_required_plugins() {

  $plugins = array(

    array(
      'name'      => 'Contact Form 7',
      'slug'      => 'contact-form-7',
      'required'  => false,
    ),

    array(
      'name'      => 'Cmb2',
      'slug'      => 'cmb2',
      'required'  => true,
    ),

    array(
      'name'      => 'Redux Framework',
      'slug'      => 'redux-framework',
      'required'  => true,
    ),
    
    array(
      'name'      => 'Redux Developer Mode Disabler',
      'slug'      => 'redux-developer-mode-disabler',
      'required'  => true,
    ),    

    array(
      'name'      => 'Yoast SEO',
      'slug'      => 'wordpress-seo',
      'required'  => false,
    ),    

    array(
      'name'      => 'Disable Emojis',
      'slug'      => 'disable-emojis',
      'required'  => false,
    ),



  );

  $config = array(
    'default_path' => '',                      // Default absolute path to pre-packaged plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
    'strings'      => array(
      'page_title'                      => __( 'Install Required Plugins', 'charity-wpl' ),
      'menu_title'                      => __( 'Install Plugins', 'charity-wpl' ),
      'installing'                      => __( 'Installing Plugin: %s', 'charity-wpl' ), // %s = plugin name.
      'oops'                            => __( 'Something went wrong with the plugin API.', 'charity-wpl' ),
      'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' , 'charity-wpl'), // %1$s = plugin name(s).
      'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' , 'charity-wpl'), // %1$s = plugin name(s).
      'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' , 'charity-wpl'), // %1$s = plugin name(s).
      'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' , 'charity-wpl'), // %1$s = plugin name(s).
      'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' , 'charity-wpl'), // %1$s = plugin name(s).
      'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' , 'charity-wpl'), // %1$s = plugin name(s).
      'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'charity-wpl'), // %1$s = plugin name(s).
      'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'charity-wpl'), // %1$s = plugin name(s).
      'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'charity-wpl'),
      'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' , 'charity-wpl'),
      'return'                          => __( 'Return to Required Plugins Installer', 'charity-wpl' ),
      'plugin_activated'                => __( 'Plugin activated successfully.', 'charity-wpl' ),
      'complete'                        => __( 'All plugins installed and activated successfully. %s', 'charity-wpl' ), // %s = dashboard link.
      'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
    )
  );

  tgmpa( $plugins, $config );
}
