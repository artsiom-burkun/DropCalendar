var DropCalendar = function (config) {
    config = config || {};
    DropCalendar.superclass.constructor.call(this, config);
};
Ext.extend(DropCalendar, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('dropcalendar', DropCalendar);

DropCalendar = new DropCalendar();