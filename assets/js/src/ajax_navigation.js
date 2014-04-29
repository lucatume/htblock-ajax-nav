/*global jQuery, $, document, console, Spinner*/
/**
 * AJAX Navigation Block
 * http://theaveragedev.com
 *
 * Copyright (c) 2014 theAverageDev (Luca Tumedei)
 * Licensed under the GPLv2+ license.
 */

jQuery(document).ready(function($) {
    $('.menu-ajax').ajaxify({
        loadToSelector: '.theContent',
        loadFromSelector: '.block-type-content .block-content'
    });
});