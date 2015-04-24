$(document).ready(function() {

    function FilesStore() {
        riot.observable(this);

        var self = this;

        this.apiUrl = "";
        this.uploadUrl = "";
        this.stack = [];

        self.on('manager.init', function(opts) {
            self.apiUrl = opts.apiUrl;
            self.uploadUrl = opts.uploadUrl;

            self.fetchFiles();

            // Dropzone.
            var dropzone = new Dropzone("#dropzone-form", {
                addRemoveLinks : true
            });

            dropzone.on("queuecomplete", function (files) {
                self.fetchFiles();
            });
        });

        self.on("dir.down", function (file) {
            self.stack.push(file.name);
            self.trigger('stack.updated', self.stack);
        });

        self.on("dir.up", function () {
            self.stack.pop();
            self.trigger('stack.updated', self.stack);
        });

        self.on('stack.updated', function (stack) {
            self.fetchFiles();
            riot.route(stack.join('/'));
        });

        self.on('file.selected', function (file) {
            $(document).trigger('mediamanager.fileSelected', file);
        });

        this.fetchFiles = function() {
            $.ajax({
                type : 'POST',
                url : self.apiUrl,
                data : { directories : self.stack },
                dataType : 'json'
            }).then(function (response) {
                self.trigger('files.updated', response);
            })
        }
    }

    var filesStore = new FilesStore();
    RiotControl.addStore(filesStore);

    riot.mount('manager', {
        apiUrl : $("#mediaManagerRemoteUrl").val(),
        uploadUrl : $("#mediaManagerUploadUrl").val()
    });
});