DropCalendar.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'dropcalendar-panel-home',
            renderTo: 'dropcalendar-panel-home-div'
        }]
    });
    DropCalendar.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(DropCalendar.page.Home, MODx.Component);
Ext.reg('dropcalendar-page-home', DropCalendar.page.Home);