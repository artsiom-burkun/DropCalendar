<?php

class DropCalendarItemRemoveProcessor extends modObjectProcessor
{
    public $objectType = 'DropCalendarItem';
    public $classKey = 'DropCalendarItem';
    public $languageTopics = array('dropcalendar');
    //public $permission = 'remove';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('dropcalendar_item_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var DropCalendarItem $object */
            if (!$object = $this->modx->getObject($this->classKey, compact('id'))) {
                return $this->failure($this->modx->lexicon('dropcalendar_item_err_nf'));
            }

            $object->remove();
        }

        return $this->success();
    }

}

return 'DropCalendarItemRemoveProcessor';