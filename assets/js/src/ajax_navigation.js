/*global jQuery, $, document, ajaxNavMenuOptions*/
/**
 * AJAX Navigation Block
 * http://theaveragedev.com
 *
 * Copyright (c) 2014 theAverageDev (Luca Tumedei)
 * Licensed under the GPLv2+ license.
 */

jQuery(document).ready(function($) {
    // by default call the jQuery.plugin using the content block
    var options = ajaxNavMenuOptions || {
        loadToSelector: '.block-type-content',
        loadFromSelector: '.block-content'
    };
    $('.menu-ajax').ajaxify(options);
});