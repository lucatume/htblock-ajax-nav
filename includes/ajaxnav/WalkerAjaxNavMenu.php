<?php

namespace ajaxnav;


use tad\wrappers\headway\BlockSettings as Settings;

use brianhaveri\underscore as __;

if (class_exists('Walker_Nav_Menu')) {
    class WalkerAjaxNavMenu extends \Walker_Nav_Menu
    {
        private $settings;
        
        public function __construct($block)
        {
            if ($block) {
                $this->settings = Settings::on($block);
            }
        }
        public function start_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $output.= "\n$indent<div class=\"sub-menu\">\n";
        }
        
        public function end_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $output.= "$indent</div>\n";
        }
        
        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            
            // if the developer so wishes a JSON version of the item can be
            // attached to the menu item itself
            $jsonItemAttribute = '';
            if ($this->settings->attachJsonItem) {
                
                $postType = $item->type;
                $postItem = null;
                $values = array();
                
                // posts and pages will require more fetching
                $toFetch = array('post_type');
                if (in_array($postType, $toFetch)) {
                    $postItem = get_post($item->object_id);
                } else {
                    $postItem = $item;
                }
                if (!$this->settings->jsonItemKeys) {
                    
                    // return all values
                    $values = (array)$postItem;
                } else {
                    $jsonItemKeys = explode(',', $this->settings->jsonItemKeys);
                    foreach ($postItem as $key => $value) {
                        if (in_array($key, $jsonItemKeys)) {
                            $values[$key] = $value;
                        }
                    }
                }
                
                // add a filter here to allow for custom attribute appending
                $values = apply_filters('ajaxnav_menu_item_json_attribute_values', $values, $item);
                $out = json_encode($values, JSON_HEX_QUOT);
                $jsonItemAttribute = sprintf('data-item=\'%s\'', $out);
            }
            
            // set the classes
            $classes = array('menu-item');
            
            // allow hooking to modify classes
            $classes = apply_filters('ajaxnav_menu_item_classes', $classes, $item);
            $indent = str_repeat("\t", $depth);
            
            // set the title and maybe wrap it
            $title = $item->title;
            if ($this->settings->wrapTitle) {
                $titleWrapperClasses = implode(' ', explode(',', $this->settings->wrapTitleClasses));
                $title = sprintf('<span class="%s">%s</span>', $titleWrapperClasses, $item->title);
            }
            
            // if it is a container item
            if ($item->url == '') {
                if (!empty($this->settings->cssMenu)) {
                    
                    // if the theme developer wants to print a CSS-ready menu
                    $groupId = 'g-' . $item->ID;
                    $output.= sprintf('%s<div class="menu-item" id="%s">', $indent, $groupId);
                    $output.= sprintf('%s<a href="#%s" class="openMenu">%s</a>', $indent . $indent, $groupId, $title);
                    $output.= sprintf('%s<a href="#" class="closeMenu">%s</a>', $indent . $indent, $title);
                } else {
                    
                    // if the theme developer wishes to print a plain simple menu
                    $output.= sprintf('%s<div class="menu-item">', $indent);
                    $output.= sprintf('%s<span>%s</span>', $indent . $indent, $title);
                }
            } else {
                
                // it's an element that actually links to something
                // get the linked post ID from the url
                $matches = array();
                preg_match("/\\?(page_id|p)=(\\d*)/uim", $item->url, $matches);
                $dataPostId = '';
                if (isset($matches[2])) {
                    $dataPostId = sprintf('data-post-id="%s"', $matches[2]);
                }
                $output.= sprintf('%s<div class="menu-item" %s %s><a href="%s">%s</a>', $indent, $dataPostId, $jsonItemAttribute, $item->url, $title);
            }
        }
        
        public function end_el(&$output, $item, $depth = 0, $args = array())
        {
            $output.= "</div>\n";
        }
    }
}
