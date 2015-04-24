<manager>

    <div id="media-manager">
        <breadcrumb stack="{ stack }"></breadcrumb>

        <div class="container">
            <div class="row">
                <div class="col-md-3" id="media-manager-upload">
                    <div class="upload-container">
                        <form action="{ opts.uploadUrl }" class="dropzone" id="dropzone-form">
                            <input type="hidden" name="directories[]" each="{ element in stack }" value="{ element }" />
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-2" if={ stack.length > 0 }>
                            <div class="thumbnail">
                                <div class="icon">
                                    <a onclick={ removeDirFromStack }>
                                        <i class="fa fa-chevron-left fa-3x"></i>
                                    </a>
                                </div>
                                <div class="caption">
                                    <p>Volver</p>
                                </div>
                            </div>
                        </div>
                        <file each={ files } file={ this }></file>
                    </div>
                    <div class="row" if={ files.length == 0 }>
                        <div class="alert alert-info">No hay archivos en este directorio</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var self = this;
        self.stack = [];
        self.files = [];

        this.on('mount', function() {
            RiotControl.trigger('manager.init', opts);
        });

        removeDirFromStack(e) {
            RiotControl.trigger('dir.up');
        }

        RiotControl.on('files.updated', function (files) {
            self.files = files;
            self.update();
        });

        RiotControl.on('stack.updated', function (stack) {
            self.update({ stack : stack });
        });

    </script>

</manager>

<breadcrumb>

    <div class="container">
        <ol class="breadcrumb">
            <li class="active" if={ !stack.length }>Home</li>
            <li if="{ stack.length }"><a href="javascript:void(0);">Home</a></li>
            <li each="{ element in stack }"><a href="javascript:void(0);">{ element }</a></li>
            <li if="{ last != null }" class="active">{ last }</li>
        </ol>
    </div>

    <script>

        var self = this;
        self.stack = (opts.stack || []);
        self.last = null;
        RiotControl.on('stack.updated', function (stack) {
            var copiedStack = stack.slice(0);
            var last = copiedStack.pop();
            self.update({ stack : copiedStack, last : last });
        });

    </script>

</breadcrumb>

<file>
    <div class="col-sm-2">
        <div class="thumbnail">
            <div if="{ file.image == true }" style="background-image: url('{ file.public }');"
                title="{ file.name }" class="image" onclick="{ openImage }"></div>
            <div if="{ file.image == false }" class="icon">
                <a if={ file.dir == true } onclick={ addDirToStack }>
                    <i class="fa fa-folder fa-5x"></i>
                </a>
            </div>
            <div class="caption">
                <p>{ file.name }</p>
            </div>
            <div class="actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-cog"></span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="javascript:void(0);" onclick="{ renameFile }">Renombrar</a></li>
                        <li><a href="javascript:void(0);" onclick="{ deleteFile }">Borrar</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        this.file = opts.file;

        openImage(e) {
            RiotControl.trigger('file.selected', this.file);
        }

        renameFile(e) {
            var newFilename = prompt('Nuevo nombre');
        }

        addDirToStack(e) {
            RiotControl.trigger('dir.down', this.file);
        }
    </script>
</file>
