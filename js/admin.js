/**
 * admin.js
 *
 * used in theme options panel
 * @package NewsPlus
 * @since 1.0.0
 * @version 3.0
 */

// Tabs in Theme Options
jQuery(document).ready(function ($) {
    $('.tabbed').hide();
    $('.nav-tab-wrapper a:first').addClass('nav-tab-active');
    $('.tabbed:first').show();
    $('.nav-tab-wrapper > a').click(function () {
        $('.nav-tab-wrapper > a').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('.tabbed').hide();
        var currentTab = $(this).attr('href');
        $(currentTab).show();
        return false;
    });
});


// Media uploader
jQuery(function ($) {

    'use strict';

    // Media uploader
    $(document).on('ready', function () {
        // Set all variables to be used in scope
        var frame,
            imgIdInput;

        $('.upload_image_btn').each(function () {
            $(this).on('click', function (e) {
                e.preventDefault();

                imgIdInput = $(this).parent().find('.image-url');

                // If the media frame already exists, reopen it.
                if (frame) {
                    frame.open();
                    return;
                }

                // Create a new media frame
                frame = wp.media({
                    title: np_localize.media_upload_text,
                    button: {
                        text: np_localize.media_button_text
                    },
                    multiple: false // Set to true to allow multiple files to be selected
                });

                // When an image is selected in the media frame...
                frame.on('select', function () {

                    // Get media attachment details from the frame state
                    var attachment = frame.state().get('selection').first().toJSON();
                    imgIdInput.val(attachment.url);
                });

                // Finally, open the modal on click
                frame.open();
            });
        });
    });

    $('.np-color-picker').wpColorPicker();
});