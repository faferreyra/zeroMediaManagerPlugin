$(document).ready(function() {
    $(document).on('mediamanager.fileSelected', function (e, file) {
        window.opener.mediaManager.tools.setFile(window['mm']['widget']['bridgeUniqueId'], file['public']);
        window.close();
    });
});