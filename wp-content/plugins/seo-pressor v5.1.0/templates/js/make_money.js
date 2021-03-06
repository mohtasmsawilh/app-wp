function SEOPressor_make_money($) {
    if (!SEOPressor_make_money_triggered)
    {
        SEOPressor_make_money_triggered = true;
        /*
         * Make Money Page behaviour.
         */
        /*
         * Checkboxes.
         */
        $('[type="checkbox"]').iCheckbox({
            switch_container_src: WPPostsRateKeys.plugin_url + 'templates/js/lib/iCheckbox/images/switch-frame.png',
            class_container     : 'seopressor-checkbox-switcher-container',
            class_switch        : 'seopressor-checkbox-switch',
            class_checkbox      : 'seopressor-checkbox-checkbox',
            switch_speed        : 100,
            switch_swing        : -13
        });

        /*
         * Buttons.
         */
        $('.seopressor-button').button();

        /*
         * Manage the Colorpicker widget.
         */
        // Affiliate Link Color.
        $('#seopressor-footer-text-color-selector').hide();
        function convertHexToRGB(hex) {
            var hex = parseInt(((hex.indexOf('#') > -1) ? hex.substring(1) : hex), 16);
            return [hex >> 16, (hex & 0x00FF00) >> 8, (hex & 0x0000FF)];
        }

        function convert_RGB_to_HSL(rgb) {
            var min, max, delta, h, s, l;
            var r = rgb[0], g = rgb[1], b = rgb[2];
            min = Math.min(r, Math.min(g, b));
            max = Math.max(r, Math.max(g, b));
            delta = max - min;
            l = (min + max) / 2;
            s = 0;
            if (l > 0 && l < 1) {
                s = delta / (l < 0.5 ? (2 * l) : (2 - 2 * l));
            }
            h = 0;
            if (delta > 0) {
                if (max == r && max != g) h += (g - b) / delta;
                if (max == g && max != b) h += (2 + (b - r) / delta);
                if (max == b && max != r) h += (4 + (r - g) / delta);
                h /= 6;
            }
            return [h, s, l];
        }

        $.farbtastic('#seopressor-footer-text-color-selector')
            .setColor($('#seopressor-footer-text-color').val())
            .linkTo(function (color) {
                $('#seopressor-footer-text-color').css({
                    'backgroundColor': color,
                    'color'          : (convert_RGB_to_HSL(convertHexToRGB(color))[2] > 125) ? '#000' : '#FFF'
                }).val(color);

                $('#seopressor-footer-preview a').css('color', color);
            });

        $('#seopressor-footer-text-color').click(function () {
            $('#seopressor-footer-text-color-selector').fadeIn();
        });

        $(document).mousedown(function () {
            $('#seopressor-footer-text-color-selector').each(function () {
                var display = $(this).css('display');
                if (display == 'block')
                    $(this).fadeOut();
            });
        });

        $('#seopressor-footer-text-color').css({
            'backgroundColor': $('#seopressor-footer-text-color').val(),
            'color'          : (convert_RGB_to_HSL(convertHexToRGB($('#seopressor-footer-text-color').val()))[2] > 125) ? '#000' : '#FFF'
        });

        $('#seopressor-footer-preview a').css('color', $('#seopressor-footer-text-color').val());

        /*
         * Ajax Form Declaration.
         */
        $('.seopressor-ajax-form').ajaxForm({
            beforeSubmit: function (form_data_arr, form$, options) {
                /*
                 * Used to disable the button and show the loader.
                 */
                $('.seopressor-submit-tr img, .seopressor-submit-div img', form$).show();
                $('.seopressor-submit-tr button[type="submit"], .seopressor-submit-div button[type="submit"]', form$).button('disable');
            },
            data        : {
                action: 'seopressor_update'
            },
            dataType    : 'json',
            error       : function (a, b, c) {
                /*
                 * Don't show the message in case that the user cancel the query.'
                 */
                if (c) {
                    /*
                     * Remove ajax loader and disable button.
                     */
                    $('.seopressor-submit-tr img, .seopressor-submit-div img').hide();
                    $('.seopressor-submit-tr button[type="submit"], .seopressor-submit-div button[type="submit"]').button('enable');

                    // Clear message dashboard.
                    $('#seopressor-message-container').html('');

                    $('#seopressor-templates-container .seopressor-error-message .seopressor-msg-mark').html(b + ': ' + c);
                    $('#seopressor-templates-container .seopressor-error-message').clone().appendTo('#seopressor-message-container');

                    $('.seopressor-error-message').effect('highlight', {
                        color: '#FF655D'
                    }, 1000, function () {
                    });
                    $('.seopressor-notification-message').effect('highlight', {
                        color: '#BDD1B5'
                    }, 1000, function () {
                    });
                }
            },
            success     : function (response_from_server, statusText, xhr, form$) {
                /*
                 * Remove ajax loader and show button.
                 */
                $('.seopressor-submit-tr img, .seopressor-submit-div img', form$).hide();
                $('.seopressor-submit-tr button[type="submit"], .seopressor-submit-div button[type="submit"]', form$).button('enable');

                // Clear message dashboard.
                $('#seopressor-message-container').html('');

                if (response_from_server.type == 'notification') {
                    /*
                     * Show server message to user.
                     */
                    $('#seopressor-templates-container .seopressor-notification-message .seopressor-msg-mark').html(response_from_server.message);
                    $('#seopressor-templates-container .seopressor-notification-message').clone().appendTo('#seopressor-message-container');
                }
                else if (response_from_server.type == 'error') {
                    /*
                     * Show server message to user.
                     */
                    $('#seopressor-templates-container .seopressor-error-message .seopressor-msg-mark').html(response_from_server.message);
                    $('#seopressor-templates-container .seopressor-error-message').clone().appendTo('#seopressor-message-container');
                }

                $('.seopressor-error-message').effect('highlight', {
                    color: '#FF655D'
                }, 1000, function () {
                });
                $('.seopressor-notification-message').effect('highlight', {
                    color: '#BDD1B5'
                }, 1000, function () {
                });
            },
            type        : 'POST',
            url         : ajaxurl
        });
    }
};

seop_jquery(SEOPressor_make_money);

//To be sure that seopressor code will be executed even when other code generate an exception
SEOPressor_make_money_triggered = false;

function OnErrorResponse(){
    if (document.readyState==="interactive" && !SEOPressor_make_money_triggered) SEOPressor_make_money(seop_jquery);
    //document.readyState==="interactive" means that DOM is ready to interact with it
    //This check is useful to exclude the errors fired before DOMContentLoaded event
}

if (window.addEventListener) window.addEventListener('error', OnErrorResponse);
else window.attachEvent('onerror', OnErrorResponse);