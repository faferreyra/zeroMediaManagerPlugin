<?php

class zeroMediaManagerPluginConfiguration extends sfPluginConfiguration
{
    /**
     * @see sfPluginConfiguration
     */
    public function initialize()
    {
        if (in_array('zeroMediaManagerAdmin', sfConfig::get('sf_enabled_modules', array())))
        {
            $this->dispatcher->connect('routing.load_configuration', array('zeroMediaManagerRouting', 'addRoutesForAdmin'));
        }
    }
}