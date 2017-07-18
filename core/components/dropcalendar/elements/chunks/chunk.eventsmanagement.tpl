<script>
    $(document).ready(function() {
        var currentMousePos = {
            x: -1,
            y: -1
        };
        jQuery(document).on("mousemove", function(event) {
            currentMousePos.x = event.pageX;
            currentMousePos.y = event.pageY;
        });
        /* initialize the external events
         -----------------------------------------------------------------*/

        $('.event-category').each(function() {
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

        });

        var calendarNumber = [[+calendarNumber]];

        /* initialize the calendar
         -----------------------------------------------------------------*/
        var $modal = $('#event-management');

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },

            events: {
                url: 'assets/components/dropcalendar/action.php',
                data: function () {
                    return {
                        'calendarNumber': calendarNumber,
                    };
                }
            },

            timeFormat: 'HH:mm',
            dragRevertDuration: 200,

            editable: true,
            displayEventEnd: true,
            droppable: true, // this allows things to be dropped onto the calendar
            selectable: true,
            selectHelper: true,



            select: function(start, end) {
                $modal.modal({
                    backdrop: 'static'
                });
                form = $("[[+windowCreate]]");

                $modal.find('.remove-event').hide().end()
                    .find('.save-event').show().end()
                    .find('.modal-body').empty().prepend(form).end()
                    .find('.save-event').unbind('click').click(function() {
                    form.submit();
                });

                $modal.find('form').on('submit', function(add) {
                    title = form.find("input[name='title']").val();

                    startTimeStandart = moment(start).add(document.getElementById("start").value.substr(-2, 2), 'minutes').add(document.getElementById("start").value.substr(0, 2), 'hours').format("YYYY-MM-DD HH:mm");
                    endTimeStandart = moment(start).add(document.getElementById("end").value.substr(-2, 2), 'minutes').add(document.getElementById("end").value.substr(0, 2), 'hours').format("YYYY-MM-DD HH:mm");

                    start = startTimeStandart;
                    end = endTimeStandart;

                    mesto = form.find("input[name='mesto']").val();
                    prim = form.find("input[name='prim']").val();
                    className = form.find("select[name='category']").val();
                    site = form.find("input[name='site']").val();

                    action = 'addEvent';

                    add.preventDefault();
                    $.ajax({
                        url: 'assets/components/dropcalendar/action.php',
                        data: 'title=' + title + '&start=' + start + '&end=' + end + '&mesto=' + mesto + '&prim=' + prim + '&className=' + className + '&site=' + site + '&action=' + action + '&calendarNumber=' + calendarNumber ,
                        type: "POST",
                        success: function(response) {

                            $modal.modal('hide');
                            var arr = JSON.parse(response);

                            if (arr.status === 'failure') {
                                alert(arr.error);
                            }
                            else {
                                $('#calendar').fullCalendar('renderEvent', {
                                    id: arr.eventid,
                                    title: title,
                                    start: start,
                                    end: end,
                                    mesto: mesto,
                                    prim: prim,
                                    className: className,
                                    site: site,
                                    calendar_id: arr.calendar_id
                                }, true );


                            }


                        }
                    });
                });
                $('#calendar').fullCalendar('unselect');
            },

            eventClick: function(calEvent) {
                var form = $("<form></form>");
                form.append("[[+windowUpdate]]");
                $modal.modal({
                    backdrop: 'static'
                });
                $modal.find('.remove-event').show().end()
                    .find('.save-event').hide().end()
                    .find('.modal-body').empty().prepend(form).end()
                    .find('.remove-event').unbind('click').click(function() {

                    action = 'deleteEvent';
                    $.ajax({
                        url: "assets/components/dropcalendar/action.php",
                        data: '&id=' + calEvent.id + '&action=' + action,
                        type: "POST",
                        success: function(response) {
                            $modal.modal('hide');
                            var arr = JSON.parse(response);

                            if (arr.status === 'failure') {
                                alert(arr.error);
                            }
                            else {
                                $('#calendar').fullCalendar('removeEvents', [calEvent._id]);
                            }

                        }
                    });
                });
                $modal.find('form').on('submit', function(e) {

                    id = calEvent.id;
                    title = form.find("input[name='title']").val();
                    start = form.find("input[name='start']").val();
                    end = form.find("input[name='end']").val();
                    mesto = form.find("input[name='mesto']").val();
                    prim = form.find("input[name='prim']").val();
                    site = form.find("input[name='site']").val();
                    className = form.find("select[name='category']").val();

                    e.preventDefault();
                    action = 'updateEventFull';

                    $.ajax({
                        url: 'assets/components/dropcalendar/action.php',
                        data: 'title=' + title + '&start=' + start + '&end=' + end + '&mesto=' + mesto + '&prim=' + prim + '&id=' + id + '&className=' + className + '&site=' + site + '&action=' + action,
                        type: "POST",
                        success: function(response) {

                            $modal.modal('hide');
                            var arr = JSON.parse(response);

                            if (arr.status === 'failure') {
                                alert(arr.error);
                            }
                            else {


                                console.log(id);

                                calEvent.id        = id;
                                calEvent.title     = title;
                                calEvent.start     = start;
                                calEvent.end       = end;
                                calEvent.mesto     = mesto;
                                calEvent.prim      = prim;
                                calEvent.className = className;
                                $('#calendar').fullCalendar('updateEvent', calEvent);

                            }

                        }
                    });

                });
            },

            eventDrop: function(event) {
                start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
                end = event.end.format("YYYY-MM-DD[T]HH:mm:SS");
                action = 'updateEvent';
                $.ajax({
                    url: 'assets/components/dropcalendar/action.php',
                    data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id + '&action=' + action,
                    type: "POST",
                    //dataType: 'json',
                    success: function(response) {

                        var arr = JSON.parse(response);
                        if (arr.status === 'failure') {
                            alert(arr.error);
                        }
                        else {
                            event.id = arr.eventid;
                            console.log(event.id);
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);

                    }
                });
            },

            eventResize: function(event) {
                start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
                end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
                action = 'updateEvent'
                $.ajax({
                    url: 'assets/components/dropcalendar/action.php',
                    data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id + '&action=' + action,
                    type: "POST",
                    success: function(response) {
                        var arr = JSON.parse(response);
                        if (arr.status === 'failure') {
                            alert(arr.error);
                        }
                        else {
                            copiedEventObject.id = arr.eventid;
                            console.log(arr.eventid);
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);

                    }
                });
            },

            drop: function(date) {
                // this function is called when something is dropped
                // retrieve the dropped element's stored Event Object

                //var originalEventObject = $(this).data;
                var $categoryClass = $(this).attr('data-class');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $(this).data;
                // assign it the date that was reported
                copiedEventObject.title = $.trim($(this).text());

                startTimeStandart = moment(date).add(document.getElementById("time-start-m").value, 'minutes').add(document.getElementById("time-start").value, 'hours').format("YYYY-MM-DD HH:mm");
                endTimeStandart = moment(startTimeStandart).add(document.getElementById("time-end-m").value, 'minutes').add(document.getElementById("time-end").value, 'hours').format("YYYY-MM-DD HH:mm");

                copiedEventObject.start = startTimeStandart;
                copiedEventObject.end = endTimeStandart;
                copiedEventObject.allDay = false;
                copiedEventObject.mesto = document.getElementById("mesto-provedeniya").value;
                copiedEventObject.prim = document.getElementById("primechanie").value;
                copiedEventObject.site = document.getElementById("site").value;

                title = copiedEventObject.title;
                start = startTimeStandart;
                end = endTimeStandart;
                mesto = copiedEventObject.mesto;
                prim = copiedEventObject.prim;
                site = copiedEventObject.site;
                className = [$categoryClass];

                action = 'addEvent';


                $.ajax({
                    url: 'assets/components/dropcalendar/action.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end + '&mesto=' + mesto + '&prim=' + prim + '&site=' + site + '&className=' + className + '&action=' + action + '&calendarNumber=' + calendarNumber ,
                    type: "POST",
                    success: function(response) {
                        var arr = JSON.parse(response);

                        if (arr.status === 'failure') {
                            alert(arr.error);
                        }
                        else {
                            copiedEventObject.id = arr.eventid;
                            $('#calendar').fullCalendar('renderEvent', copiedEventObject, false);
                            console.log(arr.eventid);
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);

                    }
                });



                if ($categoryClass)
                    copiedEventObject['className'] = [$categoryClass];

            },

            eventDragStop: function(event) {
                if (isElemOverDiv()) {
                    action = 'deleteEvent';
                    $.ajax({
                        url: 'assets/components/dropcalendar/action.php',
                        data: 'id=' + event.id + '&action=' + action,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.status === 'success') {
                                $('#calendar').fullCalendar('removeEvents', [event.id]);
                            }
                        },
                        error: function(e) {
                            console.log(e.responseText);
                        }
                    });
                }
            }

        });

        function isElemOverDiv() {
            var trashEl = jQuery('#trash');

            var ofs = trashEl.offset();

            var x1 = ofs.left;
            var x2 = ofs.left + trashEl.outerWidth(true);
            var y1 = ofs.top;
            var y2 = ofs.top + trashEl.outerHeight(true);

            return (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
            currentMousePos.y >= y1 && currentMousePos.y <= y2);
        }


    });
