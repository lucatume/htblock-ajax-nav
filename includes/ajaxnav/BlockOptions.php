<?php
namespace ajaxnav;

    class BlockOptions extends \HeadwayBlockOptionsAPI {

        public $tabs = array(
            'ajaxify-settings' => 'AJAX Settings'
        );

        public $inputs = array(

            'ajaxify-settings' => array(

                'load_from_selector' => array(
                    'type' => 'text',
                    'name' => 'load_from_selector',
                    'label' => 'loadFrom selector',
                    'tooltip' => 'Use jQuery selector syntax here.',
                    'default' => '.block-type-content .block-content'
                ),

                'load_to_selector' => array(
                    'type' => 'text',
                    'name' => 'load_to_selector',
                    'label' => 'loadTo selector',
                    'tooltip' => 'Use jQuery selector syntax here.',
                    'default' => '.block-type-content'
                ),
                'exclude_selector' => array(
                    'type' => 'text',
                    'name' => 'exclude_selector',
                    'label' => 'exclude selector',
                    'tooltip' => 'Use jQuery selector syntax here.',
                    'default' => ''
                ),
                'before_load' => array(
                    'type' => 'textarea',
                    'name' => 'before_load',
                    'label' => 'beforeLoad callback function',
                    'tooltip' => 'Use JavaScript syntax here.',
                    'default' => 'function($context, $contentArea, oldContent){}'
                ),
                'after_load' => array(
                    'type' => 'textarea',
                    'name' => 'after_load',
                    'label' => 'afterLoad callback function',
                    'tooltip' => 'Use JavaScript syntax here.',
                    'default' => 'function($context, $contentArea, newContent){}'
                ),
                'after_fail' => array(
                    'type' => 'textarea',
                    'name' => 'after_fail',
                    'label' => 'afterFail callback function',
                    'tooltip' => 'Use JavaScript syntax here.',
                    'default' => 'function($context, $contentArea, oldContent){}'
                ),
                'ajax_anchor_clicked' => array(
                    'type' => 'textarea',
                    'name' => 'ajax_anchor_clicked',
                    'label' => 'ajaxAnchorClicked callback function',
                    'tooltip' => 'Use JavaScript syntax here.',
                    'default' => 'function(evt){}'
                ),
                'external_anchor_clicked' => array(
                    'type' => 'textarea',
                    'name' => 'external_anchor_clicked',
                    'label' => 'externalAnchorClicked callback function',
                    'tooltip' => 'Use JavaScript syntax here.',
                    'default' => 'function(evt){}'
                ),
                'no_ajax_anchor_clicked' => array(
                    'type' => 'textarea',
                    'name' => 'no_ajax_anchor_clicked',
                    'label' => 'noAjaxAnchorClicked callback function',
                    'tooltip' => 'Use JavaScript syntax here.',
                    'default' => 'function(evt){}'
                ),
            )
        );
    }