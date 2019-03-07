DropCalendar.window.CreateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'dropcalendar-item-window-create';
    }
    Ext.applyIf(config, {
        title: _('dropcalendar_item_create'),
        width: 550,
        autoHeight: true,
        url: DropCalendar.config.connector_url,
        action: 'mgr/item/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    DropCalendar.window.CreateItem.superclass.constructor.call(this, config);
};
Ext.extend(DropCalendar.window.CreateItem, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'textfield',
            fieldLabel: _('dropcalendar_item_title'),
            name: 'title',
            id: config.id + '-title',
            anchor: '99%',
            allowBlank: false,
        }, {
            layout:'column'
            ,border: false
            ,anchor: '100%'
            ,items: [{
                columnWidth: .5
                ,layout: 'form'
                ,defaults: { msgTarget: 'under' }
                ,border:false
                ,items: [{
                    xtype: 'xdatetime',
                    fieldLabel: _('dropcalendar_item_start'),
                    dateFormat: 'd-m-Y',
                    timeFormat: 'H:i',
                    name: 'start',
                    id: config.id + '-start',
                    allowBlank: false,
                    anchor: '99%'
                },  {
                    xtype: 'xdatetime',
                    fieldLabel: _('dropcalendar_item_end'),
                    dateFormat: 'd-m-Y',
                    timeFormat: 'H:i',
                    name: 'end',
                    id: config.id + '-end',
                    allowBlank: true,
                    anchor: '99%'
                },  {
                    xtype: 'xcheckbox',
                    boxLabel: _('dropcalendar_item_allDay'),
                    name: 'allDay',
                    id: config.id + '-allDay',
                    anchor: '99%'
                },  {
                    xtype: 'textarea',
                    fieldLabel: _('dropcalendar_item_info'),
                    name: 'info',
                    id: config.id + '-info',
                    height: 100,
                    anchor: '99%'
                }]
            },{
                columnWidth: .5
                ,layout: 'form'
                ,defaults: { msgTarget: 'under' }
                ,border:false
                ,items: [{
                    xtype: 'textfield',
                    fieldLabel: _('dropcalendar_item_calendar'),
                    name: 'calendar',
                    id: config.id + '-calendar',
                    anchor: '99%'
                },  {
                    xtype: 'textfield',
                    fieldLabel: _('dropcalendar_item_backgroundColor'),
                    name: 'backgroundColor',
                    id: config.id + '-backgroundColor',
                    anchor: '99%'
                }, {
                    xtype: 'textfield',
                    fieldLabel: _('dropcalendar_item_borderColor'),
                    name: 'borderColor',
                    id: config.id + '-borderColor',
                    anchor: '99%'
                },  {
                    xtype: 'textfield',
                    fieldLabel: _('dropcalendar_item_textColor'),
                    name: 'textColor',
                    id: config.id + '-textColor',
                    anchor: '99%'
                }]
            }]
        }
        ]
    },

    loadDropZones: function () {
    }

});
Ext.reg('dropcalendar-item-window-create', DropCalendar.window.CreateItem);


DropCalendar.window.UpdateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'dropcalendar-item-window-update';
    }
    Ext.applyIf(config, {
        title: _('dropcalendar_item_update'),
        width: 650,
        autoHeight: true,
        url: DropCalendar.config.connector_url,
        action: 'mgr/item/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    DropCalendar.window.UpdateItem.superclass.constructor.call(this, config);
};
Ext.extend(DropCalendar.window.UpdateItem, MODx.Window, {

    getFields: function (config) {
        return [
            {
                xtype: 'hidden',
                name: 'id',
                id: config.id + '-id',
            }, {
                xtype: 'textfield',
                fieldLabel: _('dropcalendar_item_title'),
                name: 'title',
                id: config.id + '-title',
                anchor: '99%',
                allowBlank: false,
            }, {
                layout:'column'
                ,border: false
                ,anchor: '100%'
                ,items: [{
                    columnWidth: .5
                    ,layout: 'form'
                    ,defaults: { msgTarget: 'under' }
                    ,border:false
                    ,items: [{
                        xtype: 'xdatetime',
                        fieldLabel: _('dropcalendar_item_start'),
                        dateFormat: 'd-m-Y',
                        timeFormat: 'H:i',
                        name: 'start',
                        id: config.id + '-start',
                        allowBlank: false,
                        anchor: '99%'
                    },  {
                        xtype: 'xdatetime',
                        fieldLabel: _('dropcalendar_item_end'),
                        dateFormat: 'd-m-Y',
                        timeFormat: 'H:i',
                        name: 'end',
                        id: config.id + '-end',
                        allowBlank: true,
                        anchor: '99%'
                    },  {
                        xtype: 'xcheckbox',
                        boxLabel: _('dropcalendar_item_allDay'),
                        name: 'allDay',
                        id: config.id + '-allDay',
                        anchor: '99%'
                    },  {
                        xtype: 'textarea',
                        fieldLabel: _('dropcalendar_item_info'),
                        name: 'info',
                        id: config.id + '-info',
                        height: 100,
                        anchor: '99%'
                    }]
                },{
                    columnWidth: .5
                    ,layout: 'form'
                    ,defaults: { msgTarget: 'under' }
                    ,border:false
                    ,items: [{
                        xtype: 'textfield',
                        fieldLabel: _('dropcalendar_item_calendar'),
                        name: 'calendar',
                        id: config.id + '-calendar',
                        anchor: '99%'
                    },  {
                        xtype: 'textfield',
                        fieldLabel: _('dropcalendar_item_backgroundColor'),
                        name: 'backgroundColor',
                        id: config.id + '-backgroundColor',
                        anchor: '99%'
                    }, {
                        xtype: 'textfield',
                        fieldLabel: _('dropcalendar_item_borderColor'),
                        name: 'borderColor',
                        id: config.id + '-borderColor',
                        anchor: '99%'
                    },  {
                        xtype: 'textfield',
                        fieldLabel: _('dropcalendar_item_textColor'),
                        name: 'textColor',
                        id: config.id + '-textColor',
                        anchor: '99%'
                    }]
                }]
            }
        ];
    },

    loadDropZones: function () {
    }

});
Ext.reg('dropcalendar-item-window-update', DropCalendar.window.UpdateItem);