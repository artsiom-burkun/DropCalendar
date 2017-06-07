dropCalendar.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'dropcalendar-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: false,
            hideMode: 'offsets',
            items: [{
                title: _('dropcalendar_items'),
                layout: 'anchor',
                items: [{
                    html: _('dropcalendar_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'dropcalendar-grid-items',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    dropCalendar.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(dropCalendar.panel.Home, MODx.Panel);
Ext.reg('dropcalendar-panel-home', dropCalendar.panel.Home);
