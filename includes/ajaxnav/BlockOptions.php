<?php
namespace ajaxnav;

    class BlockOptions extends \HeadwayBlockOptionsAPI {

        public $tabs = array(
            'ajaxify-settings' => 'AJAX Settings'
        );

        public $inputs = array(

            'ajaxify-settings' => array(

                'selectors-title' => array(
                    'type' => 'heading',
                    'name' => 'selectors-title',
                    'label' => 'Content Selectors'
                    ),

                'selectors-notice' => array(
                    'type' => 'notice',
                    'name' => 'selectors-notice',
                    'notice' => 'Use jQuery selector syntax here, e.g. "#someSelector > .someOtherSelector"'
                    ),

                'load_from_selector' => array(
                    'type' => 'text',
                    'name' => 'load_from_selector',
                    'label' => 'loadFrom selector',
                    'tooltip' => 'This selector and its content will be loaded in the destination.',
                    'default' => '.block-type-content .block-content'
                ),

                'load_to_selector' => array(
                    'type' => 'text',
                    'name' => 'load_to_selector',
                    'label' => 'loadTo selector',
                    'tooltip' => 'This selector will have its content replaced with the new one.',
                    'default' => '.block-type-content'
                ),
                'exclude_selector' => array(
                    'type' => 'text',
                    'name' => 'exclude_selector',
                    'label' => 'Anchor tags matching this selector will not AJAX-powered and will fallback to default behavior.',
                    'tooltip' => 'Use jQuery selector syntax here.',
                    'default' => ''
                ),

                'callbacks-title' => array(
                    'type' => 'heading',
                    'name' => 'callbacks-title',
                    'label' => 'Callback functions'
                    ),

                'callbacks-notice' => array(
                    'type' => 'notice',
                    'name' => 'callbacks-notice',
                    'notice' => 'The block will allow callback functions to be called during its execution. Use JavaScript syntaxt here, jQuery is available'
                    ),

                'before_load' => array(
                    'type' => 'textarea',
                    'name' => 'before_load',
                    'label' => 'beforeLoad callback function',
                    'tooltip' => 'An internal link has been clicked, do something before new content is loaded.',
                    'default' => 'function($context, $contentArea, oldContent){}'
                ),
                'after_load' => array(
                    'type' => 'textarea',
                    'name' => 'after_load',
                    'label' => 'afterLoad callback function',
                    'tooltip' => 'An internal link has been clicked and the new content has been loaded.',
                    'default' => 'function($context, $contentArea, newContent){}'
                ),
                'after_fail' => array(
                    'type' => 'textarea',
                    'name' => 'after_fail',
                    'label' => 'afterFail callback function',
                    'tooltip' => 'An internal link has been clicked but the content failed to load.',
                    'default' => 'function($context, $contentArea, oldContent){}'
                ),
                'ajax_anchor_clicked' => array(
                    'type' => 'textarea',
                    'name' => 'ajax_anchor_clicked',
                    'label' => 'ajaxAnchorClicked callback function',
                    'tooltip' => 'An AJAX-enabled link has been clicked.',
                    'default' => 'function(evt){}'
                ),
                'external_anchor_clicked' => array(
                    'type' => 'textarea',
                    'name' => 'external_anchor_clicked',
                    'label' => 'externalAnchorClicked callback function',
                    'tooltip' => 'An external link has been clicked.',
                    'default' => 'function(evt){}'
                ),
                'no_ajax_anchor_clicked' => array(
                    'type' => 'textarea',
                    'name' => 'no_ajax_anchor_clicked',
                    'label' => 'noAjaxAnchorClicked callback function',
                    'tooltip' => 'An internal link explicitly excluded (see above) has been clicked.',
                    'default' => 'function(evt){}'
                ),
            )
        );
    }