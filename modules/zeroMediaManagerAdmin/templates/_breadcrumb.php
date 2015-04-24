<ol class="breadcrumb">
    <?php if (count($paths) == 0): ?>
        <li class="active">Home</li>
    <?php else: ?>
        <li><?php echo link_to('Home', '@mediaManagerAdmin_index'); ?></li>
        <?php $rawPaths = $paths->getRawValue(); ?>
        <?php $last = array_pop($rawPaths); ?>
        <?php $paths = array(); ?>
        <?php while ($next = array_shift($rawPaths)): ?>
            <?php $paths[] = $next; ?>
            <li><?php echo link_to($next, '@mediaManagerAdmin_folder?dir=' . implode('|', $paths)); ?></li>
        <?php endwhile; ?>
        <li class="active"><?php echo $last; ?></li>
    <?php endif; ?>
</ol>