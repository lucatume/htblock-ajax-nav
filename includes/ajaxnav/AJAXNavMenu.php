<?php
namespace ajaxnav;

use tad\adapters\Functions;

class AJAXNavMenu
{
    protected $functions;

    public function __construct($themeLocation = '', \tad\interfaces\FunctionsAdapter $functions = null)
    {
        if (!is_string($themeLocation)) {
            throw new \BadMethodCallException("Theme location must be a string.", 1);
        }
        if (is_null($functions)) {
            $functions = new Functions();
        }
        $this->functions = $functions;
        $this->themeLocation = $themeLocation;
    }
    public static function on($themeLocation = '')
    {
        return new self($themeLocation);
    }
    public function show()
    {
        // enqueue the style for the menu
        wp_enqueue_style( 
            'ajaxnav', 
            AJAXNAV_URL . 'assets/css/ajax_navigation.css'
            );

        $args = array(
            'theme_location' => $this->themeLocation,
            'menu' => '',
            'container' => 'nav',
            'container_class' => 'menu-ajax-container',
            'container_id' => '',
            'menu_class' => 'menu',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
            'depth' => 2,
            'walker' => ''
            );

        $this->functions->wp_nav_menu( $args );
    }
}
