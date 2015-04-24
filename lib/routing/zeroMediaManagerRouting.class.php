<?php

class zeroMediaManagerRouting
{
    static public function addRoutesForAdmin(sfEvent $event)
    {
        /** @var sfPatternRouting $r */
        $r = $event->getSubject();

        $r->prependRoute('mediaManagerAdmin_index', new sfRoute('/media',
            array(
                'module' => 'zeroMediaManagerAdmin', 'action' => 'index'
            )));

        $r->prependRoute('mediaManagerAdmin_folder', new sfRoute('/media/browse/:dir',
            array(
                'module' => 'zeroMediaManagerAdmin', 'action' => 'browse'
            )));

        $r->prependRoute('mediaManagerAdmin_remote', new sfRoute('/media/remote',
            array(
                'module' => 'zeroMediaManagerAdmin', 'action' => 'remote'
            )));

        $r->prependRoute('mediaManagerAdmin_upload', new sfRoute('/media/upload',
            array(
                'module' => 'zeroMediaManagerAdmin', 'action' => 'upload'
            )));

        $r->prependRoute('mediaManagerAdmin_browse_ckeditor', new sfRoute('/media/browse/ckeditor', array(
            'module' => 'zeroMediaManagerAdmin', 'action' => 'browseForCkeditor'
        )));

        $r->prependRoute('mediaManagerAdmin_browse_widget', new sfRoute('/media/browse/widget', array(
            'module' => 'zeroMediaManagerAdmin', 'action' => 'browseForWidget'
        )));
    }
}