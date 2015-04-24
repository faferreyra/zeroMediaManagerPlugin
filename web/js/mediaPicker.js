
$(document).ready(function(e) {

    var index = 0;
    $('.media-manager-picker').each(function () {
        index++;
        var $mediaManagerPicker = $(this);
        var uniqueId = Math.floor(Math.random()*99999);
        var url = $mediaManagerPicker.find('[data-browser-url]').val();
        $mediaManagerPicker.attr('id', uniqueId);
        $mediaManagerPicker.find('.input-group-addon').click(function (e) {
            window.open(url + "?uid=" + uniqueId, 'mediaManagerBrowser', 'width=1024,height=480,menubar=off,toolbar=off,centerscreen=yes,scrollbars=yes');
        });

        $mediaManagerPicker.find('.form-control.file-value').each(function () {
            var $this = $(this);
            var re = /(\.jpg|\.gif|\.png)$/i;
            if (($this.val() != "") && ($this.val().match(re) != null)) {
                $mediaManagerPicker.find('.image-preview').css({
                    backgroundImage : 'url("' + $this.val() + '")'
                }).show();
            }
        });

        $mediaManagerPicker.find('.image-preview').on('click', '[data-trigger="delete"]', function (e) {
            $mediaManagerPicker.find('.form-control.file-value').val("");
            $(this).closest('.image-preview').hide();
        });
    });

    window.mediaManager = {
        tools : {
            setFile : function (uniqueId, file) {
                var $container = $("#" + uniqueId);
                $container.find('.form-control.file-value').val(file);
                var $imagePreview = $container.find('.image-preview');
                var cssProperties = {
                    backgroundImage : 'url("' + file + '")'
                };
                $imagePreview.first().css(cssProperties).show();
            }
        }
    }
});