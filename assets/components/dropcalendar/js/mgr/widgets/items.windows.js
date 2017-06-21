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
                    xtype: 'textfield',
                    fieldLabel: _('dropcalendar_item_mesto'),
                    name: 'mesto',
                    id: config.id + '-mesto',
                    anchor: '99%'
                },{
                    xtype: 'combo',
                    store: [
                        ["label-green",    _('dropcalendar_item_type_green')],
                        ['label-default',  _('dropcalendar_item_type_blue')],
                        ['label-purple',   _('dropcalendar_item_type_purple')],
                        ['label-orange',   _('dropcalendar_item_type_orange')],
                        ['label-yellow',   _('dropcalendar_item_type_yellow')],
                        ['label-teal',     _('dropcalendar_item_type_teal')],
                        ['label-beige',    _('dropcalendar_item_type_beige')]
                    ],
                    fieldLabel: _('dropcalendar_item_className'),
                    name: 'className',
                    id: config.id + '-className',
                    anchor: '99%'
                }, {
                    xtype: 'xcheckbox',
                    boxLabel: _('dropcalendar_item_active'),
                    name: 'active',
                    id: config.id + '-active',
                    checked: true,
                }]
            },{
                columnWidth: .5
                ,layout: 'form'
                ,defaults: { msgTarget: 'under' }
                ,border:false
                ,items: [{
                    xtype: 'xdatetime',
                    fieldLabel: _('dropcalendar_item_end'),
                    dateFormat: 'd-m-Y',
                    timeFormat: 'H:i',
                    name: 'end',
                    id: config.id + '-end',
                    allowBlank: false,
                    anchor: '99%'
                },{
                    xtype: 'textarea',
                    fieldLabel: _('dropcalendar_item_prim'),
                    name: 'prim',
                    id: config.id + '-prim',
                    height: 100,
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
                        //format:'Y-m-d H:i:s',
                        name: 'start',
                        id: config.id + '-start',
                        allowBlank: false,
                        anchor: '99%'
                    },  {
                        xtype: 'textfield',
                        fieldLabel: _('dropcalendar_item_mesto'),
                        name: 'mesto',
                        id: config.id + '-mesto',
                        anchor: '99%'
                    },{
                        xtype: 'combo',
                        store: [
                            ["label-green",    _('dropcalendar_item_type_green')],
                            ['label-default',  _('dropcalendar_item_type_blue')],
                            ['label-purple',   _('dropcalendar_item_type_purple')],
                            ['label-orange',   _('dropcalendar_item_type_orange')],
                            ['label-yellow',   _('dropcalendar_item_type_yellow')],
                            ['label-teal',     _('dropcalendar_item_type_teal')],
                            ['label-beige',    _('dropcalendar_item_type_beige')]
                        ],
                        fieldLabel: _('dropcalendar_item_className'),
                        name: 'className',
                        id: config.id + '-className',
                        anchor: '99%'
                    }, {
                        xtype: 'xcheckbox',
                        boxLabel: _('dropcalendar_item_active'),
                        name: 'active',
                        id: config.id + '-active',
                        checked: true,
                    }]
                },{
                    columnWidth: .5
                    ,layout: 'form'
                    ,defaults: { msgTarget: 'under' }
                    ,border:false
                    ,items: [{
                        xtype: 'xdatetime',
                        fieldLabel: _('dropcalendar_item_end'),
                        dateFormat: 'd-m-Y',
                        timeFormat: 'H:i',
                        name: 'end',
                        id: config.id + '-end',
                        allowBlank: false,
                        anchor: '99%'
                    },{
                        xtype: 'textarea',
                        fieldLabel: _('dropcalendar_item_prim'),
                        name: 'prim',
                        id: config.id + '-prim',
                        height: 100,
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