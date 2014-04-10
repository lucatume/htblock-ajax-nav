<?php
namespace ajaxnav;

class AJAXNavMenu
{
    public function __construct($themeLocation = '')
    {
        if (!is_string($themeLocation)) {
            throw new \BadMethodCallException("Theme location must be a string.", 1);
        }
        $this->themeLocation = $themeLocation;
    }
    public static function on($themeLocation = '')
    {
        return new self($themeLocation);
    }
    public function show()
    {
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
     wp_nav_menu( $args );
 }
}
