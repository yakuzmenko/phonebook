/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import '../css/app.scss';
import $ from 'jquery';
import 'bootstrap';

$(document).ready(function(){
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $('.delete').on('click', function () {
        var $this = $(this),
            $deleteModal = $('#deletePhoneModal'),
            action = $this.data('action'),
            csrfToken = $this.data('token');

        $deleteModal.find('form').attr('action', action);
        $deleteModal.find('input[name=_token]').val(csrfToken);
    });
});
