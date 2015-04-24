<?php

class zeroMediaManagerAdminActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->setVar('files', MediaFinder::create($this->getRootDirectory())->find());
        $this->setVar('inRoot', true);
        $this->setVar('paths', []);
    }

    public function executeBrowse(sfWebRequest $request)
    {
        $directory = $request->getParameter('dir');
        $this->forward404Unless($directory);

        $this->setVar('files', MediaFinder::create($this->getRootDirectory(), $directory)->find());
        $this->setVar('inRoot', false);
        $this->setVar('paths', explode('|', $directory));
    }

    public function executeBrowseForCkeditor(sfWebRequest $request)
    {
        $ckeditorBridgeFunctionNumber = $request->getParameter('CKEditorFuncNum', null);
        $this->forward404Unless($ckeditorBridgeFunctionNumber);
        $this->setVar('bridgeFunctionNumber', $ckeditorBridgeFunctionNumber);
        $this->getWebResponse()->addJavascript('/zeroMediaManagerPlugin/js/ckeditor.bridge.js', 'last');
        $this->setLayout('popupLayout');
    }

    public function executeBrowseForWidget(sfWebRequest $request)
    {
        $mediaManagerUniqueId = $request->getParameter('uid');
        $this->forward404Unless($mediaManagerUniqueId);

        $this->getWebResponse()->addJavascript('/zeroMediaManagerPlugin/js/widget.bridge.js', 'last');
        $this->setVar('mediaManagerUniqueId', $mediaManagerUniqueId);
        $this->setLayout('popupLayout');
    }

    /**
     * @return sfWebResponse
     */
    private function getWebResponse() {
        return $this->getResponse();
    }

    public function executeRemote(sfWebRequest $request)
    {
        $directories = $request->getParameter('directories', array());

        $files = MediaFinder::create($this->getRootDirectory(), $directories)->find();

        // Adds the public path of the found files.
        $result = array();
        foreach ($files as $file) {
            $webPath = str_replace(sfConfig::get('sf_web_dir'), '', $file['path']);
            $file['public'] = $webPath;
            unset($file['path']);
            unset($file['relative']);
            $result[] = $file;
        }

        return $this->renderJson($result);
    }

    public function executeUpload(sfWebRequest $request)
    {
        $directories = $request->getParameter('directories', array());

        $childrenDirectories = implode(DIRECTORY_SEPARATOR, $directories);
        $targetDir = $this->getRootDirectory() . DIRECTORY_SEPARATOR . $childrenDirectories;

        $files = $request->getFiles();
        foreach ($files as $uploadedFile) {
            $targetFile = $targetDir . DIRECTORY_SEPARATOR . $uploadedFile['name'];
            move_uploaded_file($uploadedFile['tmp_name'], $targetFile);
        }

        return sfView::NONE;
    }

    private function getRootDirectory()
    {
        $webDir = sfConfig::get('sf_web_dir');
        $rootDir = sfConfig::get('app_zero_media_manager_root', 'media');
        return $webDir . DIRECTORY_SEPARATOR . $rootDir;
    }
}