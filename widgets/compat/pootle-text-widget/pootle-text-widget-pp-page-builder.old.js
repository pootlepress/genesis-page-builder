/**
 * @copyright Black Studio http://www.blackstudio.it
 * @license GPL 2.0
 */

jQuery(function($){

    // Set wpActiveEditor variables used when adding media from media library dialog
    $(document).on('click', '.editor_media_buttons a', function() {
        var $widget_inside = $(this).closest('div.ui-dialog')
        wpActiveEditor = $('textarea[id^=widget-pootle-text-widget]', $widget_inside).attr('id');
    });

    $(document).on('panelsopen', function(e) {
        var dialog = $(e.target);
        if( dialog.data('widget-type') != 'Pootle_Text_Widget' ) return;

        dialog.filter('.widget-dialog-pootle_text_widget').find('.editor_links').remove();

        if(dialog.data('bs_tinymce_setup') == null) {
            dialog.filter('.widget-dialog-pootle_text_widget').find('a[id$=visual]').click();
            dialog.find('.editor_container iframe[id$="_ifr"]').css('height', 350);
            dialog.data('bs_tinymce_setup', true);
        }
    });

    // Copy the value from the text editor to the text area.
    $(document).on('panelsdone', function(e) {
        var $text_area = $(e.target).find('textarea[id^=widget-pootle-text-widget]');

        if ($text_area.length > 0) {
            var editor = tinyMCE.get( $text_area.attr('id') );
            if( editor != null && typeof( editor.getContent ) == "function") {
                var content = editor.getContent();
            }
            else {
                content = $text_area.val();
            }

            $text_area.val(content);
        }

    } );

} );