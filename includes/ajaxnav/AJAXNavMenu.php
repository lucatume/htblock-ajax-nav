<?php
namespace ajaxnav;

use tad\wrappers\headway\BlockSettings;
use tad\adapters\Functions;

class AJAXNavMenu
{
    protected $functions;

    public function __construct($themeLocation = '', $block = null, \tad\interfaces\FunctionsAdapter $functions = null)
    {
        if (!is_string($themeLocation)) {
            throw new \BadMethodCallException("Theme location must be a string.", 1);
        }
        if (is_null($functions)) {
            $functions = new Functions();
        }
        $this->functions = $functions;
        $this->themeLocation = $themeLocation;
        if ($block) {
            $this->block = $block;
        }
    }
    public static function on($themeLocation = '', $block = null)
    {
        return new self($themeLocation, $block);
    }
    public function show()
    {
        $args = array(
            'theme_location' => $this->themeLocation,
            'menu' => '',
            'container' => 'nav',
            'container_class' => '',
            'container_id' => '',
            'menu_class' => 'menu-ajax',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<div class = "menu-ajax">%3$s</div>',
            'depth' => 2,
            'walker' => new \ajaxnav\WalkerAjaxNavMenu($this->block)
            );

        $this->functions->wp_nav_menu( $args );
    }
}
