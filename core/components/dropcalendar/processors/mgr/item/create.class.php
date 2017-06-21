<?php

class DropCalendarItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'DropCalendarItem';
    public $classKey = 'DropCalendarItem';
    public $languageTopics = array('dropcalendar');
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $title = trim($this->getProperty('title'));
        if (empty($title)) {
            $this->modx->error->addField('title', $this->modx->lexicon('dropcalendar_item_err_title'));
        } elseif ($this->modx->getCount($this->classKey, array('title' => $title))) {
            $this->modx->error->addField('title', $this->modx->lexicon('dropcalendar_item_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'DropCalendarItemCreateProcessor';