<?php

/**
 * The home manager controller for DropCalendar.
 *
 */
class DropCalendarHomeManagerController extends modExtraManagerController
{
    /** @var DropCalendar $DropCalendar */
    public $DropCalendar;

    /**
     *
     */
    public function initialize()
    {
        $path = $this->modx->getOption('dropcalendar_core_path', null,
                $this->modx->getOption('core_path') . 'components/dropcalendar/') . 'model/dropcalendar/';
        $this->DropCalendar = $this->modx->getService('dropcalendar', 'DropCalendar', $path);
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return array('dropcalendar:default');
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('dropcalendar');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->DropCalendar->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->DropCalendar->config['jsUrl'] . 'mgr/dropcalendar.js');
        $this->addJavascript($this->DropCalendar->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->DropCalendar->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->DropCalendar->config['jsUrl'] . 'mgr/widgets/events.grid.js');
        $this->addJavascript($this->DropCalendar->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->DropCalendar->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->DropCalendar->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        DropCalendar.config = ' . json_encode($this->DropCalendar->config) . ';
        DropCalendar.config.connector_url = "' . $this->DropCalendar->config['connectorUrl'] . '";
        Ext.onReady(function() {
            MODx.load({ xtype: "dropcalendar-page-home"});
        });
        </script>
        ');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->DropCalendar->config['templatesPath'] . 'home.tpl';
    }
}