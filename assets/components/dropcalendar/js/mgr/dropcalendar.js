var dropCalendar = function (config) {
    config = config || {};
    dropCalendar.superclass.constructor.call(this, config);
};
Ext.extend(dropCalendar, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('dropcalendar', dropCalendar);

dropCalendar = new dropCalendar();