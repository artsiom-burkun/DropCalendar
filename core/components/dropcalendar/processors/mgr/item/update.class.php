<?php

class DropCalendarItemUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'DropCalendarItem';
    public $classKey = 'DropCalendarItem';
    public $languageTopics = array('dropcalendar');
    //public $permission = 'save';


    /**
     * We doing special check of permission
     * because of our objects is not an instances of modAccessibleObject
     *
     * @return bool|string
     */
    public function beforeSave()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $title = trim($this->getProperty('title'));
        if (empty($title)) {
            $this->modx->error->addField('title', $this->modx->lexicon('dropcalendar_item_err_title'));
        }

        $allDay = $this->getProperty('allDay');
        if ($allDay == '1') {
            $this->setProperty('end', null);
        }

        return parent::beforeSet();
    }
}

return 'DropCalendarItemUpdateProcessor';