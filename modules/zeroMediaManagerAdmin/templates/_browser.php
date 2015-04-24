
<?php $rawPaths = $paths->getRawValue(); ?>
<div id="media-manager">
    <div class="container">
        <?php include_partial('breadcrumb', array(
            'paths' => $paths
        )); ?>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php // include_partial('upload', array('paths' => $paths)); ?>
            </div>
            <div class="col-md-9">
                <?php if (count($files)): ?>
                    <div class="row">
                        <?php if (count($paths) > 0 ): ?>
                            <div class="col-sm-2">
                                <div class="thumbnail">
                                    <div class="icon">
                                        <?php if (count($paths) > 1): ?>
                                        <a href="<?php echo url_for('@mediaManagerAdmin_folder?dir=' . $paths[count($paths) - 2]); ?>">
                                            <i class="fa fa-chevron-left fa-3x"></i>
                                        </a>
                                        <?php else: ?>
                                            <a href="<?php echo url_for('mediaManagerAdmin_index'); ?>">
                                                <i class="fa fa-chevron-left fa-3x"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="caption">
                                        Volver
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php foreach($files as $file): ?>
                            <div class="col-sm-2">
                                <div class="thumbnail">
                                    <div class="icon">
                                    <?php if ($file['dir']): ?>
                                        <a href="<?php echo url_for('@mediaManagerAdmin_folder?dir=' . $file['relative']); ?>">
                                            <i class="fa fa-folder fa-5x"></i>
                                        </a>
                                    <?php endif; ?>
                                    </div>
                                    <div class="caption">
                                        <h5><?php echo $file['name']; ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <?php if (count($paths) > 0 ): ?>
                        <div class="row">
                        <div class="col-md-2">
                            <div class="thumbnail">
                                <?php if (count($rawPaths) > 1): ?>
                                    <a href="<?php echo url_for('@mediaManagerAdmin_folder?dir=' . implode('|', $rawPaths)); ?>">
                                        <i class="fa fa-chevron-left fa-3x"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo url_for('mediaManagerAdmin_index'); ?>">
                                        <i class="fa fa-chevron-left fa-3x"></i>
                                    </a>
                                <?php endif; ?>
                                <div class="caption">
                                    Volver
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endif; ?>
                    <div class="alert alert-info">No hay archivos en este directorio</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>