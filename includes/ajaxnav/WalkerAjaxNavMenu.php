<?php
namespace ajaxnav;

if (class_exists('Walker_Nav_Menu')) {
    class WalkerAjaxNavMenu extends \Walker_Nav_Menu
    {
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
            $indent = str_repeat("\t", $depth);
            // if it is a container item
            if ($item->url == '') {
                $groupId = 'g-' . $item->ID;
                $groupName = $item->title;
                $output .= sprintf('%s<div class="menu-item" id="%s">', $indent, $groupId);
                $output .= sprintf('%s<a href="#%s" class="openMenu">%s</a>', $indent . $indent, $groupId, $groupName);
                $output .= sprintf('%s<a href="#" class="closeMenu">%s</a>', $indent . $indent, $groupName);
            } else {
                // it's an element that actually links to something
                // get the linked post ID from the url
                $matches = array();
                preg_match("/\\?(page_id|p)=(\\d*)/uim", $item->url, &$matches);
                $dataPostId = '';
                if (isset($matches[2])) {
                    $dataPostId = sprintf('data-post-id="%s"', $matches[2]);
                }
                $output .= sprintf('%s<div class="menu-item" %s><a href="%s">%s</a>', $indent, $dataPostId, $item->url, $item->title);
            }
        }

        public function end_el(&$output, $item, $depth = 0, $args = array()) {
            $output .= "</div>\n";
        }
    }
}