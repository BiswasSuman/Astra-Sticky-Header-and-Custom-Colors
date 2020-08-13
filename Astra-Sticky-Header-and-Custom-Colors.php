<?php

/**
* @package ExpCustomizeAPI
* 
* Plugin Name: Astra Sticky Header & Custom Colors
* Plugin URI: https://techghar.net/
* Description: Experiment With Customize API
* Author: Suman Biswas
* Author URI: https://techghar.net/
* Text Domain: ashcc
* Version: 0.0.1
* 
*/


function tg_customize_register( $wp_customize )
{
  
  $wp_customize->add_panel( 'sticky_header_and_custom_colors', array(
    'title' => __( 'Sticky Header & Custom Colors' ),
    'description' => __( 'Adjust your Header and Navigation sections.' )
    )
  );
  
  
  $wp_customize->add_section('ashcc_custom_color', array(
    'title' => 'Customize Colors',
    'panel' => 'sticky_header_and_custom_colors'
  ));


  $available_control = array(
    array(
      'id' => 'ashcc_main_header_bar_bg',
      'title' => 'Main Header Bar Background',
      'default' => '#ffffff'
    ),
    array(
      'id' => 'ashcc_menu_link',
      'title' => 'Link Color',
      'default' => '#3a3a3a'
    ),
    array(
      'id' => 'ashcc_menu_link_hover',
      'title' => 'Hover Link Color',
      'default' => '#0274be'
    ),
    array(
      'id' => 'ashcc_dropdown_arrow',
      'title' => 'Dropdown Arrow Color',
      'default' => '#3a3a3a'
    ),
    array(
      'id' => 'ashcc_menu_item_border',
      'title' => 'Border Around Menu Item',
      'default' => '#eaeaea'
    ),
    array(
      'id' => 'ashcc_dropdown_toggle_btn',
      'title' => 'Dropdown Toggle Button',
      'default' => '#0274be'
    ),
    array(
      'id' => 'ashcc_sub_menu_top_border',
      'title' => 'Dropdown or Sub Menu Top border',
      'default' => '#0274be'
    ),
  );


  foreach ($available_control as $control) {

    $wp_customize->add_setting($control['id'], array(
      'default' => $control['default'],
      'transport' => 'refresh'
    ));
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $control['id'] . '_control', array(
      'label' => $control['title'],
      'section' => 'ashcc_custom_color',
      'settings' => $control['id']
    )));

  }
  
  
  
}

add_action('customize_register', 'tg_customize_register' );


function tg_ashcc_print_style()
{
  ?>
  <!-- Astra Sticky Header & Custom Colors -->
  <!-- http://techghar.net/ -->
  <style type="text/css"> 

    .main-header-bar,
    ul.sub-menu,
    .ast-header-break-point .main-header-bar .main-header-bar-navigation .main-header-menu{ background: <?=get_theme_mod('ashcc_main_header_bar_bg')?>!important; }
    /** Menu link */
    .main-header-menu .menu-link, .ast-header-custom-item a {
      color: <?=get_theme_mod('ashcc_menu_link')?>;
    }
    /** Hover Menu link */
    .main-header-menu .menu-item:hover > .menu-link,
    .main-header-menu .menu-item:hover > .ast-menu-toggle,
    .main-header-menu .ast-masthead-custom-menu-items a:hover,
    .main-header-menu .menu-item.focus > .menu-link, .main-header-menu .menu-item.focus > .ast-menu-toggle,
    .main-header-menu .current-menu-item > .menu-link,
    .main-header-menu .current-menu-ancestor > .menu-link,
    .main-header-menu .current-menu-item > .ast-menu-toggle,
    .main-header-menu .current-menu-ancestor > .ast-menu-toggle
    {
      color: <?=get_theme_mod('ashcc_menu_link_hover')?>;
    }

    /** Sub Menu Top border */ 
    .ast-desktop .main-header-menu.submenu-with-border .sub-menu, .ast-desktop .main-header-menu.submenu-with-border .astra-full-megamenu-wrapper {
      border-color: <?=get_theme_mod('ashcc_sub_menu_top_border')?>;
    }

   /** Dropdown toggle button */
    .ast-header-break-point .ast-mobile-menu-buttons-minimal.menu-toggle {
      color: <?=get_theme_mod('ashcc_dropdown_toggle_btn')?>;
    }

    /** Border Around Menu Item */
    .ast-desktop .main-header-menu.submenu-with-border .sub-menu .menu-link,
    .ast-desktop .main-header-menu.submenu-with-border .children .menu-link,
    .ast-header-break-point .main-navigation ul .menu-item .menu-link

    { border-color: <?=get_theme_mod('ashcc_menu_item_border')?>; }

    .ast-header-break-point .main-header-bar .main-header-bar-navigation .menu-item-has-children>.ast-menu-toggle::before { color: <?=get_theme_mod('ashcc_dropdown_arrow')?>; }

  </style>
  
  <?php
}
add_action('wp_head', 'tg_ashcc_print_style' );


