<?php
namespace ajaxnav;

class BlockOptions extends \HeadwayBlockOptionsAPI {

    public $tabs = array(
        'ajaxify-settings' => 'AJAX Settings',
        'style-settings' => 'Styling',
        'markup-settings' => 'Output markup',
        'data-settings' => 'Data attributes'
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
                'notice' => 'Use jQuery selectors syntax here, e.g. "#someSelector > .someOtherSelector"'
                ),

            'load_from_selector' => array(
                'type' => 'textarea',
                'name' => 'load_from_selector',
                'label' => 'loadFrom selector',
                'tooltip' => 'This selector and its content will be loaded in the destination.',
                'default' => '.block-type-content .block-content'
                ),

            'load_to_selector' => array(
                'type' => 'textarea',
                'name' => 'load_to_selector',
                'label' => 'loadTo selector',
                'tooltip' => 'This selector will have its content replaced with the new one.',
                'default' => '.block-type-content'
                ),
            'exclude_selector' => array(
                'type' => 'textarea',
                'name' => 'exclude_selector',
                'label' => 'exclude selector',
                'tooltip' => 'Anchor tags matching this selector will not be AJAX-powered and will fallback to default behavior.',
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
                'notice' => 'The block will allow callback functions to be called during its execution. Use JavaScript syntax here, jQuery is available'
                ),
            'use_callbacks'  => array(
                'type' => 'checkbox',
                'name' => 'use_callbacks',
                'label' => 'Use callback functions',
                'default' => 'true',
                'toggle' => array(
                    'true' => array(
                        'show' => array('#input-before_load', '#input-after_load', '#input-after_fail', '#input-ajax_anchor_clicked', '#input-external_anchor_clicked', '#input-excluded_clicked')
                        ),
                    'false' => array(
                        'hide' => array('#input-before_load', '#input-after_load', '#input-after_fail', '#input-ajax_anchor_clicked', '#input-external_anchor_clicked', '#input-excluded_clicked')
                        )
                    )
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
            'excluded_clicked' => array(
                'type' => 'textarea',
                'name' => 'excluded_clicked',
                'label' => 'noAjaxAnchorClicked callback function',
                'tooltip' => 'An internal link explicitly excluded (see above) has been clicked.',
                'default' => 'function(evt){}'
                ),
            'events-title' => array(
                'type' => 'heading',
                'name' => 'events-title',
                'label' => 'Events'
                ),

            'events-notice' => array(
                'type' => 'notice',
                'name' => 'events-notice',
                'notice' => 'The block can raise events on the <code>.menu-ajax</code> object if you so choose.
                The events the block will raise are:
                <ul>
                    <li><str>ajaxAnchorClicked</str> - raised any time an internal and not excluded link is clicked</li>
                    <li><str>beforeLoad</str> - raised before attempting to load new content into the page</li>
                    <li><str>afterLoad</str> - raised after new content has been successflily loaded into the page</li>
                    <li><str>afterFail</str> - raised when loading of new content has failed</li>
                    <li><str>externalAnchorClicked</str> - raised any time an anchor tag linking to an external resource is clicked</li>
                    <li><str>excludedClicked</str> - raised any time an anchor tag excluded from <em>ajaxification</em> is clicked</li>
                </ul>
                '
                ),
'raise_events' => array(
    'type' => 'checkbox',
    'name' => 'raise_events',
    'label' => 'Raise events',
    'default' => 'true',
    'toggle' => array(
        'true' => array('show'=>array('#input-events_description')),
        'false' => array('hide'=>array('#input-events_description'))
        )
    )
),
'style-settings' => array(
    'queue_default_style' => array(
        'type' => 'checkbox',
        'name' => 'queue_default_style',
        'label' => 'Use default menu style',
        'default' => 'true'
        ),
    'markup-settings' => array(
        'css_menu' => array(
            'type' => 'checkbox',
            'name' => 'css_menu',
            'label' => 'Generate a CSS animatable menu',
            'tooltip' => 'Animation is done via CSS and not JS, using JS later might prove difficult.',
            'default' => 'false'
            )
        )
    ),
'data-settings' => array(
    'attach_json_item' => array(
        'type' => 'checkbox',
        'name' => 'attach_json_item',
        'default' => 'false',
        'label' => 'Attach JSON encoded item to the menu-item element',
        'toggle' => array(
            'true' =>array('show'=>array('#input-json_item_keys')),
            'false' => array('hide' => array('#input-json_item_keys'))
            )
        ),
    'json_item_keys' => array(
        'type' => 'textarea',
        'name' => 'json_item_keys',
        'default' => '',
        'label' => 'Keys',
        'tooltip' => 'A comma separated list of properties to attach to the data-item attribute'
        ),
'json-item-keys-notice' => array(
    'type' => 'notice',
    'name' => 'json-item-keys-notice',
    'notice' => 'Here are the keys that can be attached to a menu item:
    \'ID\', \'post_author\', \'post_date\', \'post_date_gmt\', \'post_content\', \'post_title\', \'post_excerpt\'post_status\', \'comment_status\', \'ping_status\', \'post_password\'post_name\', \'to_ping\', \'pinged\', \'post_modified\', \'post_modified_gmt\', \'post_content_filtered\', \'post_parent\', \'guid\', \'menu_order\', \'post_type\', \'post_mime_type\', \'comment_count\', \'filter\', \'db_id\', \'menu_item_parent\', \'object_id\', \'object\', \'type\', \'type_label\', \'url\', \'title\', \'target\', \'attr_title\', \'description\', \'classes\', \'xfn\', \'current\', \'current_item_ancestor\', \'current_item_parent\''
    )
    ),

);
}
?>
