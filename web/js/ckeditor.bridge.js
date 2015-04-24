$(document).ready(function() {

    $(document).on('mediamanager.fileSelected', function (e, file) {
        window.opener.CKEDITOR.tools.callFunction(window['mm']['ckeditor']['bridgeFunctionNumber'], file['public']);
        window.close();
    });

});