/*global jQuery, $, document, console, Spinner*/
/**
 * AJAX Navigation Block
 * http://theaveragedev.com
 *
 * Copyright (c) 2014 theAverageDev (Luca Tumedei)
 * Licensed under the GPLv2+ license.
 */

jQuery(document).ready(function($) {
    // cache the content area that will be filled with content
    // :urlInternal selector from Ben Alman's urlInternal jQuery library
    var $contentArea = $('.theContent.block-type-content .block-content'),
        $anchors = $('.menu-ajax a:not(.openMenu,.closeMenu)').filter(':urlInternal');
    // all the anchor tags save for the ones used in the menu
    // should pull content via AJAX
    $anchors.on('click', function(ev) {
        // cache the clicked anchor
        var $this = $(this),
            url = '',
            spinner = new Spinner().spin();
        // do not follow the link
        ev.preventDefault();
        // get the linked url
        url = $this.attr('href');
        // set the spinner
        spinner.el.style.top = '50%';
        spinner.el.style.left = '50%';
        // fade the content area and append the spinner in its place
        $contentArea.fadeOut().parent().append(spinner.el);
        // spinner = new Spinner().spin($contentArea.)
        $contentArea.load(url + ' .theContent', function(data) {
            // stop the spinner
            spinner.stop();
            // fade in the new content
            $contentArea.fadeIn('fast');
        });
    });
});