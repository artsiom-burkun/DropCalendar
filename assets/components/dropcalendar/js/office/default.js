Ext.onReady(function () {
    dropCalendar.config.connector_url = OfficeConfig.actionUrl;

    var grid = new dropCalendar.panel.Home();
    grid.render('office-dropcalendar-wrapper');

    var preloader = document.getElementById('office-preloader');
    if (preloader) {
        preloader.parentNode.removeChild(preloader);
    }
});