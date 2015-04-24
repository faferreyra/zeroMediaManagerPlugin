<?php

class sfWidgetFormMediaManagerPicker extends sfWidgetForm {

    /**
     * Renders the widget as HTML.
     *
     * All subclasses must implement this method.
     *
     * @param  string $name The name of the HTML widget
     * @param  mixed $value The value of the widget
     * @param  array $attributes An array of HTML attributes
     * @param  array $errors An array of errors
     *
     * @return string A HTML representation of the widget
     */
    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers('Url');

        $tag = $this->renderTag('input', array(
            'class' => 'form-control file-value',
            'name' => $name,
            'id' => $id = $this->generateId($name),
            'value' => $value,
            'autocomplete' => 'off'
        ));

        $imageTag = '<div class="image-preview">'
            . '<button class="btn btn-danger btn-xs" data-trigger="delete" type="button"><span class="glyphicon glyphicon-remove"></span></button></div>';


        $hidden = $this->renderTag('input', array(
            'type' => 'hidden',
            'data-browser-url' => 'true',
            'value' => url_for('@mediaManagerAdmin_browse_widget', true)
        ));

        return sprintf('<div class="media-manager-picker"><div class="input-group %s">', $this->getOption('columns-class'))
        . $tag
        . $hidden
        . '<span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span></div>'
        . $imageTag
        . '</div>';
    }

    /**
     * Gets the JavaScript paths associated with the widget.
     *
     * @return array An array of JavaScript paths
     */
    public function getJavascripts()
    {
        return array(
            '/zeroMediaManagerPlugin/js/mediaPicker.js'
        );
    }

    private function isImage($fileName) {
        return preg_match('/(jpg|png|gif|bmp)$/', $fileName);
    }
}