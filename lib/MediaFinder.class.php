<?php

class MediaFinder
{
    private $root;
    private $children;

    private function __construct($root, $children = array()) {
        $this->root = $root;
        $this->children = $children;
        sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
    }

    /**
     * @param $root string Root directory to start the search.
     * @param $children array
     * @return MediaFinder
     */
    public static function create($root, $children = array()) {
        return new MediaFinder($root, $children);
    }

    /**
     * @return array
     */
    public function find() {
        $finder = sfFinder::type('any');
        $childrenDirectories = implode(DIRECTORY_SEPARATOR, $this->children);
        $directory = $this->root . DIRECTORY_SEPARATOR . $childrenDirectories;
        $files = $finder
            ->ignore_version_control(true)
            ->sort_by_type()
            ->maxdepth(0)
            ->in($directory);

        $result = array();

        foreach ($files as $file) {
            $relativePath = $this->createRelativePath($file);
            $isDir = is_dir($file);
            $fileData = array(
                'path' => $file,
                'name' => basename($file),
                'writable' => is_writable($file),
                'relative' => $relativePath,
                'dir' => $isDir,
                'image' => (!$isDir) && $this->isImage($file)
            );

            $result[] = $fileData;
        }

        return $result;
    }

    private function createRelativePath($path) {
        $relativePath = str_replace($this->root . DIRECTORY_SEPARATOR, '', $path);
        return $relativePath;
    }

    private function isImage($fileName) {
        return preg_match('/(jpg|png|gif|bmp)$/', $fileName);
    }
}