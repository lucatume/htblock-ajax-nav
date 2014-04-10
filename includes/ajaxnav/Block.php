<?php
namespace ajaxnav;

class Block extends \HeadwayBlockAPI {

    public $id = 'ajaxnav';
    public $name = 'AJAX Nav Block';
    public $options_class = '\ajaxnav\BlockOptions';
    public $description = 'Adds an AJAX-based navigation block to Headway visual theme editor';

    // public static function init_action($block_id, $block) 
    // {

    // }


    public static function enqueue_action($block_id, $block, $original_block = null)
    {
        // enqueue the block style
        wp_enqueue_style( 
            'ajaxnav', 
            AJAXNAV_BLOCK_URL . 'assets/css/ajax_nav_block.css'
            );
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
            $args = array(
                'theme_location' => 'navigation_block_2',
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