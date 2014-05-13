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
            $output .= "\n$indent<div class=\"sub-menu\">\n";
        }

        public function end_lvl( &$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</div>\n";
        }

        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            // if the developer so wishes a JSON version of the item can be
            // attached to the menu item itself
            $jsonItemAttribute = '';
            if ($this->settings->attachJsonItem) {
                $values = array();
                if (!$this->settings->jsonItemKeys) {
                    // return all values
                    $values = (array)$item;
                } else {
                    $jsonItemKeys = explode(',', $this->settings->jsonItemKeys);
                    foreach ($item as $key => $value) {
                        if (in_array($key, $jsonItemKeys)) {
                            $values[$key] = $value;
                        }
                    }
                }
                $out = json_encode($values);
                $jsonItemAttribute = sprintf('data-item=\'%s\'', $out);
            }
            $indent = str_repeat("\t", $depth);
            // if it is a container item
            if ($item->url == '') {
                $groupName = $item->title;
                if (!empty($this->settings->cssMenu)) {
                    // if the theme developer wants to print a CSS-ready menu
                    $groupId = 'g-' . $item->ID;
                    $output .= sprintf('%s<div class="menu-item" id="%s" %s>', $indent, $groupId, $jsonItemAttribute);
                    $output .= sprintf('%s<a href="#%s" class="openMenu">%s</a>', $indent . $indent, $groupId, $groupName);
                    $output .= sprintf('%s<a href="#" class="closeMenu">%s</a>', $indent . $indent, $groupName);
                } else {
                    // if the theme developer wishes to print a plain simple menu
                    $output .= sprintf('%s<div class="menu-item" %s>', $indent, $jsonItemAttribute);
                    $output .= sprintf('%s<span>%s</span>', $indent . $indent, $groupName);
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
                $output .= sprintf('%s<div class="menu-item" %s %s><a href="%s">%s</a>', $indent, $dataPostId, $jsonItemAttribute, $item->url, $item->title);
            }
        }

        public function end_el(&$output, $item, $depth = 0, $args = array()) {
            $output .= "</div>\n";
        }
    }
}