dropCalendar.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'dropcalendar-panel-home',
            renderTo: 'dropcalendar-panel-home-div'
        }]
    });
    dropCalendar.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(dropCalendar.page.Home, MODx.Component);
Ext.reg('dropcalendar-page-home', dropCalendar.page.Home);