if ($('div.flash-message').length) {
    $('div.flash-message').effect('highlight');

    setTimeout(function hideFlashMessages() {
        $('div.flash-message').hide('blind');
    }, 5000);
}
