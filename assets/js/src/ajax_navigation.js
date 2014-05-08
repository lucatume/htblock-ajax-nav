/*global console, jQuery, $, window, document, ajaxNavMenuOptions, Modernizr*/
/**
 * AJAX Navigation Block
 * http://theaveragedev.com
 *
 * Copyright (c) 2014 theAverageDev (Luca Tumedei)
 * Licensed under the GPLv2+ license.
 */

jQuery(document).ready(function($) {
    // create a default options object
    var defaults = {
        loadFromSelector: '.block-type-content .block-content',
        loadToSelector: '.block-type-content',
        excludeSelector: 'a[href^="#"]'
    }, menu = $('.menu-ajax');
    // bootstrap the plugin on the block 
    menu.each(function() {
        var $this = $(this),
            id = $this.data('block-id'),
            options;
        // grab the specific options object
        options = window['ajaxNavMenuOptions' + id];
        if (!options) {
            options = defaults;
        } else {
            options = $.extend(defaults, options);
        }
        // bootstrap the ajaxifySubmit plugin for this searchform
        $this.ajaxify(options);
    });
});