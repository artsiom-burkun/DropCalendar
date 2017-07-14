<?php

class DropCalendarItemGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'DropCalendarItem';
    public $classKey = 'DropCalendarItem';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    //public $permission = 'list';


    /**
     * We do a special check of permissions
     * because our objects is not an instances of modAccessibleObject
     *
     * @return boolean|string
     */
    public function beforeQuery()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = trim($this->getProperty('query'));
        if ($query) {
            $c->where(array(
                'title:LIKE' => "%{$query}%",
                'OR:prim:LIKE' => "%{$query}%",
                'OR:calendar_id:LIKE' => "%{$query}%",
            ));
        }

        return $c;
    }


    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $array = $object->toArray();
        $array['actions'] = array();

        // Edit
        $array['actions'][] = array(
            'cls' => '',
            'icon' => 'icon icon-pencil action-grey',
            'title' => $this->modx->lexicon('dropcalendar_item_update'),
            //'multiple' => $this->modx->lexicon('dropcalendar_items_update'),
            'action' => 'updateItem',
            'button' => true,
            'menu' => true,
        );

        if (!$array['active']) {
            $array['actions'][] = array(
                'cls' => '',
                'icon' => 'icon icon-power-off action-green',
                'title' => $this->modx->lexicon('dropcalendar_item_enable'),
                'multiple' => $this->modx->lexicon('dropcalendar_items_enable'),
                'action' => 'enableItem',
                'button' => false,
                'menu' => false,
            );
        } else {
            $array['actions'][] = array(
                'cls' => '',
                'icon' => 'icon icon-power-off action-gray',
                'title' => $this->modx->lexicon('dropcalendar_item_disable'),
                'multiple' => $this->modx->lexicon('dropcalendar_items_disable'),
                'action' => 'disableItem',
                'button' => false,
                'menu' => false,
            );
        }

        // Remove
        $array['actions'][] = array(
            'cls' => '',
            'icon' => 'icon icon-remove action-grey',
            'title' => $this->modx->lexicon('dropcalendar_item_remove'),
            'multiple' => $this->modx->lexicon('dropcalendar_items_remove'),
            'action' => 'removeItem',
            'button' => true,
            'menu' => true,
        );

        return $array;
    }

}

return 'DropCalendarItemGetListProcessor';