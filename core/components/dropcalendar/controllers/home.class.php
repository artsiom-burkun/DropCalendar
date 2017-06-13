<?php

/**
 * The home manager controller for dropCalendar.
 *
 */
class dropCalendarHomeManagerController extends dropCalendarManagerController
{
    /** @var dropCalendar $dropCalendar */
    public $dropCalendar;

    /**
     *
     */
    public function initialize()
    {
        $path = $this->modx->getOption('dropcalendar_core_path', null,
                $this->modx->getOption('core_path') . 'components/dropcalendar/') . 'model/dropcalendar/';
        $this->dropCalendar = $this->modx->getService('dropcalendar', 'dropCalendar', $path);
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
        $this->addCss($this->dropCalendar->config['cssUrl'] . 'mgr/main.css');
        $this->addCss($this->dropCalendar->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        $this->addJavascript($this->dropCalendar->config['jsUrl'] . 'mgr/dropcalendar.js');
        $this->addJavascript($this->dropCalendar->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->dropCalendar->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->dropCalendar->config['jsUrl'] . 'mgr/widgets/events.grid.js');
        $this->addJavascript($this->dropCalendar->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->dropCalendar->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->dropCalendar->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        dropCalendar.config = ' . json_encode($this->dropCalendar->config) . ';
        dropCalendar.config.connector_url = "' . $this->dropCalendar->config['connectorUrl'] . '";
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
        return $this->dropCalendar->config['templatesPath'] . 'home.tpl';
    }
}