</script>








<div id='wrap'>

    <div class="container">

        <!-- start: PAGE CONTENT -->
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-9">
                    <div id="calendar"></div>
                </div>
                <div class="col-sm-3">

                    <h4>Удалить событие</h4>
                    <div id="trash" class="label-delete">
                        перетащить
                    </div>
                    <hr>
                    <h4>Добавить событие:</h4>
                    <div id="event-categories">
                        <div class="event-category label-green" data-class="label-green">
                            <i class="fa fa-move"></i> Тренировка
                        </div>
                        <div class="event-category label-default" data-class="label-default">
                            <i class="fa fa-move"></i> Игра
                        </div>
                        <div class="event-category label-purple" data-class="label-purple">
                            <i class="fa fa-move"></i> Турнир
                        </div>
                        <div class="event-category label-orange" data-class="label-orange">
                            <i class="fa fa-move"></i> Вечеринка
                        </div>
                        <div class="event-category label-yellow" data-class="label-yellow">
                            <i class="fa fa-move"></i> День рождения
                        </div>
                        <div class="event-category label-teal" data-class="label-teal">
                            <i class="fa fa-move"></i> Собрание родителей
                        </div>
                        <div class="event-category label-beige" data-class="label-beige">
                            <i class="fa fa-move"></i> Поездка
                        </div>
                        <hr>
                        <h4>Параметры события:</h4>
                        <form role="form">
                            <div class="form-group">
                                <label style="width: 100%;">Время начала:</label>
                                <input class="form-control" id="time-start" name="time-start" value="19" style="width: 20%; float: left; ">
                                <input class="form-control" id="time-start-m" name="time-start-m" value="30" style="width: 20%; float: left; margin-left: 10px;">
                            </div>

                            <br><br>
                            <div class="form-group">
                                <label style="width: 100%;">Продолжительность:</label>
                                <input class="form-control" id="time-end" name="time-end" value="2" style="width: 20%; float: left;">
                                <input class="form-control" id="time-end-m" name="time-end-m" value="30" style="width: 20%; float: left; margin-left: 10px;">
                            </div>

                            <br><br>
                            <div class="form-group">
                                <label>Место:</label>
                                <input class="form-control" id="mesto-provedeniya" name="mesto-provedeniya" value="Зал">
                            </div>

                            <div class="form-group">
                                <label>Сайт: </label>
                                <input class="form-control" id="site" name="site" value="http://example.com">
                            </div>

                            <div class="form-group">
                                <label>Примечание: </label>
                                <input class="form-control" id="primechanie" name="primechanie" value="Не опаздываем!">
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
        <!-- end: PAGE CONTENT-->



    </div>

</div>

<div style='clear:both'></div>