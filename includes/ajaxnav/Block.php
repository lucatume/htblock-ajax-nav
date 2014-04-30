<?php
namespace ajaxnav;

use ajaxnav\AJAXNavMenu;
use tad\wrappers\headway\BlockSettings as Settings;
use tad\utils\Script;
use tad\utils\JsObject;

class Block extends \HeadwayBlockAPI {

    public $id = 'ajaxnav';
    public $name = 'AJAX Nav Block';
    public $options_class = '\ajaxnav\BlockOptions';
    public $description = 'Adds an AJAX-based navigation block to Headway visual theme editor';

    public static function init_action($block_id, $block) 
    {
        // register the nav menu with the theme
        // blatant copy of the default navigation block
        $name = \HeadwayBlocksData::get_block_name($block) . ' &mdash; ' . 'Layout: ' . \HeadwayLayout::get_name($block['layout']);
        register_nav_menu('navigation_block_' . $block_id, $name);
    }


    public static function enqueue_action($block_id, $block, $original_block = null)
    {
        $handle = 'ajaxnav';
        $src = Script::suffix(AJAXNAV_URL . 'assets/js/ajax_navigation.js');
        $deps = array('jquery', 'jquery-ajaxify');
        wp_enqueue_script($handle, $src, $deps);
        // retrieve this block settings
        if ($original_block) {
            $block = $original_block;
        }
        // settings for the block will be stored in the $settings->data key/value
        // array
        $settings = new Settings($block);
        wp_localize_script($handle, 'ajaxNavMenuOptions', $settings->data);
    }


    // public static function dynamic_css($block_id, $block, $original_block = null)
    // {

    // }


    // public static function dynamic_js($block_id, $block, $original_block = null)
    // {

    // }

    // public function setup_elements() {
    //     $this->register_block_element(array(
    //         'id' => 'element1-id',
    //         'name' => 'Element 1 Name',
    //         'selector' => '.my-selector1',
    //         'properties' => array('property1', 'property2', 'property3'),
    //         'states' => array(
    //             'Selected' => '.my-selector1.selected',
    //             'Hover' => '.my-selector1:hover',
    //             'Clicked' => '.my-selector1:active'
    //             )
    //         ));
    // }

    public function content($block) {
        $themeLocation = 'navigation_block_' . $block['id'];
        AJAXNavMenu::on($themeLocation)->show();
    }
}